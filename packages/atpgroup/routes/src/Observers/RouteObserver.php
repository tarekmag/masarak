<?php

namespace ATPGroup\Routes\Observers;

class RouteObserver
{
    /**
     * Handle the Vehicle "saving" event.
     *
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return void
     */
    public function saving($route)
    {
        $request = request();
        $route->fill($request->all());
    }

    /**
     * Handle the Vehicle "deleting" event.
     *
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return void
     */
    public function deleting($route)
    {
        //
    }

}
