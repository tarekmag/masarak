<?php

namespace ATPGroup\Routes\Controllers\Admin;

use Carbon\Carbon;
use App\Enums\RouteType;
use App\Services\PDFService;
use Illuminate\Http\Request;
use App\Services\TripService;
use App\Services\UserService;
use ATPGroup\Routes\Models\Trip;
use App\Services\EmployeeService;
use ATPGroup\Routes\Models\Route;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Vehicles\Models\Vehicle;
use ATPGroup\Employees\Models\Employee;
use ATPGroup\Suppliers\Models\Supplier;
use Illuminate\Support\Facades\Artisan;
use ATPGroup\Routes\Exports\TripExportExcel;
use ATPGroup\Routes\Requests\Admin\StoreTripRequest;
use ATPGroup\Routes\Requests\Admin\UpdateTripRequest;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTrips(Request $request)
    {
        $data['result'] = Trip::search($request)->orderBy('trip_time', 'DESC')->paginate(config('helpers.paginate'))->appends($request->query());
        return view('route::trip.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Route $route)
    {
        $data['route'] = $route;
        $data['employess'] = Employee::where('branch_id', $route->branch_id)->select('id', 'name')->get()->toJson();
        return view('route::trip.create')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Trip $trip)
    {
        $data['trip'] = $trip;
        $data['statusArray'] = json_encode(app(TripService::class)->getStatusOfReasonsTrip());
        return view('route::trip.show')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        if (!$trip) {
            return redirect()->back();
        }

        $supplier = Supplier::find($request->supplier_id);
        $vehicle = Vehicle::find($request->vehicle_id);

        $trip->update([
            'rider_code' => $request->rider_code,
            'client_price' => $request->client_price,
            'driver_price' => $request->driver_price,
            'trip_date' => $request->start_date,
            'trip_time' => Carbon::parse($request->start_date . ' ' . $request->start_time)->format('Y-m-d H:i'),
            'trip_day' => strtolower($request->date('start_date')->format('l')),
            'supplier_id' => (int) $request->supplier_id,
            'supplier' => optional($supplier)->only(['id', 'name_ar', 'name_en']),
            'driver_id' => (int) $request->driver_id,
            'driver' => Driver::find($request->driver_id)->only(['id', 'supplier_id', 'name', 'mobile_number', 'personal_photo', 'type']),
            'vehicle_id' => (int) $request->vehicle_id,
            'vehicle' => $vehicle->only(['id', 'brand_id', 'brand_model_id', 'plate_number', 'color_en', 'color_ar', 'color_code', 'number_seats', 'vehicle_year']),
            'vehicle_brand_id' => $vehicle->brand->id,
            'vehicle_brand' => $vehicle->brand->only(['id', 'name_ar', 'name_en']),
            'vehicle_brand_model_id' => $vehicle->brandModel->id,
            'vehicle_brand_model' => $vehicle->brandModel->only(['id', 'name_ar', 'name_en']),
            'status' => $request->status,
            'status_action_reasons' => $request->status_action_reasons,
            'status_action_by' => (in_array($request->status, app(TripService::class)->getStatusOfReasonsTrip())) ? app(UserService::class)->userObject(auth()->user()) : null,
            'type' => RouteType::SCHEDULE_MODIFIED,
            'modified_by' => app(UserService::class)->userObject(auth()->user()),
            'class' => $request->class
        ]);

        return redirect()->route('route.showTrip', [$trip->_id])->with('success', __('route::language.trip.message.updated'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripRequest $request)
    {
        $vehicle = Vehicle::find($request->vehicle_id);
        $supplier = Supplier::find($request->supplier_id);
        $employeeLeader = Employee::whereIn('id', collect($request->employee_ids)->collapse())->leader()->first();
        $allEmployeesNotAdded = [];

        // $allEmployeesNotAdded = Employee::whereNotIn('id', collect($request->employee_ids)->collapse())->get()->map(function($employee) {
        //   return app(EmployeeService::class)->employeeObject($employee);
        // })->toArray();

        $stations = Station::whereIn('id', $request->station_ids)->get()->map(function ($item) use ($request) {
            $employees = collect();
            if (isset($request->employee_ids[array_search($item->id, $request->station_ids)])) {
                $employeesList = Employee::findMany($request->employee_ids[array_search($item->id, $request->station_ids)]);
                foreach ($employeesList as $employee) {
                    $employees->push(app(EmployeeService::class)->employeeObject($employee));
                }
            }

            $lat = ($request->is_return) ? $item->drop_lat : $item->pickup_lat;
            $lng = ($request->is_return) ? $item->drop_lng : $item->pickup_lng;
            data_set($item, 'lat', (float) $lat);
            data_set($item, 'lng', (float) $lng);
            data_set($item, 'status', true);
            data_set($item, 'arrival_time', null);
            data_set($item, 'employees', $employees->all());
            return $item->only(['id', 'name_ar', 'name_en', 'lat', 'lng', 'status', 'arrival_time', 'employees']);
        })->toArray();

        $data = [
            'route_id' => (int) $request->route_id,
            'route' => Route::find($request->route_id)->only(['id', 'company_id', 'branch_id', 'from_en', 'from_ar', 'to_en', 'to_ar']),
            'route_schedule_id' => (int) 0,
            'route_schedule' => null,
            'rider_code' => $request->rider_code,
            'supplier_id' => (int) $request->supplier_id,
            'supplier' => optional($supplier)->only(['id', 'name_ar', 'name_en']),
            'driver_id' => (int) $request->driver_id,
            'driver' => Driver::find($request->driver_id)->only(['id', 'supplier_id', 'name', 'mobile_number', 'personal_photo', 'type']),
            'vehicle_id' => (int) $request->vehicle_id,
            'vehicle' => $vehicle->only(['id', 'brand_id', 'brand_model_id', 'plate_number', 'color_en', 'color_ar', 'color_code', 'number_seats', 'vehicle_year']),
            'vehicle_brand_id' => $vehicle->brand->id,
            'vehicle_brand' => $vehicle->brand->only(['id', 'name_ar', 'name_en']),
            'vehicle_brand_model_id' => $vehicle->brandModel->id,
            'vehicle_brand_model' => $vehicle->brandModel->only(['id', 'name_ar', 'name_en']),
            'trip_date' => $request->start_date,
            'trip_time' => Carbon::parse($request->start_date . ' ' . $request->start_time)->format('Y-m-d H:i'),
            'trip_day' => strtolower($request->date('start_date')->format('l')),
            'client_price' => (int) $request->client_price,
            'driver_price' => (int) $request->driver_price,
            'type' => RouteType::SCHEDULE_MANUAL,
            'modified_by' => null,
            'class' => $request->class,
            'arrival_allowance' => (int) 0,
            'is_return' => (bool) ($request->is_return) ? true : false,
            'is_active' => (bool) true,
            'status' => $request->status,
            'status_action_reasons' => null,
            'status_action_by' => null,
            'driver_confirmed' => (bool) false,
            'driver_confirmed_notified_to_admin' => (bool) false,
            'employee_leader' => app(EmployeeService::class)->employeeObject($employeeLeader),
            'employees' => (array) $allEmployeesNotAdded,
            'employees_count' => (int) count($request->employee_ids),
            'stations' => (array) $stations,
            'route_coordinates' => (array) [],
            'stations_coordinates' => (array) [],
        ];

        $trip = new Trip;
        $trip->fill($data);
        $trip->save();

        return response()->json(['status' => 'ok', 'message' => __('route::language.trip.message.created')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Trip::whereIn('_id', $request->selectedItems)->get()->map(function ($item) use ($request) {
            $item->update([
                'status' => $request->status,
                'status_action_reasons' => $request->status_action_reasons,
                'status_action_by' => (in_array($request->status, app(TripService::class)->getStatusOfReasonsTrip())) ? app(UserService::class)->userObject(auth()->user()) : null,
                'type' => RouteType::SCHEDULE_MODIFIED,
                'modified_by' => app(UserService::class)->userObject(auth()->user()),
            ]);
        })->toArray();
        return response()->json(['status' => 'ok', 'message' => __('route::language.message.updated')]);
    }

    /**
     * Dispatch Trips the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dispatchTrips(Request $request, Route $route)
    {
        Artisan::call('trip:create', ['routeId' => $route->id]);
        return redirect()->route('route.edit', [$route->id])->with('success', __('route::language.trip.message.dispatchUpdated'));
    }

    /**
     * Display a listing of Branches the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrips(Request $request)
    {
        $result = Trip::where('route_id', (int) $request->route_id)
            ->when($request->filled('status'), function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->get()
            ->map(function ($item) {
                return ['id' => $item->_id, 'text' => $item->route_name . '-' . $item->trip_time->format(config('helpers.timeFormat'))];
            });

        return response()->json(['status' => 'ok', 'data' => $result]);
    }

    /**
     * Export PDF Trips.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPDFTrips(Request $request)
    {
        $result = app(TripService::class)->exportQuery($request);
        return app(PDFService::class)->export($request->start_date, $request->end_date, $result->toArray(), 'route::exports.pdf');
    }

    /**
     * Export Excel Trips.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcelTrips(Request $request)
    {
        return new TripExportExcel;
    }
}
