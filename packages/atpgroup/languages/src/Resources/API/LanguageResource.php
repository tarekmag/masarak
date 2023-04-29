<?php

namespace ATPGroup\Languages\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'direction' => $this->direction,
            'created_at' => $this->created_at->format(config('helpers.dateTimeFormat12')),
            'updated_at' => $this->updated_at->format(config('helpers.dateTimeFormat12')),
        ];
    }
}
