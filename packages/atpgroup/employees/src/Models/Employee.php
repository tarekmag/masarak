<?php

namespace ATPGroup\Employees\Models;

use App\Services\EmployeeService;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Companies\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Employee extends Model
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

    protected $table = 'employees';
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
        'company_id',
        'branch_id',
        'station_id',
        'name',
        'phone',
        'email',
        'image',
        'is_leader'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_leader' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get image.
     *
     * @return string
     */
    public function getImageAttribute($value)
    {
        if ($value) {
            return $value;
        }
    }

    /**
     * Get image.
     *
     * @return url
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url('uploads/' . $this->image);
        }
        return url('images/avatar_image.png');
    }

    /**
     * Get Name Attribute .
     *
     * @return string
     */
    public function getEmployeeNameAttribute()
    {
        return app(EmployeeService::class)->getEmployeeName($this);
    }

    /**
     * The "booted" method of the model.
     * To get all data base on company or branch
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (auth('api')->check() == false && auth()->check() && auth()->user()->role->is_super == false) {
                $user = auth()->user();
                if ($user->company_id) {
                    $builder->where('company_id', $user->company_id);
                }
                if ($user->branch_id) {
                    $builder->where('branch_id', $user->branch_id);
                }
            }
        });
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLeader($query)
    {
        return $query->where('is_leader', true);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function branch()
    {
        return $this->belongsTo(Company::class, 'branch_id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    /**
     * Get all of the searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {

                    case in_array($key, ['name']):
                        $query->where($key, 'LIKE', "%{$row}%");
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
