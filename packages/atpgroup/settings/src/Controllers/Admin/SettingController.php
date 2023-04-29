<?php

namespace ATPGroup\Settings\Controllers\Admin;

use App\Http\Controllers\Controller;
use ATPGroup\Settings\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Setting::all();
        return view('setting::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->settingKeys as $key => $item) {
            $setting = Setting::find($key);
            switch ($setting->setting_form_type) {
                case 'input':
                    if ($setting->setting_type == 'number') {
                        $setting->setting_value = ($item == '') ? 0 : $item;
                    } elseif ($setting->setting_type == 'time') {
                        $setting->setting_value = ($item == '') ? '00:00:00' : date('h:i:s', strtotime($item));
                    } elseif (in_array($setting->setting_type, ['url', 'text'])) {
                        $setting->setting_value = $item;
                    }
                    break;

                case 'textarea':
                    $setting->setting_value = $item;
                    break;

                case 'checkbox':
                    $setting->setting_value = $item;
                    break;

                case 'image':
                    $setting->setting_value = $item[0];
                    break;
            }
            $setting->save();
        }
        return redirect()->route('setting.index')->with('success', __('setting::language.message.updated'));
    }

}
