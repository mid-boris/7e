<?php
namespace Modules\Popularity\Entities;

class Forum extends \Modules\Forum\Entities\Forum
{
    public function popularity()
    {
        return $this->hasMany(ForumPopularity::class, 'forum_id');
    }

    public function popularitySingle()
    {
        return $this->hasMany(ForumPopularitySingle::class, 'forum_id');
    }
}
