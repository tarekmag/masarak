<?php

namespace App\Events;

use ATPGroup\Users\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use ATPGroup\Notifications\Notifications\UserNotification;

class NotifyUserFCMEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userIds;
    public $title;
    public $body;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userIds, $title, $data = null, $body = null)
    {
        $this->tokens = $this->getTokens($userIds, $title, $data, $body);
        $this->title = $title;
        $this->data = $data;
        $this->body = $body;
        $this->userIds = $userIds;
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

    private function getTokens($userIds, $title, $data, $body)
    {
        if (!is_array($userIds)) {
            $userIds = [$userIds];
        }

        $tokens = User::whereIn('id', $userIds)
            ->with('devices')
            ->whereHas('devices', function ($query) {
                $query->where('is_login', true);
            })
            ->get()
            ->map(function ($item) use ($title, $data, $body) {
            $item->notify(new UserNotification($title, $data, $body));
            return $item->devices()->pluck('token');
        })->toArray();
        
        $collect = collect($tokens);
        
        return $collect->collapse()->values()->all();
    }
}
