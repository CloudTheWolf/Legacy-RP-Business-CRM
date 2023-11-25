<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RepairLog
 *
 * @property int $id
 * @property int $mechanic
 * @property int $cid
 * @property string|null $customer_name
 * @property string|null $vehicle
 * @property int $scrap_used
 * @property int $alum_used
 * @property int $steel_used
 * @property int $glass_used
 * @property int $rubber_used
 * @property int $advKit
 * @property int $oil
 * @property int $cost
 * @property \Illuminate\Support\Carbon $timestamp
 * @property bool $deleted
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereAlumUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereGlassUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereMechanic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereRubberUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereScrapUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereSteelUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairLog whereVehicle($value)
 * @mixin \Eloquent
 */
class RepairLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repair_log';

    /**
     * @var array
     */
    protected $fillable = [
        'mechanic',
        'customer_name',
        'cid',
        'vehicle',
        'scrap_used',
        'alum_used',
        'steel_used',
        'glass_used',
        'rubber_used',
        'advKit',
        'oil',
        'cost',
        'timestamp',
        'deleted',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'mechanic' => 'integer',
        'cid' => 'integer',
        'customer_name' => 'string',
        'vehicle' => 'string',
        'scrap_used' => 'integer',
        'alum_used' => 'integer',
        'steel_used' => 'integer',
        'glass_used' => 'integer',
        'rubber_used' => 'integer',
        'advKit' => 'integer',
        'oil' => 'integer',
        'cost' => 'integer',
        'timestamp' => 'datetime',
        'deleted' => 'boolean',
    ];

    public $timestamps = false;

    public function users() {
        return $this->belongsTo(User::class, 'cid','cid');
    }

}
