<?php

namespace Modules\Forum\Entities;

use Illuminate\Database\Eloquent\Model;

class ArticleLike extends Model
{
    protected $table = 'article_like';

    protected $fillable = [
        'article_id', 'user_id', 'like_type',
    ];

    public $timestamps = false;
}
