<?php

namespace Modules\Message\Entities;

class Message extends MessageBaseModel
{
    protected $table = 'message';

    protected $fillable = [
        'content', 'target_id', 'target_account', 'target_nick_name',
        'user_id', 'user_account', 'user_nick_name',
    ];
}
