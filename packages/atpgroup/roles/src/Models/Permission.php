<?php

namespace ATPGroup\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
    protected $table = 'permissions';
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
    protected $fillable = ['name', 'link', 'sorting'];

    /**
     * Get Permission Actions relationship
     */
    public function actions()
    {
        return $this->hasMany(PermissionAction::class, 'permission_id');
    }

}
