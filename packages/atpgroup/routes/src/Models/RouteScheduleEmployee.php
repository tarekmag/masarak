<?php

namespace ATPGroup\Routes\Models;

use ATPGroup\Routes\Models\Route;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Employees\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use ATPGroup\Routes\Models\RouteSchedule;

class RouteScheduleEmployee extends Model
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
    protected $table = 'routes_schedules_employees';

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
        'route_schedule_id',
        'station_id',
        'employee_id',
        'pickup_lat',
        'pickup_lng',
        'drop_lat',
        'drop_lng'
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
     * Get route schedule
     */
    public function route_schedule()
    {
      return $this->belongsTo(RouteSchedule::class);
    }

    /**
     * Get station
     */
    public function station()
    {
      return $this->belongsTo(Station::class);
    }

    /**
     * Get employee
     */
    public function employee()
    {
      return $this->belongsTo(Employee::class);
    }
}
