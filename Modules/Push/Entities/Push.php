<?php

namespace Modules\Push\Entities;

class Push extends PushBaseModel
{
    protected $table = 'push';

    protected $fillable = [
        'title', 'content', 'user_id', 'user_account',
    ];
}
