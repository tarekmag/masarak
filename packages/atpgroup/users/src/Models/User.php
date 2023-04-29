<?php

namespace ATPGroup\Users\Models;

use ATPGroup\Roles\Models\Role;
use ATPGroup\Companies\Models\Company;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use ATPGroup\Notifications\Traits\Notifiable;
use ATPGroup\Notifications\Models\DeviceToken;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HybridRelations;

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
    protected $table = 'users';
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
        'role_id', 'company_id', 'branch_id', 'name', 'email', 'password', 'image', 'is_active', 'is_blank_dashboard'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
    protected $dates =['subscribe_end_date'];

    /**
     * Get Role relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get Company relationship
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get Branch relationship
     */
    public function branch()
    {
        return $this->belongsTo(Company::class, 'branch_id');
    }

    /**
     * Get Devices Tokens
     */
    public function devices()
    {
        return $this->morphToMany(DeviceToken::class, 'deviceable');
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
     * @return url
     */
    public function getImageAttribute($value)
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
    public function getImageUrlAttribute()
    {
        if($this->image)
        {
            return url('uploads/'.$this->image);
        }
        return url('images/avatar_user.png');
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
                        $query->where('name', 'LIKE', "%{$row}%");
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
