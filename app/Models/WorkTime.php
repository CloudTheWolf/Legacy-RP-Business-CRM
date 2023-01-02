<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WorkTime
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $clockInAt
 * @property \Illuminate\Support\Carbon|null $clockOutAt
 * @property int $cid
 * @property int $totalTime
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime whereClockInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime whereClockOutAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkTime whereId($value)
 * @mixin \Eloquent
 */
class WorkTime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'workTime';

    /**
     * @var array
     */
    protected $fillable = [
        'clockInAt',
        'clockOutAt',
        'cid',
        'totalTime',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clockInAt' => 'datetime',
        'clockOutAt' => 'datetime',
        'cid' => 'integer',
        'totalTime' => 'integer',
    ];

    public static function whereTotalTime($value)
    {
        return static::where('totalTime','=',$value);
    }

    public $timestamps = false;

}
