<?php

namespace ATPGroup\Stations\Models;

use App\Helpers\TraitLanguage;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Schema;
use ATPGroup\Districts\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use ATPGroup\Routes\Models\RouteScheduleEmployee;

class Station extends Model
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

    protected $table = 'stations';
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
        'district_id', 'name_ar', 'name_en', 'pickup_lat', 'pickup_lng', 'address_ar', 'address_en', 'drop_lat', 'drop_lng', 'pickup_name_ar', 'pickup_name_en', 'drop_name_ar', 'drop_name_en'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'district_id'];

    /**
     * Lang Columns
     */
    protected $languageColumns = [
        'name',
        'address',
        'pickup_name',
        'drop_name',
    ];

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
                if (!$user->company) {
                    return;
                }
                $stationsIds = app(CompanyService::class)->getStationsRelatedToCompany($user->company);
                $builder->whereIn('id', $stationsIds);
            }
        });
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Get employees
     */
    public function employees()
    {
        return $this->hasMany(RouteScheduleEmployee::class);
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
