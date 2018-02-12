<?php

namespace Modules\Popularity\Entities;

use Modules\User\Entities\User;

class Shop extends \Modules\Shop\Entities\Shop
{
    public function popularity()
    {
        return $this->hasMany(ShopPopularity::class, 'shop_id');
    }

    public function popularitySingle()
    {
        return $this->hasMany(ShopPopularitySingle::class, 'shop_id');
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class, 'user_shop', 'shop_id', 'user_id');
    }
}
