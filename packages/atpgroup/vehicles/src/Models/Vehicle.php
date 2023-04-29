<?php

namespace ATPGroup\Vehicles\Models;

use App\Helpers\TraitLanguage;
use App\Services\CompanyService;
use ATPGroup\Brands\Models\Brand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use ATPGroup\BrandModels\Models\BrandModel;
use ATPGroup\Drivers\Models\DriverVehicle;

class Vehicle extends Model
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

    protected $table = 'vehicles';
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
        'brand_id', 'brand_model_id', 'plate_number', 'color_en', 'color_ar', 'color_code', 'number_seats', 'vehicle_year', 'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Lang Columns
     */
    protected $languageColumns = [
      'color',
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
                $vehiclesIds = app(CompanyService::class)->getVehiclesRelatedToCompany($user->company);
                $builder->whereIn('vehicles.id', $vehiclesIds);
            }
        });
    }

    /**
     * Get Brand relation
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get Brand Model relation
     */
    public function brandModel()
    {
        return $this->belongsTo(BrandModel::class);
    }

    /**
     * Get driverVehicles Model relation
     */
    public function driverVehicles()
    {
        return $this->hasMany(DriverVehicle::class);
    }

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
     * Get all of the searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {

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
