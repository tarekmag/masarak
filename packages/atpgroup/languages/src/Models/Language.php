<?php

namespace ATPGroup\Languages\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
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
    protected $table = 'languages';
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
    protected $fillable = ['name', 'symbol', 'direction'];

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
