<?php

namespace ATPGroup\Stations\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Stations\Requests\StoreStationRequest;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Station::search($request)->orderby('id', 'DESC')->paginate(config('helpers.paginate'));
        return view ('station::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('station::create')->with('station', new Station);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStationRequest $request)
    {
        $station = new Station;
        $station->save();
        return redirect()->route('station.index')->with('success', __('station::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Stations\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Station $station)
    {
        return view('station::edit')->with('station', $station);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Stations\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStationRequest $request, Station $station)
    {
        $station->save();
        return redirect()->route('station.index')->with('success', __('station::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Stations\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        $station->delete();
        return response()->json(['status' => 'ok', 'message' => __('station::language.message.deleted')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAutocomplete(Request $request)
    {
        return Station::search($request)->orderby('name_en', 'DESC')->get()->map(function($item){
            return ['id' => $item->id, 'name' => $item->name];
        })->toJson();
    }
}
