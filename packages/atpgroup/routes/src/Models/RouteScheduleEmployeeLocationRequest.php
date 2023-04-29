<?php

namespace ATPGroup\Routes\Models;

use Carbon\Carbon;
use App\Enums\RouteType;
use ATPGroup\Users\Models\User;
use ATPGroup\Routes\Models\Trip;
use ATPGroup\Routes\Models\Route;
use ATPGroup\Stations\Models\Station;
use Illuminate\Support\Facades\Schema;
use ATPGroup\Employees\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use ATPGroup\Routes\Models\RouteSchedule;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class RouteScheduleEmployeeLocationRequest extends Model
{
    use HybridRelations;

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
    protected $table = 'routes_schedules_employees_locations_requests';

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
        'trip_id',
        'route_id',
        'route_schedule_id',
        'station_id',
        'old_station_id',
        'employee_id',
        'pickup_lat',
        'pickup_lng',
        'drop_lat',
        'drop_lng',
        'updated_by_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get Start Time Attribute
     */
    public function getStartTimeAttribute()
    {
      if($this->route_schedule && $this->route_schedule->start_time)
      {
        return Carbon::parse($this->route_schedule->start_time)->format(config('helpers.timeFormat12'));
      }

      return '';
    }

    /**
     * Get Updated By Attribute
     */
    public function getUpdatedByAttribute()
    {
      if($this->status != RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_PENDING)
      {
        return ($this->updated_by_id) ? optional($this->updatedByUser)->name : __('partials.system');
      }
      return '';
    }

    /**
     * Get trip
     */
    public function trip()
    {
      return $this->belongsTo(Trip::class);
    }

    /**
     * Get route
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
     * Get old station
     */
    public function oldStation()
    {
      return $this->belongsTo(Station::class, 'old_station_id');
    }

    /**
     * Get employee
     */
    public function employee()
    {
      return $this->belongsTo(Employee::class);
    }

    /**
     * Get user
     */
    public function updatedByUser()
    {
      return $this->belongsTo(User::class, 'updated_by_id');
    }

    /**
     * Get all of the searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {
                  
                  case in_array($key, ['phone', 'company_id', 'branch_id']):
                    $query->whereHas('employee', function($query) use($row, $key){
                      $query->when($key == 'phone', function($q)use($row){
                        return $q->where('phone', $row);
                      });

                      $query->when($key == 'company_id', function($q)use($row){
                        return $q->where('company_id', $row);
                      });

                      $query->when($key == 'branch_id', function($q)use($row){
                        return $q->where('branch_id', $row);
                      });
                    });
                    break;  

                    default:
                        if (in_array($key, Schema::getColumnListing($this->table))) {
                            $query->where($key, $row);
                        }
                        break;
                }
            }
        }
    }
}
