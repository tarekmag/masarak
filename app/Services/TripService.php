<?php

namespace App\Services;

use Carbon\Carbon;
use App\Enums\RouteType;
use App\Enums\NotifyType;
use Illuminate\Support\Str;
use App\Services\DriverService;
use App\Services\NotifyService;
use ATPGroup\Routes\Models\Trip;
use App\Services\EmployeeService;
use ATPGroup\Settings\Models\Setting;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Employees\Models\Employee;
use ATPGroup\Routes\Models\RouteSchedule;
use ATPGroup\Routes\Models\RouteScheduleEmployee;
use App\Events\PushTripTrackingRouteCoordinateEvent;
use App\Events\PushTripTrackingStationCoordinateEvent;
use ATPGroup\Routes\Models\RouteScheduleEmployeeLocationRequest;

class TripService
{
    /**
     * To push Route Coordinate to live tracking and mongo
     *
     * @return boolean
     */
    public function pushTripTrackingRouteCoordinate($tripId, $coordinates, $isRealTime = false)
    {
        $trip = Trip::find($tripId);
        if (!$trip) {
            // info('Faild Trip Push');
            return false;
        }

        // $trip->push('route_coordinates', $coordinates, true);
        $trip->push('route_coordinates', $coordinates);
        // info('Pushed Trip:'.$tripId, $coordinates);

        if ($isRealTime) {
            broadcast(new PushTripTrackingRouteCoordinateEvent(
                $trip->route['company_id'],
                $tripId,
                $coordinates,
                $trip->route['from_en'],
                $trip->route['from_ar'],
                $trip->route['to_en'],
                $trip->route['to_ar'],
                $trip->driver['name'],
                $trip->driver['mobile_number'],
            ));
        }

        return true;
    }

    /**
     * To set station time before complete it
     *
     * @return boolean
     */
    public function addArrivalStationTime($tripId, $request, $isRealTime = false)
    {
        if ($request->filled('station_id')) {
            $station = $this->changeStationStatus($tripId, $request, false, now()->format(config('helpers.timeFormat')), $isRealTime);
        }

        if ($request->filled('lat') && $request->filled('lng')) {
            $station = $this->createStation($tripId, $request);
            $this->pushStation($tripId, $request, $station, false, now()->format(config('helpers.timeFormat')), $isRealTime);
        }
        return Trip::find($tripId);
    }

    /**
     * Add Complete To Station
     *
     * @return boolean
     */
    public function addCompleteStation($tripId, $request, $isRealTime = false)
    {
        if ($request->filled('station_id')) {
            $station = $this->changeStationStatus($tripId, $request, true, now()->format(config('helpers.timeFormat')), $isRealTime);

            if ($request->filled('employees') && count($request->employees) > 0) {
                $this->pushEmployee($tripId, $request->employees, $station);
            }
        }

        if ($request->filled('lat') && $request->filled('lng')) {
            $station = $this->createStation($tripId, $request);
            $this->pushStation($tripId, $request, $station, true, true, $isRealTime);

            if ($request->filled('employees') && count($request->employees) > 0) {
                $this->pushEmployee($tripId, $request->employees, $station);
            }
        }
        return Trip::find($tripId);
    }

    /**
     * Change Station Status to mongoDB and to Live Tracking
     *
     */
    public function changeStationStatus($tripId, $request, $status, $arrivalTime, $isRealTime = false)
    {
        $trip = Trip::find($tripId);

        $station = Station::find($request->station_id);
        $stations = collect();

        $lat = ($trip->is_return) ? $station->drop_lat : $station->pickup_lat;
        $lng = ($trip->is_return) ? $station->drop_lng : $station->pickup_lng;

        foreach ($trip->stations as $row) {
            if (is_array($row) && $row['id'] === $station->id) {
                $row['status'] = $status;
                if ($arrivalTime) {
                    $row['arrival_time'] = $arrivalTime;
                }
            }
            $stations->push($row);
        }
        $unique = $stations->unique('id');

        $trip->update(['stations' => $unique->values()->all()], ['upsert' => true]);

        data_set($station, 'arrival_time', $arrivalTime);

        $this->pushTripTrackingStationCoordinate($tripId, $lat, $lng, $station, $isRealTime);

        return $station;
    }

