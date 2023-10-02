<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DiscordToken
 *
 * @property int $id
 * @property int $discord_id
 * @property string $access_token
 * @property int $refresh_token
 * @property \Illuminate\Support\Carbon $expires_at
 * @property \Illuminate\Support\Carbon $timestamp
 * @method static Builder|DiscordToken newModelQuery()
 * @method static Builder|DiscordToken newQuery()
 * @method static Builder|DiscordToken query()
 * @mixin \Eloquent
 */

class DiscordToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'discord_id',
        'access_token',
        'refresh_token',
        'expires_at'
    ];

    protected $dates = [
        'expires_at'
    ];

    // Mutators
    public function setAccessTokenAttribute($value)
    {
        $this->attributes['access_token'] = encrypt($value);
    }

    public function setRefreshTokenAttribute($value)
    {
        $this->attributes['refresh_token'] = encrypt($value);
    }

    // Accessors
    public function getAccessTokenAttribute($value)
    {
        return decrypt($value);
    }

    public function getRefreshTokenAttribute($value)
    {
        return decrypt($value);
    }
    public static function whereDiscordId($value)
    {
        return static::where('discord_id','=',$value);
    }

}
