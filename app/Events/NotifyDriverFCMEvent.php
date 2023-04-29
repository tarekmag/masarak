<?php

namespace App\Events;

use ATPGroup\Drivers\Models\Driver;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use ATPGroup\Notifications\Notifications\DriverNotification;

class NotifyDriverFCMEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $driverIds;
    public $title;
    public $body;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($driverIds, $title, $data = null, $body = null)
    {
        $this->tokens = $this->getTokens($driverIds, $title, $data, $body);
        $this->title = $title;
        $this->data = $data;
        $this->body = $body;
        $this->driverIds = $driverIds;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notify-fcm');
    }

    private function getTokens($driverIds)
    {
        if (!is_array($driverIds)) {
            $driverIds = [$driverIds];
        }
        $tokens = Driver::whereIn('id', $driverIds)
            ->with('devices')
            ->whereHas('devices', function ($query) {
                $query->where('is_login', true);
            })
            ->get()
            ->map(function ($item) {
                return $item->devices()->pluck('token');
            })->toArray();

        $collect = collect($tokens);
        return $collect->collapse()->values()->all();
    }
}
