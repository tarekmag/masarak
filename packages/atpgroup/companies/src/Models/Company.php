<?php

namespace ATPGroup\Companies\Models;

use App\Enums\RouteType;
use App\Helpers\TraitLanguage;
use Illuminate\Support\Facades\Schema;
use ATPGroup\Employees\Models\Employee;
use ATPGroup\Routes\Models\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use ATPGroup\Routes\Models\RouteScheduleEmployeeLocationRequest;

class Company extends Model
{
    use TraitLanguage;

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

    protected $table = 'companies';
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
        'parent_id', 'name_ar', 'name_en', 'logo', 'lat', 'lng', 'address_ar', 'address_en', 'main_branch', 'display_employee_image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'main_branch' => 'boolean',
        'display_employee_image' => 'boolean',
    ];

    /**
     * Lang Columns
     */
    protected $languageColumns = [
        'name',
        'address',
    ];

    /**
     * Get image.
     *
     * @return string
     */
    public function getLogoAttribute($value)
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
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return url('uploads/' . $this->logo);
        }
        return url('images/avatar_image.png');
    }

    /**
     * Get Employees Locations Requests.
     *
     * @return url
     */
    public function getEmployeesLocationsRequestsAttribute()
    {
        $employees = $this->employees->pluck('id')->toArray();
        $count = RouteScheduleEmployeeLocationRequest::whereIn('employee_id', $employees)->where('status', RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_PENDING)->count();
        return ['count' => $count];
    }

    public function parentCompany()
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function branches()
    {
        return $this->hasMany(Company::class, 'parent_id');
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'company_id');
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
                    $builder->whereIn('id', [$user->company_id, $user->branch_id]);
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
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotParent($query)
    {
        return $query->whereNotNull('parent_id');
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
                        $query->where('name_ar', 'LIKE', "%{$row}%")->orWhere('name_en', 'LIKE', "%{$row}%");
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
