<?php

namespace ATPGroup\Routes\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->_id,
            'route' => $this->route,
            'driver' => $this->driver,
            'vehicle' => $this->vehicle,
            'vehicle_brand' => $this->vehicle_brand,
            'vehicle_brand_model' => $this->vehicle_brand_model,
            'trip_day' => $this->trip_day,
            'trip_date' => $this->trip_date->format(config('helpers.dateFormat')),
            'trip_time' => $this->trip_time->format(config('helpers.timeFormat12')),
            'driver_price' => $this->driver_price,
            'type' => $this->type,
            'class' => $this->class,
            'is_return' => $this->is_return,
            'status' => $this->status,
            'driver_confirmed' => $this->driver_confirmed,
            'employees_count' => $this->employees_count,
            'employee_leader' => $this->employee_leader,
            'employees' => $this->employees,
            'employees_display_image' => $this->employees_display_image,
            'stations' => ($this->is_return) ? array_reverse($this->stations) : $this->stations,
        ];
    }
}
