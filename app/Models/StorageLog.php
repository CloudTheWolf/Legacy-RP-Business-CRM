<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StorageLog
 *
 * @property int $id
 * @property int $storageId
 * @property int $scrap
 * @property int $aluminium
 * @property int $steel
 * @property int $glass
 * @property int $rubber
 * @property int $issuer
 * @property int $issuedTo
 * @property \Illuminate\Support\Carbon $tstamp
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereAluminium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereGlass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereIssuedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereIssuer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereRubber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereScrap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereSteel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageLog whereTstamp($value)
 * @mixin \Eloquent
 */
class StorageLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storageLog';

    /**
     * @var array
     */
    protected $fillable = [
        'storageId',
        'scrap',
        'aluminium',
        'steel',
        'glass',
        'rubber',
        'issuer',
        'issuedTo',
        'tstamp',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'storageId' => 'integer',
        'scrap' => 'integer',
        'aluminium' => 'integer',
        'steel' => 'integer',
        'glass' => 'integer',
        'rubber' => 'integer',
        'issuer' => 'integer',
        'issuedTo' => 'integer',
        'tstamp' => 'datetime',
    ];

    public $timestamps = false;

}
