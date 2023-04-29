<?php

namespace ATPGroup\Emergencies\Models;

use ATPGroup\Routes\Models\Trip;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use ATPGroup\Emergencies\Models\Emergency;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class EmergencyRequest extends Model
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

    protected $table = 'emergencies_requests';
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
        'emergency_id', 'trip_id', 'message', 'image'
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
                $builder->whereHas('trip', function ($query) use ($user) {
                    $query->where('route.company_id', (int) $user->company_id);
                });
            }
        });
    }

    public function emergency()
    {
        return $this->belongsTo(Emergency::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

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
        return '../images/avatar_image.png';
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
