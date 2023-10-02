<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Applications
 *
 * @property int $id
 * @property string $name
 * @property string $discord
 * @property int|null $discordId
 * @property string $steam
 * @property int $cid
 * @property string $cell
 * @property string $about
 * @property string $why
 * @property string $record
 * @property bool $gang
 * @property string $cityAge
 * @property string $shift
 * @property bool $state
 * @property \Illuminate\Support\Carbon $timestamp
 * @method static \Illuminate\Database\Eloquent\Builder|Applications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Applications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Applications query()
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereDiscord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereGang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereRecord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereSteam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereWhy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applications whereState($value)
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
        'discordId',
        'steam',
        'cid',
        'cell',
        'about',
        'why',
        'record',
        'gang',
        'cityAge',
        'shift',
        'timestamp',
        'state',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'discord' => 'string',
        'discordId' => 'string',
        'steam' => 'string',
        'cid' => 'integer',
        'cell' => 'string',
        'about' => 'string',
        'why' => 'string',
        'record' => 'string',
        'gang' => 'boolean',
        'cityAge' => 'string',
        'shift' => 'string',
        'timestamp' => 'datetime',
        'state' => 'int'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
