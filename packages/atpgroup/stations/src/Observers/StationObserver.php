<?php

namespace ATPGroup\Stations\Observers;

use App\Services\OpenStreetMapService;

class StationObserver
{
    /**
     * Handle the Station "saving" event.
     *
     * @param  \ATPGroup\Stations\Models\Station  $station
     * @return void
     */
    public function saving($station)
    {
        $request = request();

        if($request->filled('pickup_lat'))
        {
            $response = app(OpenStreetMapService::class)->getCoordinatesAddressTitle($request->pickup_lat, $request->pickup_lng);
        }
        else
        {
            $response = app(OpenStreetMapService::class)->getCoordinatesAddressTitle($request->drop_lat, $request->drop_lng);
        }

        $data = $response['data'];

        if(!$request->filled('name_ar'))
        {
            $request->merge(['name_ar' => $data['address_title_ar'] ?? 'غير معروف']);
        }

        if(!$request->filled('name_en'))
        {
            $request->merge(['name_en' => $data['address_title_en'] ?? 'unknown']);
        }

        if(!$request->filled('address_ar'))
        {
            $request->merge(['address_ar' => $data['address_ar']]);
        }

        if(!$request->filled('address_en'))
        {
            $request->merge(['address_en' => $data['address_en']]);
        }
        $station->fill($request->all());
    }

    /**
     * Handle the Station "deleting" event.
     *
     * @param  \ATPGroup\Stations\Models\Station  $station
     * @return void
     */
    public function deleting($station)
    {
        //
    }

}
