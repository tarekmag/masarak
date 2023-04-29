<?php

namespace ATPGroup\Drivers\Controllers\API\OTP;

use App\Services\DriverService;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use ATPGroup\Drivers\Requests\API\SendOTPRequest;
use ATPGroup\Drivers\Requests\API\SendOTPMobileNumberRequest;

class SendOTPCodeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | VerifyOTPCode Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    public function send(SendOTPRequest $request)
    {
        app(DriverService::class)->addDeviceToken(Driver::whereMobileNumber($request->mobile_number)->first(), $request);
        app(DriverService::class)->sendOTP($request->mobile_number);
        return responseSuccessMessage(__('driver::language.api.message.successSendCode'));
    }

    public function mobileNumberRequestSendOtpCode(SendOTPMobileNumberRequest $request)
    {
        app(DriverService::class)->sendMobileNumberRequestOTP(auth('api')->user(), $request->mobile_number);
        return responseSuccessMessage(__('driver::language.api.message.successSendCode'));
    }
}
