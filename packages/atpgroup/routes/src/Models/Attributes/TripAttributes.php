<?php

namespace ATPGroup\Routes\Models\Attributes;

use App\Services\TripService;

trait TripAttributes
{
    /**
     * Get Trip date and time
     */
    public function getTripDateTimeAttribute()
    {
        return $this->trip_date->format(config('helpers.dateFormat')) . ' ' . $this->trip_time->format(config('helpers.timeFormat12'));
    }

    /**
     * Get vehicle type with brand
     */
    public function getVehicleTypeWithModelAttribute()
    {
        return (isset($this->vehicle_brand) && isset($this->vehicle_brand_model)) ? $this->vehicle_brand['name_' . app()->getLocale()] . ' ' . $this->vehicle_brand_model['name_' . app()->getLocale()] : '';
    }

    /**
     * Get capacity
     */
    public function getCapacityAttribute()
    {
        return (isset($this->vehicle['number_seats'])) ? $this->vehicle['number_seats'] . '/' . $this->employees_count : '0/0';
    }

    /**
     * Get client price formated
     */
    public function getClientPriceFormatedAttribute()
    {
        return number_format($this->client_price) . ' ' . __('route::language.field.tripTable.EGP');
    }

    /**
     * Get driver price formated
     */
    public function getDriverPriceFormatedAttribute()
    {
        return number_format($this->driver_price) . ' ' . __('route::language.field.tripTable.EGP');
    }

    /**
     * Get route name
     */
    public function getRouteNameAttribute()
    {
        return (isset($this->route)) ? $this->route['from_' . app()->getLocale()] . ' - ' . $this->route['to_' . app()->getLocale()] : '';
    }

    /**
     * Get Arrival Allowance Diff Time
     */
    public function getArrivalAllowanceDiffTimeAttribute()
    {
        return app(TripService::class)->getExceededArrivalAllowanceTimeForFirstStation($this);
    }
}