    /**
     * Push Employee to mongoDB
     *
     */
    public function pushEmployee($tripId, $employees, $station)
    {
        $trip = Trip::find($tripId);
        $stations = collect();
        $employeesCollection = collect($employees);

        RouteScheduleEmployee::where('route_id', $trip->route_id)->where('route_schedule_id', $trip->route_schedule_id)->whereIn('employee_id', $employeesCollection->unique()->pluck('id')->toArray())->update(['station_id' => $station->id]);

        foreach ($trip->stations as $row) {
            if (is_array($row)) {
                $row['employees'] = RouteScheduleEmployee::where('route_id', $trip->route_id)->where('route_schedule_id', $trip->route_schedule_id)->where('station_id', $row['id'])->get()->map(function ($item) use ($trip, $employeesCollection) {
                    $isAttended = false;
                    $emp = $employeesCollection->first(function ($value) use ($item, $trip) {
                        return ($value['id'] == $item->employee->id) ? $value : [];
                    });

                    if (!empty($emp)) {
                        $isAttended = $emp['is_attended'];
                    } else {
                        $stations = collect($trip['stations']);
                        $emp = $stations->pluck('employees')->collapse()->first(function ($employee) use ($item) {
                            return ($employee['id'] == $item->employee->id) ? $employee['is_attended'] : false;
                        });

                        if ($emp) {
                            $isAttended = $emp['is_attended'];
                        }
                    }

                    return app(EmployeeService::class)->employeeObject($item->employee, $trip->route_id, $trip->route_schedule_id, $isAttended);
                })->toArray();
                $stations->push($row);
            }
        }
        $unique = $stations->unique('id');
        $trip->update(['stations' => $unique->values()->all()], ['upsert' => true]);
        $trip->update(['employees' => []], ['upsert' => true]);
        $trip->update(['employees' => $this->getAllEmployeesNotAssignToStation($trip->route, $trip->route_schedule_id)], ['upsert' => true]);
        return true;
    }

    /**
     * Get All Employees Not Assign To Station
     *
     */
    public function getAllEmployeesNotAssignToStation($route, $scheduleId)
    {
        $routeSchedule = RouteSchedule::find($scheduleId);
        if (!$routeSchedule) {
            return [];
        }

        return Employee::where('company_id', $route['company_id'])
            ->where('branch_id', $route['branch_id'])
            ->whereIn('id', $routeSchedule->employees()->whereNull('station_id')->pluck('employee_id')->toArray())
            ->get()
            ->map(function ($item) use ($route, $scheduleId) {
                return app(EmployeeService::class)->employeeObject($item, $route['id'], $scheduleId);
            })->toArray();
    }

    /**
     * Get All Employees Assign To Station
     *
     */
    public function getAllEmployeesAssignToStation($route, $scheduleId)
    {
        $routeSchedule = RouteSchedule::find($scheduleId);
        if (!$routeSchedule) {
            return [];
        }

        return Employee::where('company_id', $route['company_id'])
            ->where('branch_id', $route['branch_id'])
            ->whereIn('id', $routeSchedule->employees()->whereNotNull('station_id')->pluck('employee_id')->toArray())
            ->get()
            ->map(function ($item) use ($route, $scheduleId) {
                return app(EmployeeService::class)->employeeObject($item, $route['id'], $scheduleId);
            })->toArray();
    }

    /**
     * Get Teamleader Related To Schedule
     *
     */
    public function getTeamLeaderRelatedToSchedule($scheduleId)
    {
        $routeSchedule = RouteScheduleEmployee::where('route_schedule_id', $scheduleId)->whereHas('employee', function ($query) {
            return $query->leader();
        })->with('employee')->first();

        if ($routeSchedule) {
            return $routeSchedule->employee;
        }
        return null;
    }

    /**
     * Get All Employee Related To Schedule
     *
     */
    public function getAllEmployeeRelatedToSchedule($scheduleId, $stationId = null)
    {
        return RouteScheduleEmployee::where('route_schedule_id', $scheduleId)->when($stationId, function ($query) use ($stationId) {
            return $query->where('station_id', $stationId);
        })->whereHas('employee')->with(['employee', 'station'])->get();
    }

