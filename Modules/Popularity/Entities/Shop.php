<?php

namespace Modules\Popularity\Entities;

use Modules\User\Entities\User;

class Shop extends \Modules\Shop\Entities\Shop
{
    public function popularity()
    {
        return $this->hasMany(ShopPopularity::class, 'shop_id');
    }

    public function popularitySingleMale()
    {
        return $this->hasMany(ShopPopularitySingle::class, 'shop_id')->where('gender', 0);
    }

    public function popularitySingleFemale()
    {
        return $this->hasMany(ShopPopularitySingle::class, 'shop_id')->where('gender', 1);
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class, 'user_shop', 'shop_id', 'user_id');
    }
}
