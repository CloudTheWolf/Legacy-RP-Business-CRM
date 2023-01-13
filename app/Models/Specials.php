<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Specials
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property boolean $deleted
 * @method static \Illuminate\Database\Eloquent\Builder|Specials newModalQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specials newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specials query()
 * @method static \Illuminate\Database\Eloquent\Builder|Specials whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specials whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specials whereDeleted($value)
 * @mixin \Eloquent
 */

class Specials extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'specials';

    /**
     *  Does the table have a created_at and updated_at column?
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
      'name',
      'price',
      'deleted'
    ];

    /**
     * @var array
     */
    protected $casts = [
      'id' => 'integer',
      'name' => 'string',
      'price' => 'integer',
      'deleted' => 'boolean',
    ];
}
