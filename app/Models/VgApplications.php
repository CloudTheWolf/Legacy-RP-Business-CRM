<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Applications
 *
 * @property int $id
 * @property string $name
 * @property string $discord
 * @property string $steam
 * @property int $cid
 * @property string $cell
 * @property string $about
 * @property string $why
 * @property string $record
 * @property string $cityAge
 * @property string $shift
 * @property bool $gang
 * @property \Illuminate\Support\Carbon $timestamp
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications query()
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereDiscord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereGang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereRecord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereSteam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereCityAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VgApplications whereWhy($value)
 * @mixin \Eloquent
 */
class VgApplications extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vgApplications';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'discord',
        'steam',
        'cid',
        'cell',
        'about',
        'why',
        'record',
        'gang',
        'timestamp',
        'state',
        'cityAge',
        'shift'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'discord' => 'string',
        'steam' => 'string',
        'cid' => 'integer',
        'cell' => 'string',
        'about' => 'string',
        'why' => 'string',
        'record' => 'string',
        'gang' => 'boolean',
        'timestamp' => 'datetime',
        'state' => 'int',
        'cityAge' => 'string',
        'shift' => 'string'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
