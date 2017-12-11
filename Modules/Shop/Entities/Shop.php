<?php

namespace Modules\Shop\Entities;

use Modules\Area\Entities\Area;

class Shop extends ShopBaseModel
{
    protected $table = 'shop';

    protected $fillable = [
        'name', 'x', 'y', 'telphone', 'phone', 'business_hours',
        'business_hours_start_time', 'business_hours_end_time',
        'special', 'area_id', 'address', 'closed_day',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class)->with(['parent']);
    }
}
