<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Enums\RouteType;
use App\Services\TripService;
use Illuminate\Console\Command;
use ATPGroup\Routes\Models\Trip;
use App\Services\EmployeeService;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Routes\Models\RouteSchedule;

class CreateTripFromRouteScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:create {routeId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Trip from routes_schedules table based on dates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routeId = $this->argument('routeId');
        $this->info('Trip Command Create Next Trip Is Start');
        $now = now()->format(config('helpers.dateFormat'));
        $dayName = strtolower(now()->format('l'));

        RouteSchedule::active()
            ->when($routeId, function ($query) use ($routeId) {
                $query->where('route_id', $routeId);
            })
            ->whereIn('type', [RouteType::SCHEDULE_SCHEDULED, RouteType::SCHEDULE_SPECIAL_REQUEST])
            ->where('start_date', '<=', $now)
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->whereJsonContains('days', $dayName)
            ->with(['route', 'supplier', 'driver', 'vehicle', 'employees'])
            ->chunk(500, function ($schedules) use ($now, $dayName) {
                $this->output->progressStart($schedules->count());
                foreach ($schedules as $schedule) {
                    $route = $schedule->route;
                    $data['schedule'] = $schedule;
                    $data['employeeLead'] = null;

                    if ($employeeLeader = app(TripService::class)->getTeamLeaderRelatedToSchedule($schedule->id)) {
                        $data['employeeLead'] = app(EmployeeService::class)->employeeObject($employeeLeader, $route->id, $schedule->id);
                    }

                    $data['employeesAll'] = app(TripService::class)->getAllEmployeesNotAssignToStation($route, $schedule->id);
                    $data['stations'] = $this->getStations($route, $schedule);

                    $data['route'] = $route->only(['id', 'company_id', 'branch_id', 'from_en', 'from_ar', 'to_en', 'to_ar']);
                    $data['routeSchedule'] = $schedule->only(['id', 'start_date', 'end_date']);
                    $data['supplier'] = optional($schedule->supplier)->only(['id', 'name_ar', 'name_en']);
                    $data['driver'] = $schedule->driver->only(['id', 'supplier_id', 'name', 'mobile_number', 'personal_photo', 'type']);
                    $data['vehicle'] = $schedule->vehicle->only(['id', 'brand_id', 'brand_model_id', 'plate_number', 'color_en', 'color_ar', 'color_code', 'number_seats', 'vehicle_year']);
                    $data['vehicleBrand'] = $schedule->vehicle->brand->only(['id', 'name_ar', 'name_en']);
                    $data['vehicleBrandModel'] = $schedule->vehicle->brandModel->only(['id', 'name_ar', 'name_en']);
                    $data['employees_display_image'] = $route->company->display_employee_image ? true : false;

                    $checkToday = $this->checkTripExisted($route, $schedule, now()->startOfDay());
                    if (!$checkToday) {
                        $dataCurrentDay = $this->tripData($data, $now, $dayName);
                        Trip::create($dataCurrentDay);
                    }

                    $this->output->progressAdvance();
                }
                $this->output->progressFinish();
            });
        $this->info('Trip Command Created Is Done');

        return Command::SUCCESS;
    }

    private function getStations($route, $schedule)
    {
        // $stationIds = array_unique(array_merge(app(TripService::class)->getAllEmployeeRelatedToSchedule($schedule->id)->pluck('station_id')->toArray(), $route->stations->pluck('station_id')->toArray()));
        $stationIds = $route->stations->pluck('station_id')->toArray();
        // return Station::findMany($stationIds)->map(function($item) use($route, $schedule) {
        return Station::orderByRaw("FIELD(id, " . implode(',', $stationIds) . ")")->findMany($stationIds)->map(function ($item) use ($route, $schedule) {
            $employees = collect();
            $allEmployeeRelatedToSchedule = app(TripService::class)->getAllEmployeeRelatedToSchedule($schedule->id, $item->id);
            foreach ($allEmployeeRelatedToSchedule as $employee) {
                if (isset($employee->employee)) {
                    $employees->push(app(EmployeeService::class)->employeeObject($employee->employee, $route->id, $schedule->id));
                }
            }
            $lat = ($schedule->is_return) ? $item->drop_lat : $item->pickup_lat;
            $lng = ($schedule->is_return) ? $item->drop_lng : $item->pickup_lng;
            data_set($item, 'lat', (float) $lat);
            data_set($item, 'lng', (float) $lng);
            data_set($item, 'status', false);
            data_set($item, 'arrival_time', null);
            data_set($item, 'employees', $employees->all());
            return $item->only(['id', 'name_ar', 'name_en', 'lat', 'lng', 'status', 'arrival_time', 'employees']);
        })->toArray();
    }

    private function checkTripExisted($route, $schedule, $date)
    {
        return Trip::where('route_id', (int) $route->id)->where('route_schedule_id', (int) $schedule->id)->where('trip_date', '=', $date)->first();
    }

    private function tripData($data, $date, $dayName)
    {
        return [
            'route_id' => (int) $data['schedule']->route_id,
            'route' => $data['route'],
            'route_schedule_id' => (int) $data['schedule']->id,
            'route_schedule' => $data['routeSchedule'],
            'supplier_id' => (int) $data['schedule']->supplier_id,
            'supplier' => $data['supplier'],
            'driver_id' => (int) $data['schedule']->driver_id,
            'driver' => $data['driver'],
            'vehicle_id' => (int) $data['schedule']->vehicle_id,
            'vehicle' => $data['vehicle'],
            'vehicle_brand_id' => $data['vehicleBrand']['id'],
            'vehicle_brand' => $data['vehicleBrand'],
            'vehicle_brand_model_id' => $data['vehicleBrandModel']['id'],
            'vehicle_brand_model' => $data['vehicleBrandModel'],
            'trip_date' => $date,
            'trip_time' => Carbon::parse($date . ' ' . $data['schedule']->start_time)->format('Y-m-d H:i'),
            'trip_day' => $dayName,
            'client_price' => (int) $data['schedule']->client_price,
            'driver_price' => (int) $data['schedule']->driver_price,
            'type' => $data['schedule']->type,
            'modified_by' => null,
            'class' => $data['schedule']->class,
            'arrival_allowance' => (int) $data['schedule']->arrival_allowance,
            'is_return' => (bool) $data['schedule']->is_return,
            'is_active' => (bool) $data['schedule']->is_active,
            'status' => RouteType::TRIP_STATUS_AVAILABLE,
            'status_action_reasons' => null,
            'status_action_by' => null,
            'rider_code' => $data['schedule']->rider_code,
            'driver_confirmed' => (bool) false,
            'driver_confirmed_notified_to_admin' => (bool) false,
            'employee_leader' => $data['employeeLead'],
            'employees' => (array) $data['employeesAll'],
            'employees_count' => (int) $data['schedule']->employees->count(),
            'employees_display_image' => (bool) $data['employees_display_image'],
            'stations' => (array) $data['stations'],
            'route_coordinates' => (array) [],
            'stations_coordinates' => (array) [],
        ];
    }
}
