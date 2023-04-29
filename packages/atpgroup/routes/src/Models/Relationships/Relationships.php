<?php

namespace ATPGroup\Routes\Models\Relationships;

use ATPGroup\Companies\Models\Company;
use ATPGroup\Routes\Models\RouteStation;
use ATPGroup\Routes\Models\RouteSchedule;
use ATPGroup\Routes\Models\Trip;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

trait Relationships
{
    use HybridRelations;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Company::class, 'branch_id');
    }

    public function stations()
    {
        return $this->hasMany(RouteStation::class);
    }

    public function schedules()
    {
        return $this->hasMany(RouteSchedule::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
