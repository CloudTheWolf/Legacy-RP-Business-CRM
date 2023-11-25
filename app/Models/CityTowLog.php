<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CityTowLog
 *
 * @property int $rowId
 * @property int $id
 * @property int $characterId
 * @property \Illuminate\Support\Carbon $timestamp
 * @property string $modelName
 * @property int $reward
 * @property bool $playerVehicle
 * @property string $plateNumber
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog wherePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog wherePlayerVehicle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog whereRowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityTowLog whereTimestamp($value)
 * @mixin \Eloquent
 */
class CityTowLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cityTowLogs';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rowId';

    /**
     * Does table use Eloquent Timestamps?
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'characterId',
        'timestamp',
        'modelName',
        'reward',
        'playerVehicle',
        'plateNumber',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'rowId' => 'integer',
        'id' => 'integer',
        'characterId' => 'integer',
        'timestamp' => 'datetime',
        'modelName' => 'string',
        'reward' => 'integer',
        'playerVehicle' => 'boolean',
        'plateNumber' => 'string',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'characterId','cid');
    }

}
