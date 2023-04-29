<?php

namespace ATPGroup\BrandModels\Models;

use App\Helpers\TraitLanguage;
use App\Services\CompanyService;
use ATPGroup\Brands\Models\Brand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BrandModel extends Model
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

    protected $table = 'brands_models';
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
        'brand_id', 'name_ar', 'name_en'
    ];

    /**
     * Lang Columns
     */
    protected $languageColumns = [
        'name',
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
                $brandModelsIds = app(CompanyService::class)->getBrandModelsRelatedToCompany($user->company);
                $builder->whereIn('id', $brandModelsIds);
            }
        });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
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
