<?php

namespace ATPGroup\Routes\Models\Relationships;

use ATPGroup\Drivers\Models\Driver;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

trait TripRelationships
{
    use HybridRelations;

    public function driverRelation()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
