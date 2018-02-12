<?php

namespace Modules\Popularity\Entities;

use Illuminate\Database\Eloquent\Model;

class ShopPopularitySingle extends Model
{
    protected $table = 'shop_popularity_single';

    protected $fillable = [
        'shop_id', 'day', 'user_id', 'area_id', 'gender',
    ];
}
