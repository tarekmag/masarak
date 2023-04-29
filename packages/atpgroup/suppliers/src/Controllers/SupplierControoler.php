<?php

namespace ATPGroup\Suppliers\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Suppliers\Models\Supplier;
use ATPGroup\Suppliers\Requests\StoreSupplierRequest;
use Illuminate\Http\Request;

class SupplierControoler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Supplier::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('supplier::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier::create')->with('supplier', new Supplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = new Supplier;
        $supplier->save();
        return redirect()->route('supplier.index')->with('success', __('supplier::language.message.created')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Suppliers\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Supplier $supplier)
    {
        return view('supplier::edit')->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Suppliers\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->save();
        return redirect()->route('supplier.index')->with('success', __('supplier::language.message.updated'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Suppliers\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['status' => 'ok', 'message' => __('supplier::language.message.deleted')]);
    }
}
