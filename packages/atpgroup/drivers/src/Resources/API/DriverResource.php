<?php

namespace ATPGroup\Drivers\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile_number' => $this->mobile_number,
            'image' => $this->image_url,
            'type' => $this->type,
        ];
    }
}
