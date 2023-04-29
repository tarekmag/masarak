<?php

namespace ATPGroup\Suppliers\Models;

use App\Helpers\TraitLanguage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use TraitLanguage;

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

    protected $table = 'suppliers';
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
        'name_ar', 'name_en'
    ];

    /**
     * Lang Columns
     */
    protected $languageColumns = [
      'name',
    ];

    /**
     * Get all of the searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {

                    case in_array($key, ['name']):
                        $query->where('name_ar', 'LIKE', "%{$row}%")->orWhere('name_en', 'LIKE', "%{$row}%");
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
