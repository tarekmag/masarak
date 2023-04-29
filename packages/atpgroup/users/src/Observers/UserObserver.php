<?php

namespace ATPGroup\Users\Observers;

use ATPGroup\Notifications\Notifications\UserNotification;

class UserObserver
{
    /**
     * Handle the user "saving" event.
     *
     * @param  \ATPGroup\Users\Models\User  $user
     * @return void
     */
    public function saving($user)
    {
        $request = request();
        $user->fill($request->all());
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param  \ATPGroup\Users\Models\User  $user
     * @return void
     */
    public function deleting($user)
    {
        //
    }

}
