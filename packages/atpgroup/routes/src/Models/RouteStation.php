<?php

namespace ATPGroup\Routes\Models;

use ATPGroup\Routes\Models\Route;
use ATPGroup\Stations\Models\Station;
use Illuminate\Database\Eloquent\Model;
use ATPGroup\Routes\Models\RouteScheduleEmployee;

class RouteStation extends Model
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
    protected $table = 'routes_stations';

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
        'station_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get roiute
     */
    public function route()
    {
      return $this->belongsTo(Route::class);
    }

    /**
     * Get station
     */
    public function station()
    {
      return $this->belongsTo(Station::class);
    }

    /**
     * Get employees
     */
    public function employees()
    {
      return $this->hasMany(RouteScheduleEmployee::class);
    }
}
