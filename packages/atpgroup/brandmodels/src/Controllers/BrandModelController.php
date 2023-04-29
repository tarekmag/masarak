<?php

namespace ATPGroup\BrandModels\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\BrandModels\Models\BrandModel;
use ATPGroup\BrandModels\Requests\StoreBrandModelRequest;
use Illuminate\Http\Request;

class BrandModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = BrandModel::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('brandModel::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brandModel::create')->with('brandModel', new BrandModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandModelRequest $request)
    {
        $brandModel = new BrandModel;
        $brandModel->save();
        return redirect()->route('brandModel.index')->with('success', __('brandModel::language.message.created')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\BrandModels\Models\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BrandModel $brandModel)
    {
        return view('brandModel::edit')->with('brandModel', $brandModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\BrandModels\Models\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandModel $brandModel)
    {
        $brandModel->save();
        return redirect()->route('brandModel.index')->with('success', __('brandModel::language.message.updated'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\BrandModels\Models\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandModel $brandModel)
    {
        $brandModel->delete();
        return response()->json(['status' => 'ok', 'message' => __('brandModel::language.message.deleted')]);
    }

    /**
     * Display a listing of Brand Models the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBrandModels(Request $request)
    {
        $result = BrandModel::where('brand_id', $request->brand_id)->get()->map(function ($item) {
            return ['id' => $item->id, 'text' => $item->name];
        });

        return response()->json(['status' => 'ok', 'data' => $result]);
    }
}
