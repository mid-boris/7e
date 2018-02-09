<?php

namespace Modules\Popularity\Entities;

use Illuminate\Database\Eloquent\Model;

class ForumPopularitySingle extends Model
{
    protected $table = 'forum_popularity_single';

    protected $fillable = [
        'forum_id', 'day', 'user_id', 'area_id', 'gender',
    ];
}
