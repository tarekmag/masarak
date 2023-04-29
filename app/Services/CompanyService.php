<?php

namespace App\Services;

use ATPGroup\Companies\Models\Company;
use ATPGroup\Routes\Models\Trip;

class CompanyService
{
    /**
     * Update false to all other main branch in whole company and branch
     *
     * @return string
     */
    public function updateLeaderOtherEmployee($request, $company)
    {
        if ($request->filled('main_branch')) {
            Company::where('id', $company->parent_id)->where('id', '!=', $company->id)->update(['main_branch' => false]);
        }
    }

    /**
     * Get all Stations Assigend to routes to the selected company
     *
     * @return string
     */
    public function getStationsRelatedToCompany($company)
    {
        $collect = collect();
        $company->routes->map(function ($item) use ($collect) {
            $stationIds = $item->stations->pluck('station_id');
            $collect->push($stationIds);
        });
        return $collect->collapse()->unique()->toArray();
    }

    /**
     * Get all Districts Assigend to routes to the selected company
     *
     * @return string
     */
    public function getDistrictsRelatedToCompany($company)
    {
        $districts = $company->routes->map(function ($item) {
            return $item->stations->map(function($item){
                return $item->station->district_id;
            });
        })->toArray();
        $collect = collect($districts);
        return $collect->collapse()->unique()->toArray();
    }

    /**
     * Get all Drivers Assigend to routes to the selected company
     *
     * @return array
     */
    public function getDriversRelatedToCompany($company)
    {
        return Trip::whereIn('route_id', $company->routes->pluck('id')->toArray())->select('driver_id')->groupBy('driver_id')->pluck('driver_id')->toArray();
    }

    /**
     * Get all Vehicles Assigend to routes to the selected company
     *
     * @return array
     */
    public function getVehiclesRelatedToCompany($company)
    {
        return Trip::whereIn('route_id', $company->routes->pluck('id')->toArray())->select('vehicle_id')->groupBy('vehicle_id')->pluck('vehicle_id')->toArray();
    }

    /**
     * Get all Brands Assigend to routes to the selected company
     *
     * @return array
     */
    public function getBrandsRelatedToCompany($company)
    {
        return Trip::whereIn('route_id', $company->routes->pluck('id')->toArray())->select('vehicle_brand_id')->groupBy('vehicle_brand_id')->pluck('vehicle_brand_id')->toArray();
    }

    /**
     * Get all Brand Models Assigend to routes to the selected company
     *
     * @return array
     */
    public function getBrandModelsRelatedToCompany($company)
    {
        return Trip::whereIn('route_id', $company->routes->pluck('id')->toArray())->select('vehicle_brand_model_id')->groupBy('vehicle_brand_model_id')->pluck('vehicle_brand_model_id')->toArray();
    }
}
