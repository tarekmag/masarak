<?php

namespace ATPGroup\Drivers\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\DriverService;
use Illuminate\Support\Facades\DB;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use ATPGroup\Drivers\Requests\Admin\StoreDriverRequest;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['trackedDrivers'] = Driver::whereNotNull('lat')->count();
        $data['untrackedDrivers'] = Driver::whereNull('lat')->count();
        $data['activeDrivers'] = Driver::active()->count();
        $data['inactiveDrivers'] = Driver::where('is_active', false)->count();
        $data['result'] = Driver::with(['supplier', 'vehicles'])->search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('driver::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('driver::create')->with('driver', new Driver);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverRequest $request)
    {
        $driver = new Driver;
        $driver->save();
        if ($request->filled('vehicle_id')) {
            app(DriverService::class)->assigDriverVehicle($driver->id, $request->vehicle_id);
        }
        return redirect()->route('driver.index')->with('success', __('driver::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Driver\Models\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Driver $driver)
    {
        return view('driver::edit')->with('driver', $driver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Driver\Models\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDriverRequest $request, Driver $driver)
    {
        $driver->save();
        return redirect()->route('driver.index')->with('success', __('driver::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Driver\Models\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Driver $driver)
    {
        $driver->delete();
        DB::table('oauth_access_tokens')->where('user_id', $driver->id)->delete();
        return response()->json(['status' => 'ok', 'message' => __('driver::language.message.deleted')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Driver\Models\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function activated(Request $request, Driver $driver)
    {
        if ($driver->is_active == 0) {
            $driver->update(['is_active' => 1]);
        } else {
            $driver->update(['is_active' => 0]);
        }
        return response()->json(['status' => 'ok', 'message' => __('driver::language.message.updated')]);
    }

    /**
     * Display a listing of Branches the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDrivers(Request $request)
    {
        $result = Driver::where('supplier_id', $request->supplier_id)->get()->map(function ($item) {
            return ['id' => $item->id, 'text' => $item->name];
        });

        return response()->json(['status' => 'ok', 'data' => $result]);
    }
}
