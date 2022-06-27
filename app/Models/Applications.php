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
 * @property bool $gang
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
        'steam',
        'cid',
        'cell',
        'about',
        'why',
        'record',
        'gang',
        'timestamp',
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
    ];

}
