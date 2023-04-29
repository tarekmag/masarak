<?php

namespace ATPGroup\Drivers\Models;

// use Illuminate\Notifications\Notifiable;
use App\Enums\RouteType;
use App\Services\TripService;
use ATPGroup\Routes\Models\Trip;
use Laravel\Passport\HasApiTokens;
use ATPGroup\Vehicles\Models\Vehicle;
use Illuminate\Support\Facades\Schema;
use ATPGroup\Suppliers\Models\Supplier;
use ATPGroup\Drivers\Scopes\DriverScope;
use ATPGroup\Notifications\Traits\Notifiable;
use ATPGroup\Notifications\Models\DeviceToken;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use Notifiable, HasApiTokens, HybridRelations;

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

    protected $table = 'drivers';
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
        'supplier_id', 'name', 'mobile_number', 'password', 'personal_photo', 'type', 'is_active', 'otp_code', 'lat', 'lng'
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'password', 'is_active', 'otp_code'];

    /**
     * The "booted" method of the model.
     * To get all data base on company or branch
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new DriverScope(auth('api')->user()));
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'drivers_vehicles')->withTimestamps();
    }

    /**
     * Set the user's password bcrypt.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        if ($password !== null & $password !== "") {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getPersonalPhotoAttribute($value)
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
        if ($this->personal_photo) {
            return url('uploads/' . $this->personal_photo);
        }
        return url('images/avatar_user.png');
    }

    /**
     * Get image.
     *
     * @return url
     */
    public function getNameWithSupplierAttribute()
    {
        if ($this->supplier) {
            return $this->name . '/' . $this->supplier->name;
        }
        return $this->name;
    }

    /**
     * Get Vehicle Names.
     *
     * @return url
     */
    public function getVehicleNamesAttribute()
    {
        return $this->vehicles()->pluck('plate_number')->implode(' || ');
    }

    /**
     * Get Vehicle Count.
     *
     * @return url
     */
    public function getVehicleCountAttribute()
    {
        return $this->vehicles()->count();
    }

    /**
     * Get Driver Trip's
     *
     * @return string
     */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'driver_id');
    }

    /**
     * Get Driver Status.
     *
     * @return string
     */
    public function getDriverStatusAttribute()
    {
        $trip = Trip::where('driver_id', $this->id)->where('trip_date', now()->startOfDay())->get()->filter(function ($item) {
            $tripDateTime = app(TripService::class)->getTripDateTimeFormated($item);
            if ($tripDateTime->format('Y-m-d H:i') >= now()->format('Y-m-d H:i')) {
                return $item;
            }
        })->first();

        if ($trip) {
            return $trip->status;
        }
        return '';
    }

    /**
     * Get Trip Status.
     *
     * @return string
     */
    public function getTripStatusAttribute()
    {
        $trip = Trip::where('driver_id', $this->id)->where('trip_date', '>=', now()->startOfDay())->get()->filter(function ($item) {
            $tripDateTime = app(TripService::class)->getTripDateTimeFormated($item);
            if ($tripDateTime->format('Y-m-d H:i') >= now()->format('Y-m-d H:i')) {
                return $item;
            } elseif ($item->status != RouteType::TRIP_STATUS_AVAILABLE) {
                return $item;
            }
        })->first();
        if ($trip) {
            return [
                'trip_status' => $trip->status,
                'trip_time' => app(TripService::class)->getTripDateTimeFormated($trip)->diffForHumans(),
                'route_name' => $trip->route_name,
            ];
        }
        return [
            'trip_status' => '',
            'trip_time' => '',
            'route_name' => '',
        ];
    }

    /**
     * Get Devices Tokens
     */
    public function devices()
    {
        return $this->morphMany(DeviceToken::class, 'deviceable');
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

                    case in_array($key, ['name']):
                        $query->where($key, 'LIKE', "%{$row}%");
                        break;

                    case in_array($key, ['company_id']):
                        $driverIds = app(TripService::class)->getDriversRelatedToCompany($row);
                        $query->whereIn('id', $driverIds);
                        break;

                    case in_array($key, ['tracked']):
                        ($row) ? $query->whereNotNull('lat') : $query->whereNull('lat');
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
