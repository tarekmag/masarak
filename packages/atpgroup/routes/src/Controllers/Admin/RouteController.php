<?php

namespace ATPGroup\Routes\Controllers\Admin;

use App\Enums\RouteType;
use Illuminate\Http\Request;
use ATPGroup\Routes\Models\Route;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use ATPGroup\Vehicles\Models\Vehicle;
use ATPGroup\Suppliers\Models\Supplier;
use ATPGroup\Routes\Models\RouteStation;
use ATPGroup\Routes\Models\RouteSchedule;
use ATPGroup\Routes\Requests\Admin\StoreRouteRequest;
use ATPGroup\Routes\Requests\Admin\UpdateRouteStationRequest;
use ATPGroup\Routes\Requests\Admin\UpdateRouteScheduleRequest;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Route::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('route::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('route::create')->with('route', new Route);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRouteRequest $request)
    {
        $route = new Route;
        $route->save();
        return response()->json(['status' => 'ok', 'message' => __('route::language.message.created')]);
        // return redirect()->route('route.index')->with('success', __('route::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Route $route)
    {
        $data['route'] = $route;
        $data['scheduleTypes'] = [RouteType::SCHEDULE_SCHEDULED, RouteType::SCHEDULE_SPECIAL_REQUEST];
        $data['types'] = [RouteType::ECONOMY, RouteType::BUSINESS];
        $data['weekdays'] = [
            RouteType::SUNDAY,
            RouteType::MONDAY,
            RouteType::TUESDAY,
            RouteType::WEDNESDAY,
            RouteType::THURSDAY,
            RouteType::FRIDAY,
            RouteType::SATURDAY,
        ];
        $data['drivers'] = Driver::whereNull('supplier_id')->active()->get();
        $data['vehicles'] = Vehicle::active()->get();
        $data['suppliers'] = Supplier::get();
        $data['routeSchedules'] = $route->schedules;
        return view('route::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRouteRequest $request, Route $route)
    {
        $route->save();
        return response()->json(['status' => 'ok', 'message' => __('route::language.message.updated')]);
        // return redirect()->route('route.index')->with('success', __('route::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return response()->json(['status' => 'ok', 'message' => __('route::language.message.deleted')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function updateStation(UpdateRouteStationRequest $request, Route $route)
    {
        RouteStation::where('route_id', $route->id)->delete();

        $stations = collect($request->station_ids);
        $filterd = $stations->filter(function ($item) {
            return $item != null;
        });

        $filterd->map(function ($station_id) use($route) {
            RouteStation::create(['route_id' => $route->id, 'station_id' => $station_id]);
        });

        return response()->json(['status' => 'ok', 'message' => __('route::language.message.updated'), 'data' => $filterd->toArray()]);
        // return redirect()->route('route.edit', [$route->id])->with('success', __('route::language.message.updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule(UpdateRouteScheduleRequest $request, Route $route)
    {
        $collection = collect($request->route_schedule_ids);
        $ids = collect();

        foreach ((isset($request->route_schedule_ids)) ? $request->route_schedule_ids : [] as $key => $route_schedule_id) {
            $createArray = [
                'route_id' => $route->id,
                'supplier_id' => isset($request->supplier_ids[$key]) ? $request->supplier_ids[$key] : null,
                'driver_id' => $request->driver_ids[$key],
                'vehicle_id' => isset($request->vehicle_ids[$key]) ? $request->vehicle_ids[$key]: null,
                'client_price' => ($request->client_prices[$key]) ? $request->client_prices[$key] : 0,
                'driver_price' => ($request->driver_prices[$key]) ? $request->driver_prices[$key] : 0,
                'type' => $request->schedule_types[$key],
                'class' => $request->route_types[$key],
                'days' => isset($request->days[$key]) ? $request->days[$key] : [],
                'start_date' => $request->start_dates[$key],
                'end_date' => $request->end_dates[$key],
                'start_time' => $request->times[$key],
                'arrival_allowance' => isset($request->arrival_allowances[$key]) ? $request->arrival_allowances[$key] : 0,
                'rider_code' => isset($request->rider_codes[$key]) ? $request->rider_codes[$key] : '',
                'is_return' => isset($request->is_returns[$key]) ? 1 : 0,
                'is_active' => isset($request->is_actives[$key]) ? 1 : 0,
            ];

            if ($route_schedule_id != 0) {
                $routeSchedule = RouteSchedule::firstOrCreate(['id' => $route_schedule_id]);
                $routeSchedule->fill($createArray);
                $routeSchedule->save();
            } else {
                $routeSchedule = RouteSchedule::create($createArray);
                $collection->push($routeSchedule->id);
            }

            $ids->push(['key' => $key, 'id' => $routeSchedule->id]);
        }

        RouteSchedule::where('route_id', $route->id)->whereNotIn('id', $collection->values())->delete();

        return response()->json(['status' => 'ok', 'message' => __('route::language.message.updated'), 'data' => $ids->toArray()]);
        // return redirect()->route('route.edit', [$route->id])->with('success', __('route::language.message.updated'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function getSchedules(Request $request, Route $route)
    {
        return $route->schedules()->get()->toJson();
    }
}
