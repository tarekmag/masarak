<?php

namespace ATPGroup\Drivers\Models;

use App\Services\CompanyService;
use ATPGroup\Drivers\Models\Driver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DriverDocument extends Model
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

    protected $table = 'driver_documents';
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
        'driver_id', 'type', 'document', 'status', 'expiration_date', 'is_expired'
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
                $driversIds = app(CompanyService::class)->getDriversRelatedToCompany($user->company);
                $builder->whereIn('driver_id', $driversIds);
            }
        });
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getDocumentAttribute($value)
    {
        if($value)
        {
            return $value;
        }
    }

    /**
     * Get image.
     *
     * @return url
     */
    public function getDocumentUrlAttribute()
    {
        if($this->document)
        {
            return url('uploads/'.$this->document);
        }
        return url('images/avatar_image.png');
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
