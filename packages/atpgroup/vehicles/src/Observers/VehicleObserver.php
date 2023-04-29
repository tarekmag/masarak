<?php

namespace ATPGroup\Vehicles\Observers;

class VehicleObserver
{
    /**
     * Handle the Vehicle "saving" event.
     *
     * @param  \ATPGroup\Vehicles\Models\Vehicle  $vehicle
     * @return void
     */
    public function saving($vehicle)
    {
        $request = request();
        $vehicle->fill($request->all());
    }

    /**
     * Handle the Vehicle "deleting" event.
     *
     * @param  \ATPGroup\Vehicles\Models\Vehicle  $vehicle
     * @return void
     */
    public function deleting($vehicle)
    {
        //
    }

}
