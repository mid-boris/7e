<?php

namespace Modules\Popularity\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Shop;

class ShopPopularity extends Model
{
    protected $table = 'shop_popularity';

    protected $fillable = [
        'shop_id', 'day', 'accumulation_popularity',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