    /**
     * Push Station to mongoDB and to Live Tracking
     *
     */
    public function pushStation($tripId, $request, $station, $status, $arrivalTime, $isRealTime = false)
    {
        $trip = Trip::find($tripId);
        data_set($station, 'lat', (float) $request->lat);
        data_set($station, 'lng', (float) $request->lng);
        data_set($station, 'status', $status);
        if ($arrivalTime) {
            data_set($station, 'arrival_time', now()->format(config('helpers.timeFormat')));
        } else {
            data_set($station, 'arrival_time', null);
        }
        data_set($station, 'employees', (array) []);
        $data = $station->only(['id', 'name_ar', 'name_en', 'lat', 'lng', 'status', 'arrival_time', 'employees']);
        $trip->push('stations', $data, true);
        $this->pushTripTrackingStationCoordinate($tripId, $request->lat, $request->lng, $station, $isRealTime);
        return $station;
    }

    /**
     * Create Station
     */
    public function createStation($tripId, $request)
    {
        $trip = Trip::find($tripId);
        if ($trip->is_return) {
            $request->merge(['drop_lat' => $request->lat, 'drop_lng' => $request->lng]);
            $station = Station::firstOrNew($request->only(['drop_lat', 'drop_lng']));
        } else {
            $request->merge(['pickup_lat' => $request->lat, 'pickup_lng' => $request->lng]);
            $station = Station::firstOrNew($request->only(['pickup_lat', 'pickup_lng']));
        }
        $station->save();
        return $station;
    }

    /**
     * Push Station Coordinate to mongoDB and Live Tracking
     *
     * @return boolean
     */
    public function pushTripTrackingStationCoordinate($tripId, $lat, $lng, $station, $isRealTime = false)
    {
        $trip = Trip::find($tripId);
        $stations_coordinates = [
            'station_name_ar' => $station->name_ar,
            'station_name_en' => $station->name_en,
            'station_arrival_time' => now()->format(config('helpers.timeFormat')),
            'station_employees' => [],
            'latlng' => [$lat, $lng]
        ];
        $trip->push('stations_coordinates', [$stations_coordinates], true);

        if ($isRealTime) {
            broadcast(new PushTripTrackingStationCoordinateEvent($trip->route['company_id'], $trip->_id, $lat, $lng, $stations_coordinates));
        }

        return true;
    }

    /**
     * Check For Employee Can Edit Location
     */
    public function checkEmployeeCanEditLocation($routeId, $routeScheduleId, $employeeId)
    {
        $locationReqestCount = RouteScheduleEmployeeLocationRequest::where('route_id', $routeId)
            ->where('route_schedule_id', $routeScheduleId)
            ->where('employee_id', $employeeId)
            ->count();

        if ($locationReqestCount >= RouteType::EMPLOYEE_LOCATION_REQUEST_COUNT) {
            return false;
        }
        return true;
    }

