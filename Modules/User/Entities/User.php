<?php

namespace Modules\User\Entities;

use Modules\Entrust\Entities\Role;

/**
 * Class User
 * @package Modules\User\Entities
 */
class User extends UserBaseModel
{
    protected $table = 'user';

    protected $fillable = [
        'account', 'password', 'nick_name', 'status',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_role')
            ->as('relate');
    }
}
