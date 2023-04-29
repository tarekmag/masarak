<?php

namespace App\Services;

use ATPGroup\Users\Models\User;
use App\Events\NotificationPusherEvent;
use ATPGroup\Notifications\Notifications\UserNotification;

class UserService
{
    /**
     * Update false to all other leader in whole company and branch
     *
     * @return string
     */
    public function userObject($user)
    {
        if (!$user) {
            return null;
        }
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image_url,
        ];
    }

    /**
     * Send Notify To All Admins
     *
     * @return string
     */
    public function sendNotifyToAllAdmins($title, $body, $data, $isRealTime = true)
    {
        User::whereHas('role', function ($query) {
            return $query->where('is_super', true);
        })
            ->get()
            ->map(function ($user) use ($title, $data, $body, $isRealTime) {
                $userNotification = new UserNotification($title, $data, $body);
                $user->notify($userNotification);
                if (!$isRealTime) {
                    return true;
                }

                $item = $user->notifications()->orderBy('id', 'DESC')->first();
                $notify = [
                    'id' => $item->_id,
                    'user_id' => $item->notifiable_id,
                    'title' => __($item->data['title']),
                    'body' => __($item->data['body']),
                    'data' => $item->data['data'],
                    'read_at' => ($item->read_at) ? $item->read_at->format(config('helpers.dateTimeFormat12')) : $item->read_at,
                    'created_at' => $item->created_at->format(config('helpers.dateTimeFormat12')),
                    'calculate_time' => $item->created_at->diffForHumans(),
                ];
                broadcast(new NotificationPusherEvent($notify));
            });

        return true;
    }
}
