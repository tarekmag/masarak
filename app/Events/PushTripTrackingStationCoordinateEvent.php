<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushTripTrackingStationCoordinateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $company_id;
    public $trip_id;
    public $lat;
    public $lng;
    public $stations_coordinates;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($company_id, $trip_id, $lat, $lng, $stations_coordinates)
    {
        $this->company_id = $company_id;
        $this->trip_id = $trip_id;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->stations_coordinates = $stations_coordinates;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-station-trip');
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
