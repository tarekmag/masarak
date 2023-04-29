<?php

namespace ATPGroup\Drivers\Observers;

class DriverDocumentObserver
{
    /**
     * Handle the DriverDocument "saving" event.
     *
     * @param  \ATPGroup\Drivers\Models\DriverDocument  $driverDocument
     * @return void
     */
    public function saving($driverDocument)
    {
        $request = request();
        $driverDocument->fill($request->all());
    }

    /**
     * Handle the Driver "deleting" event.
     *
     * @param  \ATPGroup\Drivers\Models\DriverDocument  $driverDocument
     * @return void
     */
    public function deleting($driverDocument)
    {
        //
    }

}
