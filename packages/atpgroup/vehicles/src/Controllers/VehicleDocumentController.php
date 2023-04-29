<?php

namespace ATPGroup\Vehicles\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Vehicles\Models\VehicleDocument;
use ATPGroup\Vehicles\Requests\StoreVehicleDocumentRequest;

class VehicleDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = VehicleDocument::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('vehicle::document.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle::document.create')->with('vehicleDocument', new VehicleDocument);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleDocumentRequest $request)
    {
        $vehicleDocument = new VehicleDocument;
        $vehicleDocument->save();
        return redirect()->route('vehicleDocument.index')->with('success', __('vehicle::language.message.document.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Vehicles\Models\VehicleDocument  $vehicleDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, VehicleDocument $vehicleDocument)
    {
        return view('vehicle::document.edit')->with('vehicleDocument', $vehicleDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Vehicles\Models\VehicleDocument  $vehicleDocument
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVehicleDocumentRequest $request, VehicleDocument $vehicleDocument)
    {
        $vehicleDocument->save();
        return redirect()->route('vehicleDocument.index')->with('success', __('vehicle::language.message.document.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Vehicles\Models\VehicleDocument  $vehicleDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDocument $vehicleDocument)
    {
        $vehicleDocument->delete();
        return response()->json(['status' => 'ok', 'message' => __('vehicle::language.message.document.deleted')]);
    }

    /**
     * Print the form for editing the specified resource.
     *
     * @param  \ATPGroup\Vehicles\Models\VehicleDocument  $vehicleDocument
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request, VehicleDocument $vehicleDocument)
    {
        return view('vehicle::document.print')->with('vehicleDocument', $vehicleDocument);
    }
}
