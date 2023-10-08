<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
 * @property bool $state
 * @property \Illuminate\Support\Carbon $timestamp
 * @method static Builder|Applications newModelQuery()
 * @method static Builder|Applications newQuery()
 * @method static Builder|Applications query()
 * @method static Builder|Applications whereAbout($value)
 * @method static Builder|Applications whereCell($value)
 * @method static Builder|Applications whereCid($value)
 * @method static Builder|Applications whereDiscord($value)
 * @method static Builder|Applications whereGang($value)
 * @method static Builder|Applications whereId($value)
 * @method static Builder|Applications whereName($value)
 * @method static Builder|Applications whereRecord($value)
 * @method static Builder|Applications whereSteam($value)
 * @method static Builder|Applications whereTimestamp($value)
 * @method static Builder|Applications whereWhy($value)
 * @method static Builder|Applications whereState($value)
 * @mixin \Eloquent
 */
class Applications extends Model
{
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
