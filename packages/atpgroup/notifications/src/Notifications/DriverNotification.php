<?php

namespace ATPGroup\Notifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DriverNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $data;
    protected $body;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $data, $body)
    {
        $this->title = $title;
        $this->data = $data;
        $this->body = $body;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'data' => $this->data,
            'body' => $this->body,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
