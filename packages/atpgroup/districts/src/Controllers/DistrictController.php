<?php

namespace ATPGroup\Districts\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Districts\Models\District;
use ATPGroup\Districts\Requests\StoreDistrictRequest;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = District::search($request)->orderby('id', 'DESC')->paginate(config('helpers.paginate'));
        return view ('district::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('district::create')->with('district', new District);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistrictRequest $request)
    {
        $district = new District;
        $district->save();
        return redirect()->route('district.index')->with('success', __('district::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Districts\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, District $district)
    {
        return view('district::edit')->with('district', $district);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Districts\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $district->save();
        return redirect()->route('district.index')->with('success', __('district::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Districts\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        return response()->json(['status' => 'ok', 'message' => __('district::language.message.deleted')]);
    }
}
