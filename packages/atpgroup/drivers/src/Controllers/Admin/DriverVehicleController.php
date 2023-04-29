<?php

namespace ATPGroup\Drivers\Controllers\Admin;

use Illuminate\Http\Request;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use ATPGroup\Vehicles\Models\Vehicle;
use ATPGroup\Drivers\Models\DriverVehicle;
use ATPGroup\Drivers\Requests\Admin\StoreDriverVehicleRequest;

class DriverVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Driver::with('vehicles')->whereHas('vehicles')->search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('driver::vehicle.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('driver::vehicle.create')->with('driverVehicle', new Driver);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverVehicleRequest $request)
    {
        $driverVehicle = Driver::find($request->driver_id);
        $driverVehicle->vehicles()->sync($request->vehicle_ids);
        return redirect()->route('driverVehicle.index')->with('success', __('driver::language.message.vehicle.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Drivers\Models\Driver $driverVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Driver $driverVehicle)
    {
        return view('driver::vehicle.edit')->with('driverVehicle', $driverVehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Drivers\Models\Driver $driverVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDriverVehicleRequest $request, Driver $driverVehicle)
    {
        $driverVehicle->vehicles()->sync($request->vehicle_ids);
        return redirect()->route('driver.index')->with('success', __('driver::language.message.vehicle.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Drivers\Models\Driver $driverVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driverVehicle)
    {
        $driverVehicle->vehicles()->sync([]);
        return response()->json(['status' => 'ok', 'message' => __('driver::language.message.vehicle.deleted')]);
    }

    /**
     * Display a listing of Branches the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVehicles(Request $request)
    {
        $result = Vehicle::active()->with(['driverVehicles'])->when($request->driver_id, function ($query) use ($request) {
            return $query->whereHas('driverVehicles', function ($q) use ($request) {
                return $q->where('driver_id', $request->driver_id);
            });
        })->get()->map(function ($item) {
            return ['id' => $item->id, 'text' => $item->id . ' - ' . $item->plate_number];
        });
        return response()->json(['status' => 'ok', 'data' => $result]);
    }
}
