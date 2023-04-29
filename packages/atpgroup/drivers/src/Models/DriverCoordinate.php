<?php

namespace ATPGroup\Drivers\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DriverCoordinate extends Eloquent
{
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
    protected $table = 'drivers_coordinates';
    
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
    protected $dates = ['created_at', 'updated_at', 'tracking_date'];

    /**
     * Get all of the searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {

                    case in_array($key, ['driver_id']):
                        $query->where('driver_id', (int) $row);
                        break;
                   
                }
            }
        }
    }
   
}
