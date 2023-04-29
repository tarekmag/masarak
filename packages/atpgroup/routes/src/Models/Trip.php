<?php

namespace ATPGroup\Routes\Models;

// use Jenssegers\Mongodb\Schema\Builder;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use ATPGroup\Routes\Models\Attributes\TripAttributes;
use ATPGroup\Routes\Models\Relationships\TripRelationships;
use ATPGroup\Routes\Models\Scopes\TripScopes;

class Trip extends Eloquent
{
    use TripAttributes, TripRelationships, TripScopes;

    /**
     * The connection associated with the model.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trips';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = '_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'trip_date', 'trip_time'];
}
