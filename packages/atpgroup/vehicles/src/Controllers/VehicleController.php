<?php

namespace ATPGroup\Vehicles\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DriverService;
use ATPGroup\Vehicles\Models\Vehicle;
use ATPGroup\Vehicles\Requests\StoreVehicleRequest;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Vehicle::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('vehicle::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle::create')->with('vehicle', new Vehicle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle = new Vehicle;
        $vehicle->save();
        if ($request->filled('driver_id')) {
            app(DriverService::class)->assigDriverVehicle($request->driver_id, $vehicle->id);
        }
        return redirect()->route('vehicle.index')->with('success', __('vehicle::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Vehicle\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Vehicle $vehicle)
    {
        return view('vehicle::edit')->with('vehicle', $vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Vehicle\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->save();
        return redirect()->route('vehicle.index')->with('success', __('vehicle::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Vehicle\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json(['status' => 'ok', 'message' => __('vehicle::language.message.deleted')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Vehicle\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function activated(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->is_active == 0) {
            $vehicle->update(['is_active' => 1]);
        } else {
            $vehicle->update(['is_active' => 0]);
        }

        return response()->json(['status' => 'ok', 'message' => __('vehicle::language.message.updated')]);
    }
}
