<?php

namespace ATPGroup\Roles\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
    protected $table = 'roles';
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
    protected $fillable = ['name', 'is_super'];

    /**
     * Scope a query to only include 
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuper($query)
    {
        return $query->whereIsSuper(true);
    }

    /**
     * Get all of the languages searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {
                    case in_array($key, ['name']):
                        $query->where($key, 'LIKE', "%{$row}%");
                        break;

                    case in_array($key, ['start_date', 'end_date']):
                        $query->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date]);
                        break;

                    default:
                        if (!in_array($key, ['setLanguage', 'page'])) {
                            $query->where($key, $row);
                        }
                        break;
                }
            }
        }
    }
}
