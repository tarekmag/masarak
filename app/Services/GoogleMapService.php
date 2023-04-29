<?php

namespace App\Services;

use Spatie\Geocoder\Geocoder;

class GoogleMapService 
{
    protected $geocoder;

    /**
     * Create a new Service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

        $geocoder->setCountry(config('geocoder.country'));

        $this->geocoder = $geocoder;
    }

    /**
     * Get address title based on lat and lng
     *
     * @return string
     */
    public function getCoordinatesAddressTitle($lat, $lng)
    {
        try {
            $result = $this->geocoder->getAddressForCoordinates($lat, $lng);
            dd($result);
            return $result;
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return '';
        }
    }
}