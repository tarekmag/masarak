<?php

namespace App\Http\Middleware;

use ATPGroup\Roles\Models\PermissionAction;
use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = auth()->user()->role;
        $routeName = $request->route()->getName();
        $skipsRoutes = $this->getSkipsRoutes();

        if($role->is_super)
        {
            $response = $next($request);
            return $response;
        }

        if(in_array($routeName, $skipsRoutes))
        {
            $response = $next($request);
            return $response;
        }

        $check = PermissionAction::where('method', $routeName)->join('roles_actions', 'roles_actions.permission_action_id', 'permissions_actions.id')->where('role_id', $role->id)->first();
        if(!$check)
        {
            return redirect()->route('lockedscreen');
        }

        $response = $next($request);
        return $response;
    }

    private function getSkipsRoutes()
    {
        return [
            'lockedscreen',
            'dashboard.index',
            'dashboard.clearAdminCache',
            'dashboard.clearCompanyCache',
            'notification.loadMoreNotify',
            'branch.getBranches',
            'driver.getDrivers',
            'station.getAutocomplete',
            'route.getSchedules',
            'brandModel.getBrandModels',
            'driverVehicle.getVehicles',
        ];
    }
}
