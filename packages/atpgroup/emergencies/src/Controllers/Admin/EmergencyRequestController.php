<?php

namespace ATPGroup\Emergencies\Controllers\Admin;

use App\Http\Controllers\Controller;
use ATPGroup\Emergencies\Models\EmergencyRequest;
use Illuminate\Http\Request;

class EmergencyRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = EmergencyRequest::search($request)->orderby('id', 'DESC')->paginate(config('helpers.paginate'));
        return view ('emergency::emergencyRequest.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Emergencies\Models\EmergencyRequest  $emergencyRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmergencyRequest $emergencyRequest)
    {
        $emergencyRequest->delete();
        return response()->json(['status' => 'ok', 'message' => __('emergency::language.message.deleted')]);
    }

}
