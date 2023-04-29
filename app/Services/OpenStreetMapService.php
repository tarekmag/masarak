<?php

namespace App\Services;

use App\Services\TranslateService;
use Illuminate\Support\Facades\Http;

class OpenStreetMapService
{
    /**
     * Get the address from coordinates with lat and lng
     *
     * @return string
     */
    public function getCoordinatesAddressTitle($lat, $lng)
    {
        try {
            $response = Http::get('https://nominatim.openstreetmap.org/reverse', [
                'lat' => $lat,
                'lon' => $lng,
                'format' => "json"
            ]);
            if($response->ok())
            {
                $data = $response->json();
                $addressTitleAr = $data['address']['road'];
                $addressAr = $data['display_name'];

                $addressTitleEN = app(TranslateService::class)->getTranslate($addressTitleAr, 'ar', 'en');
                $addressEN = app(TranslateService::class)->getTranslate($addressAr, 'ar', 'en');

                $result = [
                    'address_title_ar' => $addressTitleAr,
                    'address_ar' => $addressAr,
                    'address_title_en' => $addressTitleEN,
                    'address_en' => $addressEN,
                ];
                return ['status' => true, 'data' => $result];
            }
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'data' => [
                    'address_title_ar' => null,
                    'address_ar' => null,
                    'address_title_en' => null,
                    'address_en' => null
                ]
            ];
        }
    }
}
