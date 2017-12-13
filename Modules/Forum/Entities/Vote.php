<?php

namespace Modules\Forum\Entities;

use Modules\User\Entities\User;

class Vote extends ForumBaseModel
{
    protected $table = 'vote';

    protected $fillable = [
        'article_id', 'option_name', 'vote_count',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function item()
    {
        return $this->belongsToMany(User::class, 'vote_item');
    }
}
