<?php

namespace ATPGroup\Vehicles\Observers;

class VehicleDocumentObserver
{
    /**
     * Handle the DriverDocument "saving" event.
     *
     * @param  \ATPGroup\Vehicles\Models\VehicleDocument  $vehicleDocument
     * @return void
     */
    public function saving($vehicleDocument)
    {
        $request = request();
        $vehicleDocument->fill($request->all());
    }

    /**
     * Handle the Driver "deleting" event.
     *
     * @param  \ATPGroup\Vehicles\Models\VehicleDocument  $vehicleDocument
     * @return void
     */
    public function deleting($vehicleDocument)
    {
        //
    }

}
