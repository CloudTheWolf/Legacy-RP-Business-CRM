<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $cell
 * @property string|null $towID
 * @property string $role
 * @property string $workingAs
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property bool|null $onDuty
 * @property int|null $cid
 * @property string|null $steamId
 * @property bool $IsAdmin
 * @property bool $disabled
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCell($value)
 * @method static Builder|User whereCid($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDisabled($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereTowID($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereWorkingAs($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cell',
        'towID',
        'role',
        'workingAs',
        'email_verified_at',
        'password',
        'remember_token',
        'onDuty',
        'cid',
        'steamId',
        'IsAdmin',
        'disabled',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'cell' => 'string',
        'towID' => 'string',
        'role' => 'string',
        'workingAs' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'onDuty' => 'boolean',
        'cid' => 'integer',
        'steamId' => 'string',
        'IsAdmin' => 'boolean',
        'disabled' => 'boolean',
    ];


    /**
     *
     * Overwrite whereOnDuty with correct column name
     * @param  mixed  $value
     * @return Builder
     */
     public static function whereOnDuty($value)
     {
         return static::where('onDuty','=',$value);
     }

    /**
     *
     * Overwrite whereSteamId with correct column name
     * @param  mixed  $value
     * @return Builder
     */
    public static function whereSteamId($value)
    {
        return static::where('steamId','=',$value);
    }

}
