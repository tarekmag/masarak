<?php

namespace ATPGroup\PricingLists\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\PricingLists\Models\PricingList;
use ATPGroup\PricingLists\Requests\StorePricingListRequest;
use Illuminate\Http\Request;

class PricingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = PricingList::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('pricingList::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pricingList::create')->with('pricingList', new PricingList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePricingListRequest $request)
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\PricingLists\Models\PricingList $pricingList
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PricingList $pricingList)
    {
        return view('pricingList::edit')->with('pricingList', $pricingList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\PricingLists\Models\PricingList $pricingList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PricingList $pricingList)
    {
        $pricingList->save();
        return redirect()->route('pricingList.index')->with('success', __('pricingList::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\PricingLists\Models\PricingList $pricingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PricingList $pricingList)
    {
        $pricingList->delete();
        return response()->json(['status' => 'ok', 'message' => __('pricingList::language.message.deleted')]);
    }
}
