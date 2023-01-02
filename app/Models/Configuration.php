<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Configuration
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property string $group
 * @method static Builder|Storage newModelQuery()
 * @method static Builder|Storage newQuery()
 * @method static Builder|Storage query()
 * @method static Builder|Storage whereId($value)
 * @method static Builder|Storage whereName($value)
 * @method static Builder|Storage whereValue($value)
 * @method static Builder|Storage whereGroup($value)
 * @mixin \Eloquent
 *
 */

class Configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'config';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Does the table have the Timestamp columns
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'value',
        'group'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'value' => 'string',
        'group' => 'string'
    ];
}
