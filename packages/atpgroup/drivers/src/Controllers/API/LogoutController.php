<?php

namespace ATPGroup\Drivers\Controllers\API;

use App\Services\DriverService;
use App\Http\Controllers\Controller;
use ATPGroup\Drivers\Requests\API\LogoutRequest;

class LogoutController extends Controller
{
    /**
     * Logout .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(LogoutRequest $request)
    {
        return app(DriverService::class)->logoutPassport(auth('api')->user(), $request);
    }
}
