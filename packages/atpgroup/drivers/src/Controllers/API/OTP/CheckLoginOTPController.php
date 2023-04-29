<?php

namespace ATPGroup\Drivers\Controllers\API\OTP;

use App\Services\DriverService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use ATPGroup\Drivers\Requests\API\CheckLoginRequest;

class CheckLoginOTPController extends Controller
{
    /**
     * Check Credentials .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCredentials(CheckLoginRequest $request)
    {
        $credentials = ['mobile_number' => $request->input('mobile_number'), 'password' => $request->input('password'), 'is_active' => true];

        if (!Auth::guard('driver')->attempt($credentials, $request->remember)) {
            return responseErrorMessage(__('driver::language.api.message.wrongPhoneOrPassword'));
        }

        app(DriverService::class)->addDeviceToken(auth('driver')->user(), $request);
        app(DriverService::class)->sendOTP(auth('driver')->user()->mobile_number);

        return responseSuccessMessage(__('driver::language.api.message.successSendCode'));
    }
}
