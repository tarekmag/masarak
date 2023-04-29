<?php

namespace ATPGroup\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAction extends Model
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
    protected $table = 'roles_actions';
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
    protected $fillable = ['role_id', 'permission_action_id'];

    /**
     * Get Role relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get Permission Action relationship
     */
    public function permission()
    {
        return $this->belongsTo(PermissionAction::class, 'permission_action_id');
    }

}
