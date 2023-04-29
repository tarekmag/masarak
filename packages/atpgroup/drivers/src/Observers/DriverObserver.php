<?php

namespace ATPGroup\Drivers\Observers;

use App\Enums\NotifyType;
use App\Services\DriverService;

class DriverObserver
{
    /**
     * Handle the Driver "created" event.
     *
     * @param  \ATPGroup\Drivers\Models\Driver  $driver
     * @return void
     */
    public function created($driver)
    {
        app(DriverService::class)->pushTypeNotify(NotifyType::WELCOME_DRIVER, $driver);
    }

    /**
     * Handle the Driver "saving" event.
     *
     * @param  \ATPGroup\Drivers\Models\Driver  $driver
     * @return void
     */
    public function saving($driver)
    {
        $request = request();
        $driver->fill($request->all());
    }

    /**
     * Handle the Driver "deleting" event.
     *
     * @param  \ATPGroup\Drivers\Models\Driver  $driver
     * @return void
     */
    public function deleting($driver)
    {
        //
    }

}
