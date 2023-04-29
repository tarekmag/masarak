<?php

namespace ATPGroup\Districts\Observers;

class DistrictObserver
{
    /**
     * Handle the District "saving" event.
     *
     * @param  \ATPGroup\Districts\Models\District  $district
     * @return void
     */
    public function saving($district)
    {
        $request = request();
        $district->fill($request->all());
    }

    /**
     * Handle the District "saved" event.
     *
     * @param  \ATPGroup\Districts\Models\District  $district
     * @return void
     */
    public function saved($district)
    {
        
    }

    /**
     * Handle the District "deleting" event.
     *
     * @param  \ATPGroup\Districts\Models\District  $district
     * @return void
     */
    public function deleting($district)
    {
        //
    }

}