    /**
     * Update Location Employee
     *
     */
    public function updateLocationEmployee($tripId, $request)
    {
        $trip = Trip::find($tripId);
        $station = Station::find($request->station_id);
        $status = RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_PENDING;

        if ($request->filled('lat') && $request->filled('lng')) {
            $station = $this->createStation($tripId, $request);
        } else {
            ($trip->is_return) ? $request->merge(['lat' => $station->drop_lat]) : $request->merge(['lat' => $station->pickup_lat]);
            ($trip->is_return) ? $request->merge(['lng' => $station->drop_lng]) : $request->merge(['lng' => $station->pickup_lng]);
        }

        foreach ($request->employee_ids as $employee_id) {
            $check = $this->checkEmployeeCanEditLocation($trip->route_id, $trip->route_schedule_id, $employee_id);
            if ($check) {
                $status = RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_APPROVED;
                $this->pushStation($tripId, $request, $station, false, null);
                $this->pushEmployee($tripId, [$employee_id], $station);
            }

            $locationRequest = RouteScheduleEmployeeLocationRequest::firstOrNew(['trip_id' => $tripId, 'route_id' => $trip->route_id, 'route_schedule_id' => $trip->route_schedule_id, 'employee_id' => $employee_id, 'status' => $status]);
            $locationRequest->fill(['old_station_id' => $request->old_station_id, 'station_id' => $station->id]);
            $locationRequest->save();

            if (count($request->employee_ids) == 1 && $check == false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Driver Confirm Trip
     *
     */
    public function driverConfirmTrip($tripId, $request)
    {
        $trip = Trip::find($tripId);
        if (!$this->checkForCanConfirmTrip($trip)) {
            return false;
        }

        $trip->driver_confirmed = $request->driver_confirmed;
        $trip->save();

        if (!$request->driver_confirmed) {
            app(DriverService::class)->pushTypeNotify(NotifyType::DRIVER_NOT_CONFIRM_TRIP, $trip->driverRelation, ['trip' => $trip, 'reason' => $request->reason]);
        }

        if ($request->driver_confirmed) {
            app(DriverService::class)->pushTypeNotify(NotifyType::DRIVER_CONFIRM_TRIP, $trip->driverRelation, ['trip' => $trip]);
        }

        app(NotifyService::class)->updateDriverConfirmData($request->notify_id, $request->driver_confirmed);

        return true;
    }

    /**
     * Check For Can Confirm Trip
     *
     */
    public function checkForCanConfirmTrip($trip)
    {
        $timeToCanConfirmTrip = config('helpers.timeToCanConfirmTrip');
        $setting = Setting::where('setting_key', 'time_to_can_confirm_trip')->first();
        if ($setting) {
            $timeToCanConfirmTrip = $setting->setting_value;
        }

        $canConfirm = true;
        if (!$trip->trip_date) {
            return $canConfirm;
        }

        $tripDate = $this->getTripDateTimeFormated($trip, $timeToCanConfirmTrip);
        if (now()->addMinutes()->format('Y-m-d H:i') > $tripDate) {
            $canConfirm = false;
        }
        return $canConfirm;
    }

    /**
     * Get Trip Date Time Formated
     *
     */
    public function getTripDateTimeFormated($trip, $addMinutes = 0)
    {
        return Carbon::parse($trip->trip_date->format(config('helpers.dateFormat')) . ' ' . $trip->trip_time->format(config('helpers.timeFormat')))->addMinutes($addMinutes);
    }

    /**
     * Get The Exceeded Arrival Allowance Time
     *
     */
    public function getExceededArrivalAllowanceTimeForFirstStation($trip)
    {
        if (!isset($trip->stations[0]['arrival_time'])) {
            return '';
        }

        $stationArrivalDateTime = Carbon::parse($trip->trip_date->format(config('helpers.dateFormat')) . ' ' . $trip->stations[0]['arrival_time']);
        $tripDate = Carbon::parse($this->getTripDateTimeFormated($trip, $trip->arrival_allowance));
        return ($tripDate->lt($stationArrivalDateTime)) ? $stationArrivalDateTime->diffForHumans($tripDate) : null;
    }

    /**
     * Get Status Have a Reasons Trip
     *
     */
    public function getStatusOfReasonsTrip()
    {
        return [RouteType::TRIP_STATUS_CANCELLED, RouteType::TRIP_STATUS_STOPPED];
    }

    /**
     * Get Lat and Lng Station Based on Trip Type is return or else
     *
     */
    public function getLatLngStationTrip($trip, $station)
    {
        $countLatLng = config('helpers.googleMapLatLngDigitsCount');

        $lat = Str::substr($station->pickup_lat, 0, $countLatLng);
        $lng = Str::substr($station->pickup_lng, 0, $countLatLng);
        if ($trip->is_return) {
            $lat = Str::substr($station->drop_lat, 0, $countLatLng);
            $lng = Str::substr($station->drop_lng, 0, $countLatLng);
        }
        return ['lat' => $lat, 'lng' => $lng];
    }

    /**
     * Get Query For Export
     *
     */
    public function exportQuery($request)
    {
        return Trip::search($request)->get()->map(function ($item) use ($request) {
            $employees = collect($item->employees);
            return [
                $request->date('start_date')->format(config('helpers.exportDateFormat')),
                $request->date('end_date')->format(config('helpers.exportDateFormat')),
                $item->route['from_en'] . ' - ' . $item->route['to_en'],
                $employees->pluck('name')->implode(', '),
                $this->getTripDateTimeFormated($item)->format(config('helpers.exportDateTimeFormat')),
                $item->rider_code,
                $item->client_price,
            ];
        });
    }

    /**
     * Get all Drivers Assigend to routes to the selected company
     *
     * @return array
     */
    public function getDriversRelatedToCompany($company_id)
    {
        return Trip::where('route.company_id', (int) $company_id)
            ->select('driver_id')
            ->groupBy('driver_id')
            ->orderBy('driver_id', 'DESC')
            ->pluck('driver_id')
            ->toArray();
    }
}
