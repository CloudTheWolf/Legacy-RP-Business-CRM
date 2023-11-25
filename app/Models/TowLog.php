<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TowLog
 *
 * @property int $userId
 * @property int $local
 * @property int $citizen
 * @property int $pd
 * @property int $help
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog whereCitizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog whereHelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog whereLocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TowLog wherePd($value)
 * @mixin \Eloquent
 */
class TowLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tow_log';

    protected $primaryKey = 'userId';

    /**
     * @var array
     */
    protected $fillable = [
        'userId',
        'local',
        'citizen',
        'pd',
        'help',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'userId' => 'integer',
        'local' => 'integer',
        'citizen' => 'integer',
        'pd' => 'integer',
        'help' => 'integer',
    ];

    public $timestamps = false;


}
