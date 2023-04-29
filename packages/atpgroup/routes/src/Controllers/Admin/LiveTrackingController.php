<?php

namespace ATPGroup\Routes\Controllers\Admin;

use Illuminate\Http\Request;
use ATPGroup\Routes\Models\Trip;
use App\Http\Controllers\Controller;


class LiveTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liveTracking(Request $request)
    {
        $data['trips'] = Trip::started()->search($request)->get()->map(function ($item) {
            return [
                'trip_id' => $item->_id,
                'stations_coordinates' => $item->stations_coordinates,
                'route_coordinates' => $item->route_coordinates,
                'route_from_name_en' => '',
                'route_from_name_ar' => '',
                'route_to_name_en' => '',
                'route_to_name_ar' => '',
                'driver_name' => '',
                'driver_phone' => '',
                'plate_number' => '',
            ];
        });

        if ($company_id = auth()->user()->company_id) {
            $data['company_id'] = $company_id;
            return view('route::liveTracking.company')->with($data);
        }

        return view('route::liveTracking.admin')->with($data);
    }
}
