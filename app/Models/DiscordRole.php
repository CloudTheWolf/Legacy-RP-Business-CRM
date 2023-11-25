<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DiscordToken
 *
 * @property int $id
 * @property string $role_name
 * @property BigInteger $role_id
 * @property \Illuminate\Support\Carbon $timestamp
 * @method static Builder|DiscordToken newModelQuery()
 * @method static Builder|DiscordToken newQuery()
 * @method static Builder|DiscordToken query()
 * @method static Builder|DiscordToken whereRoleName($string)
 * @mixin \Eloquent
 */

class DiscordRole extends Model
{
    use HasFactory;

    protected $fillable = [
      'role_name',
      'role_id'
    ];

}
