<?php

namespace ATPGroup\Routes\Controllers\Admin;

use App\Enums\RouteType;
use App\Http\Controllers\Controller;
use App\Services\TripService;
use ATPGroup\Routes\Models\RouteScheduleEmployeeLocationRequest;
use Illuminate\Http\Request;


class LocationEmployeeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = RouteScheduleEmployeeLocationRequest::with('employee')->search($request)->orderby('id', 'DESC')->paginate(config('helpers.paginate'));
        return view ('route::locationEmployeeRequest.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Routes\Models\RouteScheduleEmployeeLocationRequest  $routeScheduleEmployeeLocationRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(RouteScheduleEmployeeLocationRequest $routeScheduleEmployeeLocationRequest)
    {
        $routeScheduleEmployeeLocationRequest->delete();
        return response()->json(['status' => 'ok', 'message' => __('route::language.message.deleted')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Routes\Models\RouteScheduleEmployeeLocationRequest  $routeScheduleEmployeeLocationRequest
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        RouteScheduleEmployeeLocationRequest::whereIn('id', $request->selectedItems)->get()->map(function($item) use($request) {
            if($request->status == RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_APPROVED)
            {
                app(TripService::class)->pushEmployee($item->trip, [$item->employee_id], $item->station);
            }
            if($request->status == RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_DECLINED)
            {
                app(TripService::class)->pushEmployee($item->trip, [$item->employee_id], $item->oldStation);
            }
            $item->update(['status' => $request->status, 'updated_by_id' => auth()->id()]);
        })->toArray();

        return response()->json(['status' => 'ok', 'message' => __('route::language.message.updated')]);
    }

}
