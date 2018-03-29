<?php

namespace Modules\User\Entities;

use Modules\Entrust\Entities\Role;
use Modules\Shop\Entities\Shop;
use Modules\Surprise\Entities\SurpriseItem;

/**
 * Class User
 * @property string avatar
 * @package Modules\User\Entities
 */
class User extends UserBaseModel
{
    protected $table = 'user';

    protected $fillable = [
        'account', 'password', 'nick_name', 'status', 'mail', 'phone', 'gender', 'area_id',
        'avatar', 'trivial', 'language',
    ];

    protected $hidden = [
        'password', 'status', 'trivial',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_role')
            ->as('relate');
    }

    public function shop()
    {
        return $this->belongsToMany(Shop::class, 'user_shop', 'user_id', 'shop_id');
    }

    public function shopReferStatus()
    {
        return $this->shop()->where('status', 1);
    }

    public function surpriseToday()
    {
        $today = strtotime(date('Y-m-d'));
        return $this->belongsToMany(SurpriseItem::class, 'user_surprise_item', 'user_id', 'surprise_item_id')
            ->where('manufacture', $today);
    }

    public function surprise()
    {
        return $this
            ->belongsToMany(SurpriseItem::class, 'user_surprise_item', 'user_id', 'surprise_item_id')
            ->withTimestamps()
            ->withPivot(['id', 'used', 'expiration_date_time', 'manufacture']);
    }
}
