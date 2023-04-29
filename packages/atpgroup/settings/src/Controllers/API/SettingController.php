<?php

namespace ATPGroup\Settings\Controllers\API;

use App\Http\Controllers\Controller;
use ATPGroup\Settings\Models\Setting;
use ATPGroup\Settings\Resources\API\SettingResource;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSetting()
    {
        return responseSuccessData(SettingResource::collection(Setting::all()));
    }
}
