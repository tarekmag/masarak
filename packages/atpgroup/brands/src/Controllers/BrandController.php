<?php

namespace ATPGroup\Brands\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Brands\Models\Brand;
use ATPGroup\Brands\Requests\StoreBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Brand::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('brand::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand::create')->with('brand', new Brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand;
        $brand->save();
        return redirect()->route('brand.index')->with('success', __('brand::language.message.created')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Brands\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Brand $brand)
    {
        return view('brand::edit')->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Brands\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->save();
        return redirect()->route('brand.index')->with('success', __('brand::language.message.updated'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Brands\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['status' => 'ok', 'message' => __('brand::language.message.deleted')]);
    }
}
