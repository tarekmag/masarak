<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushTripTrackingRouteCoordinateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $company_id;
    public $trip_id;
    public $coordinates;
    public $route_from_name_en;
    public $route_from_name_ar;
    public $route_to_name_en;
    public $route_to_name_ar;
    public $driver_name;
    public $driver_phone;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($company_id, $trip_id, $coordinates, $route_from_name_en, $route_from_name_ar, $route_to_name_en, $route_to_name_ar, $driver_name, $driver_phone)
    {
        $this->company_id = $company_id;
        $this->trip_id = $trip_id;
        $this->coordinates = $coordinates;
        $this->route_from_name_en = $route_from_name_en;
        $this->route_from_name_ar = $route_from_name_ar;
        $this->route_to_name_en = $route_to_name_en;
        $this->route_to_name_ar = $route_to_name_ar;
        $this->driver_name = $driver_name;
        $this->driver_phone = $driver_phone;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-routing-trip');
    }

    public function broadcastAs()
    {
        return 'event-tracking-trip';
    }

    // public function broadcastWith()
    // {
    //     return [
    //         'id' => $this->user->id,
    //         'name' => $this->user->name,
    //         'score' => $this->user->score
    //     ];
    // }
}
