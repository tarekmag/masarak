<?php

namespace ATPGroup\Notifications\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Notifications\Resources\API\NotificationResource;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource with paginate.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = auth('api')->user()->notifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return responsePaginate(NotificationResource::collection($result));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $notify = auth('api')->user()->notifications()->where('id', $request->notify)->first();
        if (!$notify) {
            return responseErrorMessage(__('notification::language.message.notFound'));
        }

        $notify->markAsRead();
        return responseSuccessData(new NotificationResource($notify));
    }

    /**
     * Display a unread listing of the resource without paginate.
     *
     * @return \Illuminate\Http\Response
     */
    public function unread(Request $request)
    {
        $result = auth('api')->user()->unreadnotifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return responsePaginate(NotificationResource::collection($result));
    }

    /**
     * Display a unread count listing of the resource without paginate.
     *
     * @return \Illuminate\Http\Response
     */
    public function unreadCount(Request $request)
    {
        $result = auth('api')->user()->unreadnotifications->count();
        return responseSuccessData($result);
    }

    /**
     * Display a read listing of the resource without paginate.
     *
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request)
    {
        $result = auth('api')->user()->readnotifications()->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return responsePaginate(NotificationResource::collection($result));
    }

    public function destroy(Request $request)
    {
        $result = auth('api')->user()->notifications()->whereIn('id', $request->notify_ids);
        if($result->count() > 0)
        {
            $result->delete();
        }

        return responseSuccessMessage(__('notification::language.message.deleted'));
    }
}
