<?php

namespace Modules\Forum\Entities;

/**
 * Class Article
 * @package Modules\Forum\Entities
 */
class Article extends ForumBaseModel
{
    protected $table = 'article';

    protected $touches = ['parent'];

    protected $fillable = [
        'forum_id', 'parent_id', 'title', 'context', 'audit',
        'user_id', 'user_account', 'user_nick_name',
        'audit_user_id', 'audit_user_account', 'audit_user_nick_name',
    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
