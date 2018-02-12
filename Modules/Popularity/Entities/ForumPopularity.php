<?php

namespace Modules\Popularity\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Forum\Entities\Forum;

/**
 * Class ForumPopularity
 * @package Modules\Popularity\Entities
 */
class ForumPopularity extends Model
{
    protected $table = 'forum_popularity';

    protected $fillable = [
        'forum_id', 'day', 'accumulation_popularity'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
