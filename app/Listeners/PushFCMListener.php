<?php

namespace App\Listeners;

use LaravelFCM\Facades\FCM;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class PushFCMListener
{
    private function send($event)
    {
        $numberSuccess = 0;
        $numberFailure = 0;
        $numberModification = 0;
        $data = array_merge(($event->data) ?: [], ['title' => $event->title, 'body' => $event->body]);

        if (empty($event->tokens)) {
            return [
                'numberSuccess' => $numberSuccess,
                'numberFailure' => $numberFailure,
                'numberModification' => $numberModification,
            ];
        }

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        $option = $optionBuilder->build();

        $notificationBuilder = new PayloadNotificationBuilder();
        $notificationBuilder->setTitle($event->title);
        $notificationBuilder->setBody($event->body);
        $notificationBuilder->setIcon(public_path('images/icon.png'));
        $notificationBuilder->setSound('default');
        $notification = $notificationBuilder->build();

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
        $data = $dataBuilder->build();
        $collectTokens = collect($event->tokens);

        foreach ($collectTokens->chunk(1000) as $tokens) {
            $downstreamResponse = FCM::sendTo($tokens->toArray(), $option, $notification, $data);

            $numberSuccess = $numberSuccess + $downstreamResponse->numberSuccess();
            $numberFailure = $numberFailure + $downstreamResponse->numberFailure();
            $numberModification = $numberModification + $downstreamResponse->numberModification();
        }

        return [
            'numberSuccess' => $numberSuccess,
            'numberFailure' => $numberFailure,
            'numberModification' => $numberModification,
        ];
    }

    /**
     * Handle Notify User FCM Event.
     */
    public function onNotifyUserFCMEvent($event)
    {
        $this->send($event);
    }

    /**
     * Handle Notify Driver FCM Event.
     */
    public function onNotifyDriverFCMEvent($event)
    {
        $this->send($event);
    }

    /**
     * Handle Direct Notify Driver FCM Event.
     */
    public function onDirectNotifyDriverFCMEvent($event)
    {
        $this->send($event);
    }
}
