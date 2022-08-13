<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Storage
 *
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property int $scrap
 * @property int $aluminium
 * @property int $steel
 * @property int $glass
 * @property int $rubber
 * @method static \Illuminate\Database\Eloquent\Builder|Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereAluminium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereGlass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereRubber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereScrap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereSteel($value)
 * @mixin \Eloquent
 */
class Storage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storage';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'capacity',
        'scrap',
        'aluminium',
        'steel',
        'glass',
        'rubber',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'capacity' => 'integer',
        'scrap' => 'integer',
        'aluminium' => 'integer',
        'steel' => 'integer',
        'glass' => 'integer',
        'rubber' => 'integer',
    ];

    public $timestamps = false;

}
