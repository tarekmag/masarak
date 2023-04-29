<?php

namespace ATPGroup\Routes\Models\Attributes;

use ATPGroup\Stations\Models\Station;

trait Attributes
{
    function getLabelIdAttribute()
    {
        return 'R'.$this->id;
    }

    function getTypeLangAttribute()
    {
        return __('route::language.field.type.'.$this->type);
    }

    function getStationsCoordinatesAttribute()
    {
        return $this->stations->map(function($item){
            if($station = $item->station)
            {
                return [$station->pickup_lat, $station->pickup_lng];
            }
        });
    }

    /**
     * Get Name Attribute .
     *
     * @return string
     */
    public function getRouteNameAttribute()
    {
        return $this->from .' - '. $this->to;
    }

}