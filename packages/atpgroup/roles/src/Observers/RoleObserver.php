<?php

namespace ATPGroup\Roles\Observers;

class RoleObserver
{
    /**
     * Handle the Role "saving" event.
     *
     * @param  \ATPGroup\Roles\Models\Role  $role
     * @return void
     */
    public function saving($role)
    {
        $request = request();
        $role->fill($request->all());
    }

    /**
     * Handle the Role "deleting" event.
     *
     * @param  \ATPGroup\Roles\Models\Role  $role
     * @return void
     */
    public function deleting($role)
    {
        //
    }

}
