<?php

namespace Modules\Shop\Entities;

use Modules\Area\Entities\Area;
use Modules\Area\Entities\GoogleArea;

class Shop extends ShopBaseModel
{
    protected $table = 'shop';

    protected $fillable = [
        'name', 'telphone', 'phone', 'business_hours',
        'business_hours_start_time', 'business_hours_end_time',
        'special', 'area_id', 'address', 'closed_day', 'i_pass',
        'shop_lat', 'shop_lng',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class)->with(['parent']);
    }

    public function googleArea()
    {
        return $this->hasMany(GoogleArea::class, 'shop_id');
    }
}
