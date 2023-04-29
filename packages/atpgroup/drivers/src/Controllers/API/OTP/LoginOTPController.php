<?php

namespace ATPGroup\Drivers\Controllers\API\OTP;

use App\Services\DriverService;
use App\Http\Controllers\Controller;
use ATPGroup\Drivers\Requests\API\LoginRequest;

class LoginOTPController extends Controller
{
    /**
     * Login using passport .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $driver = app(DriverService::class)->checkOTPCode($request->otp_code, $request->mobile_number);
        if (!$driver) 
        {
            return responseErrorMessage(__('driver::language.api.message.codeIsInvalid'));
        }

        return app(DriverService::class)->loginPassport($driver, $request);
    }
}
