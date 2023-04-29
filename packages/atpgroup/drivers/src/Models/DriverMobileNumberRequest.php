<?php

namespace ATPGroup\Drivers\Models;

use Illuminate\Database\Eloquent\Model;
use ATPGroup\Drivers\Models\Driver;

class DriverMobileNumberRequest extends Model
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

    protected $table = 'drivers_mobile_number_requests';
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
        'driver_id', 'mobile_number', 'otp_code'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
