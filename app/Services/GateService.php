<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;
use ATPGroup\Roles\Models\RoleAction;
use ATPGroup\Roles\Models\PermissionAction;
use Illuminate\Support\Facades\Schema;

class GateService 
{
   public static function define() 
   {
        Gate::before(function ($user, $ability) 
        {
            if($user->role && $user->role->is_super == 1)
            {
                return true;
            }
        });

        if(Schema::hasTable('permissions_actions'))
        {
            foreach(PermissionAction::all() as $permission)
            {
                Gate::define($permission->method, function ($user) use($permission) {
                    return RoleAction::whereRoleId($user->role_id)->wherePermissionActionId($permission->id)->exists();
                });
            }
        }
    }
}