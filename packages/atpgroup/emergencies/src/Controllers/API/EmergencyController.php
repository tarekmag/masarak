<?php

namespace ATPGroup\Emergencies\Controllers\API;

use Illuminate\Http\Request;
use App\Services\NotifyService;
use App\Http\Controllers\Controller;
use ATPGroup\Emergencies\Models\Emergency;
use ATPGroup\Emergencies\Models\EmergencyRequest;
use ATPGroup\Emergencies\Resources\API\EmergencyResource;
use ATPGroup\Emergencies\Requests\API\StoreEmergencyRequest;

class EmergencyController extends Controller
{
    /**
     * Emergencies .
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmergencies(Request $request)
    {
        $result = Emergency::active()->search($request)->orderBy('id', 'DESC')->get();
        return responseSuccessData(EmergencyResource::collection($result));
    }

    /**
     * Emergencies .
     *
     * @return \Illuminate\Http\Response
     */
    public function postEmergencyRequest(StoreEmergencyRequest $request)
    {
        $emergencyRequest = new EmergencyRequest;
        $emergencyRequest->fill($request->all());
        $emergencyRequest->save();
       
        app(NotifyService::class)->pushTypeNotify('emergencyRequest', $emergencyRequest, $request->only(['trip_name', 'driver_name']));

        return responseSuccessMessage(__('emergency::language.message.created'));
    }
}