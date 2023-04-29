<?php

namespace ATPGroup\Drivers\Controllers\API;

use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use App\Services\DriverService;
use ATPGroup\Drivers\Resources\API\DriverResource;
use ATPGroup\Drivers\Requests\API\UpdatePhotoRequest;
use ATPGroup\Drivers\Requests\API\ChangePasswordRequest;
use ATPGroup\Drivers\Requests\API\ChangeMobileNumberRequest;

class DriverController extends Controller
{
    /**
     * profile .
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return responseSuccessData(new DriverResource(auth('api')->user()));
    }

    /**
     * Update Presonal photo
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(UpdatePhotoRequest $request)
    {
        $driver = Driver::find(auth('api')->id());
        $driver->personal_photo = $request->personal_photo;
        $driver->unsetEventDispatcher();
        $driver->save();
        return responseSuccessData(new DriverResource($driver));
    }

    /**
     * Change Password
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $driver = Driver::find(auth('api')->id());
        $driver->password = $request->password;
        $driver->unsetEventDispatcher();
        $driver->save();
        return responseSuccessData(new DriverResource($driver));
    }

    /**
     * Change Mobile Number
     *
     * @return \Illuminate\Http\Response
     */
    public function changeMobileNumber(ChangeMobileNumberRequest $request)
    {
        $driver = Driver::find(auth('api')->id());
        $driver->mobile_number = $request->mobile_number;
        $driver->unsetEventDispatcher();
        $driver->save();
        app(DriverService::class)->resetMobileNumberRequestOTP($driver);
        return responseSuccessData(new DriverResource($driver));
    }
}
