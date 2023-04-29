<?php

namespace ATPGroup\Notifications\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Notifications\Models\DatabaseNotification;

class NotificationController extends Controller
{
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        $notify = auth()->user()->notifications()->find($request->notify_id);
        if (!$notify) {
            return response()->json(['status' => 'none', 'message' => __('notification::language.message.notFound')]);
        }

        $notify->markAsRead();
        return response()->json(['status' => 'ok', 'message' => __('notification::language.message.updated')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadMoreNotify(Request $request)
    {
        $result = auth()->user()->notifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        $result->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'user_id' => $item->notifiable_id,
                'title' => __($item->data['title']),
                'body' => __($item->data['body']),
                'read_at' => ($item->read_at) ? $item->read_at->format(config('helpers.dateTimeFormat12')) : $item->read_at,
                'created_at' => $item->created_at->format(config('helpers.dateTimeFormat12')),
                'calculate_time' => $item->created_at->diffForHumans(),
                'calculate_date' => $item->created_at->diffForHumans(),
            ];
        })->toJson();

        return response()->json(['status' => 'ok', 'result' => $result->items(), 'currentPage' => $result->currentPage(), 'hasMorePages' => $result->hasMorePages()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = auth()->user()->notifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        // $data['result'] = auth()->user()->notifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        $result->getCollection()->transform(function ($item) {
            return [
                'id' => $item->_id,
                'title' => __($item->data['title']),
                'body' => __($item->data['body']),
                'data' => json_encode($item->data['data']),
                'url' => isset($item->data['data']['route']) ? $item->data['data']['route']: null,
                'read_at' => ($item->read_at) ? $item->read_at->format(config('helpers.dateTimeFormat12')) : $item->read_at,
                'created_at' => $item->created_at->format(config('helpers.dateTimeFormat12')),
                'calculate_time' => $item->created_at->diffForHumans(),
            ];
        });
        return view('notification::index')->with('result', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notifications  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $notifications = auth()->user()->notifications()->whereIn('_id', $request->selectedItems);
        
        if($request->status == 'read')
        {
            foreach($notifications->get() as $notify)
            {
                $notify->markAsRead();
            }
            return response()->json(['status' => 'ok', 'message' => __('notification::language.message.read')]);
        }

        if($request->status == 'destroy')
        {
            $notifications->delete();
            return response()->json(['status' => 'ok', 'message' => __('notification::language.message.deleted')]);
        }
    }
}
