<?php

namespace ATPGroup\Emergencies\Observers;

class EmergencyObserver
{
    /**
     * Handle the Emergency "saving" event.
     *
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return void
     */
    public function saving($emergency)
    {
        $request = request();
        $emergency->fill($request->all());
    }

    /**
     * Handle the Emergency "saved" event.
     *
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return void
     */
    public function saved($emergency)
    {
        
    }

    /**
     * Handle the Emergency "deleting" event.
     *
     * @param  \ATPGroup\Emergencies\Models\Emergency  $emergency
     * @return void
     */
    public function deleting($emergency)
    {
        //
    }

}
