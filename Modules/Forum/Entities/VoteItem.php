<?php

namespace Modules\Forum\Entities;

use Illuminate\Database\Eloquent\Model;

class VoteItem extends Model
{
    protected $table = 'vote_item';

    protected $fillable = [
        'article_id', 'vote_id', 'user_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
