<?php

namespace ATPGroup\Routes\Models;

use App\Helpers\TraitLanguage;
use Illuminate\Database\Eloquent\Model;
use ATPGroup\Routes\Models\Scopes\Scopes;
use ATPGroup\Routes\Models\Attributes\Attributes;
use ATPGroup\Routes\Models\Relationships\Relationships;
class Route extends Model
{
    use TraitLanguage, Relationships, Attributes, Scopes;

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
    protected $table = 'routes';

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
        'company_id',
        'branch_id',
        'type',
        'from_en',
        'from_ar',
        'to_en',
        'to_ar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Lang Columns
     */
    protected $languageColumns = [
      'from',
      'to',
    ];
}
