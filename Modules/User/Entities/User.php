<?php

namespace Modules\User\Entities;

use Modules\Entrust\Entities\Role;
use Modules\Shop\Entities\Shop;

/**
 * Class User
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
}
