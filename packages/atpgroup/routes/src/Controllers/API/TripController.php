<?php

namespace ATPGroup\Routes\Controllers\API;

use App\Enums\RouteType;
use App\Enums\NotifyType;
use Illuminate\Http\Request;
use App\Services\TripService;
use App\Services\DriverService;
use ATPGroup\Routes\Models\Trip;
use App\Http\Controllers\Controller;
use ATPGroup\Routes\Resources\API\TripResource;
use ATPGroup\Routes\Requests\API\DriverConfirmRequest;
use ATPGroup\Routes\Requests\API\TripChangeStatusRequest;
use ATPGroup\Routes\Requests\API\StoreTripCoordinateRequest;
use ATPGroup\Routes\Requests\API\StoreDriverCoordinateRequest;
use ATPGroup\Routes\Requests\API\StoreStationCoordinateRequest;
use ATPGroup\Routes\Requests\API\UpdateLocationEmployeeRequest;
use ATPGroup\Routes\Requests\API\StoreArrivalStationTimeRequest;


class TripController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDriverCoordinate(StoreDriverCoordinateRequest $request)
    {
        info('addDriverCoordinate', $request->all());
        app(DriverService::class)->pushDriverTrackingCoordinate(auth('api')->id(), $request->coordinates);
        return responseSuccessMessage(__('route::language.api.message.updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTripCoordinate(StoreTripCoordinateRequest $request)
    {
        info('addTripCoordinate', $request->all());
        app(TripService::class)->pushTripTrackingRouteCoordinate($request->trip_id, $request->coordinates);
        return responseSuccessMessage(__('route::language.api.message.updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addArrivalStationTime(StoreArrivalStationTimeRequest $request)
    {
        app(TripService::class)->addArrivalStationTime($request->trip_id, $request, true);
        $trip = Trip::find($request->trip_id);
        return responseSuccessData(new TripResource($trip));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCompleteStation(StoreStationCoordinateRequest $request)
    {
        app(TripService::class)->addCompleteStation($request->trip_id, $request, true);
        $trip = Trip::find($request->trip_id);
        return responseSuccessData(new TripResource($trip));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpcoming(Request $request)
    {
        $result = Trip::where('driver_id', auth('api')->id())->filter('upcoming')->get();
        return responseSuccessData(TripResource::collection($result));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFuture(Request $request)
    {
        $result = Trip::where('driver_id', auth('api')->id())->filter('future')->paginate(config('helpers.paginate'));
        return responsePaginate(TripResource::collection($result));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHistory(Request $request)
    {
        $result = Trip::where('driver_id', auth('api')->id())->filter('history')->paginate(config('helpers.paginate'));
        return responsePaginate(TripResource::collection($result));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingleTrip(Request $request)
    {
        $trip = Trip::where('driver_id', auth('api')->id())->where('_id', $request->trip_id)->first();
        if (!$trip) {
            return responseErrorMessage(__('route::language.trip.message.notFound'));
        }
        return responseSuccessData(new TripResource($trip));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tripChangeStatus(TripChangeStatusRequest $request)
    {
        $trip = Trip::find($request->trip_id);

        if ($request->status == RouteType::TRIP_STATUS_STARTED && app(TripService::class)->checkForCanConfirmTrip($trip) == false) {
            //return responseErrorMessage(__('route::language.api.message.driverNotConfirmError'));
        }

        $trip->status = $request->status;
        $trip->save();

        if ($request->status == RouteType::TRIP_STATUS_COMPLETED) {
            app(DriverService::class)->pushTypeNotify(NotifyType::DRIVER_COMPLETED_TRIP, $trip->driverRelation, ['trip' => $trip]);
        }

        return responseSuccessData(new TripResource($trip));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLocationEmployee(UpdateLocationEmployeeRequest $request)
    {
        $status = app(TripService::class)->updateLocationEmployee($request->trip_id, $request);
        if (!$status) {
            return responseErrorMessage(__('route::language.api.message.updateLocationError'));
        }
        $trip = Trip::find($request->trip_id);
        return responseSuccessData(new TripResource($trip));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function driverConfirm(DriverConfirmRequest $request)
    {
        $status = app(TripService::class)->driverConfirmTrip($request->trip_id, $request);
        if (!$status) {
            return responseErrorMessage(__('route::language.api.message.driverConfirmError'));
        }
        $trip = Trip::find($request->trip_id);
        return responseSuccessData(new TripResource($trip));
    }
}
