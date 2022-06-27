<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BuyTemplate
 *
 * @property int $userId
 * @property int $scrap
 * @property int $alum
 * @property int $steel
 * @property int $glass
 * @property int $rubber
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate whereAlum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate whereGlass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate whereRubber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate whereScrap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate whereSteel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyTemplate whereUserId($value)
 * @mixin \Eloquent
 */
class BuyTemplate extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'buyTemplate';

    /**
     * @var array
     */
    protected $fillable = [
        'userId',
        'scrap',
        'alum',
        'steel',
        'glass',
        'rubber',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'userId' => 'integer',
        'scrap' => 'integer',
        'alum' => 'integer',
        'steel' => 'integer',
        'glass' => 'integer',
        'rubber' => 'integer',
    ];

}
