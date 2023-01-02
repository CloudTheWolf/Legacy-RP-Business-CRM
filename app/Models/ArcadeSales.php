<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArcadeSales
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $staff
 * @property int $pizza
 * @property int $hotdog
 * @property int $nacho
 * @property int $waffle
 * @property int $water
 * @property int $coke
 * @property int $milk
 * @property int $beer
 * @property int $cider
 * @property int $tequila
 * @property int $wine
 * @property int $vodka
 * @property int $absinthe
 * @property int $rum
 * @property int $whiskey
 * @property int $zombie
 * @property int $arena
 * @property int $arenaPizza
 * @property int $lunchSpecial
 * @property int $fullPie
 * @property int $mexicanWave
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereAbsinthe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereArena($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereArenaPizza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereBeer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereCider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereCoke($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereFullPie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereHotdog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereLunchSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereMexicanWave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereMilk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereNacho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales wherePizza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereRum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereTequila($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereVodka($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereWaffle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereWhiskey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereWine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArcadeSales whereZombie($value)
 * @mixin \Eloquent
 */
class ArcadeSales extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'arcadeSales';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'staff',
        'pizza',
        'hotdog',
        'nacho',
        'waffle',
        'water',
        'coke',
        'milk',
        'beer',
        'cider',
        'tequila',
        'wine',
        'vodka',
        'absinthe',
        'rum',
        'whiskey',
        'zombie',
        'arena',
        'arenaPizza',
        'lunchSpecial',
        'fullPie',
        'happyHour',
        'mexicanWave',
        'finalCost'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'staff' => 'integer',
        'pizza' => 'integer',
        'hotdog' => 'integer',
        'nacho' => 'integer',
        'waffle' => 'integer',
        'water' => 'integer',
        'coke' => 'integer',
        'milk' => 'integer',
        'beer' => 'integer',
        'cider' => 'integer',
        'tequila' => 'integer',
        'wine' => 'integer',
        'vodka' => 'integer',
        'absinthe' => 'integer',
        'rum' => 'integer',
        'whiskey' => 'integer',
        'zombie' => 'integer',
        'arena' => 'integer',
        'arenaPizza' => 'integer',
        'lunchSpecial' => 'integer',
        'fullPie' => 'integer',
        'happyHour' => 'integer',
        'mexicanWave' => 'integer',
        'finalCost' => 'integer'
    ];

    public $timestamps = false;
}
