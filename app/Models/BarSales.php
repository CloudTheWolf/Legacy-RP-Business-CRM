<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BarSales
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $staff
 * @property int $beer
 * @property int $cider
 * @property int $tequila
 * @property int $wine
 * @property int $vodka
 * @property int $absinthe
 * @property int $rum
 * @property int $whiskey
 * @property int $oiler
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales query()
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereAbsinthe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereBeer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereCider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereRum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereTequila($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereVodka($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereWhiskey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereWine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BarSales whereOiler($value)
 * @mixin \Eloquent
 */
class BarSales extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barSales';

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
        'beer',
        'cider',
        'tequila',
        'wine',
        'vodka',
        'absinthe',
        'rum',
        'whiskey',
        'oiler',
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
        'beer' => 'integer',
        'cider' => 'integer',
        'tequila' => 'integer',
        'wine' => 'integer',
        'vodka' => 'integer',
        'absinthe' => 'integer',
        'rum' => 'integer',
        'whiskey' => 'integer',
        'oiler' => 'integer',
        'finalCost' => 'integer'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
