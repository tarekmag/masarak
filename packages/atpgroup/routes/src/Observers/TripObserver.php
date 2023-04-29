<?php

namespace ATPGroup\Routes\Observers;

use App\Enums\NotifyType;
use App\Services\DriverService;

class TripObserver
{
    /**
     * Handle the Vehicle "created" event.
     *
     * @param  \ATPGroup\Routes\Models\Route $route
     * @return void
     */
    public function created($trip)
    {
        app(DriverService::class)->pushTypeNotify(NotifyType::ASSIGN_TRIP_TO_DRIVER, $trip->driverRelation, ['trip' => $trip]);
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
