<?php

namespace ATPGroup\Notifications\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'title' => __($this->data['title']),
            'body' => __($this->data['body']),
            'data' => $this->data['data'],
            'read_at' => ($this->read_at) ? $this->read_at->format(config('helpers.dateTimeFormat12')) : $this->read_at,
            'created_at' => $this->created_at->format(config('helpers.dateTimeFormat12')),
            'calculate_time' => $this->created_at->diffForHumans(),
        ];
    }
}
