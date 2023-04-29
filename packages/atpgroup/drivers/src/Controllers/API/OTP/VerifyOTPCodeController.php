<?php

namespace ATPGroup\Drivers\Controllers\API\OTP;

use App\Services\DriverService;
use App\Http\Controllers\Controller;
use ATPGroup\Drivers\Requests\API\VerifyOTPCodeRequest;

class VerifyOTPCodeController extends Controller
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

    public function verifyOTPCode(VerifyOTPCodeRequest $request) 
    {
        $driver = app(DriverService::class)->checkOTPCode($request->otp_code, $request->mobile_number);
        if (!$driver) 
        {
            return responseErrorMessage(__('driver::language.api.message.codeIsInvalid'));
        }

        return responseSuccessData(__('driver::language.api.message.codeIsCorrect'));
    }
}
