<?php

namespace ATPGroup\Emergencies\Controllers\Admin;

use App\Http\Controllers\Controller;
use ATPGroup\Emergencies\Models\Emergency;
use ATPGroup\Emergencies\Requests\Admin\StoreEmergencyRequest;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Emergency::search($request)->orderby('id', 'DESC')->paginate(config('helpers.paginate'));
        return view ('emergency::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emergency::create')->with('emergency', new Emergency);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmergencyRequest $request)
    {
        $emergency = new Emergency;
        $emergency->save();
        return redirect()->route('emergency.index')->with('success', __('emergency::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Emergency $emergency)
    {
        return view('emergency::edit')->with('emergency', $emergency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emergency $emergency)
    {
        $emergency->save();
        return redirect()->route('emergency.index')->with('success', __('emergency::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emergency $emergency)
    {
        $emergency->delete();
        return response()->json(['status' => 'ok', 'message' => __('emergency::language.message.deleted')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function activated(Request $request, Emergency $emergency)
    {
        if ($emergency->is_active == 0) {
            $emergency->update(['is_active' => 1]);
        } else {
            $emergency->update(['is_active' => 0]);
        }
        return response()->json(['status' => 'ok', 'message' => __('emergency::language.message.updated')]);
    }
}
