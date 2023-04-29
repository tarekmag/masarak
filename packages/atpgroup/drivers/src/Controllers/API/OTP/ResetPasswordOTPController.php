<?php

namespace ATPGroup\Drivers\Controllers\API\OTP;

use App\Services\DriverService;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use ATPGroup\Drivers\Requests\API\ResetPasswordRequest;

class ResetPasswordOTPController extends Controller
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

    public function reset(ResetPasswordRequest $request) 
    {
        $driver = app(DriverService::class)->checkOTPCode($request->otp_code, $request->mobile_number);
        if (!$driver) 
        {
            return responseErrorMessage(__('driver::language.api.message.codeIsInvalid'));
        }

        $driver->password = $request->password;
        $driver->unsetEventDispatcher();
        $driver->save();

        return app(DriverService::class)->loginPassport($driver, $request);
    }
}
