<?php

namespace ATPGroup\Routes\Models;

use ATPGroup\Drivers\Models\Driver;
use ATPGroup\Routes\Models\Route;
use ATPGroup\Suppliers\Models\Supplier;
use ATPGroup\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;

class RouteSchedule extends Model
{

    /**
     * The connection associated with the model.
     *
     * @var string
     */

    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'routes_schedules';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id',
        'supplier_id',
        'driver_id',
        'vehicle_id',
        'client_price',
        'driver_price',
        'type',
        'class',
        'days',
        'start_date',
        'end_date',
        'start_time',
        'arrival_allowance',
        'rider_code',
        'is_return',
        'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
      'days' => 'array',
      'is_active' => 'boolean',
      'is_return' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
      return $query->where('is_active', true);
    }

    /**
     * Get route
     */
    public function route()
    {
      return $this->belongsTo(Route::class);
    }

    /**
     * Get supplier
     */
    public function supplier()
    {
      return $this->belongsTo(Supplier::class);
    }

    /**
     * Get driver
     */
    public function driver()
    {
      return $this->belongsTo(Driver::class);
    }

    /**
     * Get vehicle
     */
    public function vehicle()
    {
      return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get employees
     */
    public function employees()
    {
      return $this->hasMany(RouteScheduleEmployee::class);
    }
}
