<?php

namespace ATPGroup\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionAction extends Model
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
    protected $table = 'permissions_actions';
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
    protected $fillable = ['permission_id', 'name', 'method'];

    /**
     * Get Permission relationship
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
