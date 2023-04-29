<?php

namespace ATPGroup\Drivers\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Drivers\Models\DriverDocument;
use ATPGroup\Drivers\Requests\Admin\StoreDriverDocumentRequest;

class DriverDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = DriverDocument::with('driver')->search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('driver::document.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('driver::document.create')->with('driverDocument', new DriverDocument);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverDocumentRequest $request)
    {
        $driverDocument = new DriverDocument;
        $driverDocument->save();
        return redirect()->route('driverDocument.index')->with('success', __('driver::language.message.document.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Drivers\Models\DriverDocument  $driverDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, DriverDocument $driverDocument)
    {
        return view('driver::document.edit')->with('driverDocument', $driverDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Drivers\Models\DriverDocument  $driverDocument
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDriverDocumentRequest $request, DriverDocument $driverDocument)
    {
        $driverDocument->save();
        return redirect()->route('driverDocument.index')->with('success', __('driver::language.message.document.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Drivers\Models\DriverDocument  $driverDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverDocument $driverDocument)
    {
        $driverDocument->delete();
        return response()->json(['status' => 'ok', 'message' => __('driver::language.message.document.deleted')]);
    }

    /**
     * Print the form for editing the specified resource.
     *
     * @param  \ATPGroup\Drivers\Models\DriverDocument  $driverDocument
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request, DriverDocument $driverDocument)
    {
        return view('driver::document.print')->with('driverDocument', $driverDocument);
    }
}
