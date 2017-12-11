<?php
namespace Modules\Forum\Entities;

class Forum extends ForumBaseModel
{
    protected $table = 'forum';

    protected $fillable = [
        'parent_id', 'name', 'audit', 'status', 'sort',
    ];

    public function article()
    {
        return $this->hasMany(Article::class, 'forum_id');
    }
}
