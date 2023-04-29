<?php

namespace ATPGroup\Notifications\Views\Components;

use Illuminate\View\Component;

class NotificationList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $result = auth()->user()->notifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        $result->getCollection()->transform(function ($item) {
            return [
                'id' => $item->_id,
                'user_id' => $item->notifiable_id,
                'title' => __($item->data['title']),
                'body' => __($item->data['body']),
                'data' => json_encode($item->data['data']),
                'read_at' => ($item->read_at) ? $item->read_at->format(config('helpers.dateTimeFormat12')) : $item->read_at,
                'created_at' => $item->created_at->format(config('helpers.dateTimeFormat12')),
                'calculate_time' => $item->created_at->diffForHumans(),
            ];
        });

        $data['result'] = $result;
        $data['countUnRead'] = auth()->user()->unreadnotifications->count();
        $data['currentPage'] = $result->currentPage();
        return view('notification::components.notification-list')->with($data);
    }
}
