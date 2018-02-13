<?php
namespace Modules\Forum\Entities;

use Modules\Image\Entities\ImageFile;

/**
 * Class Article
 * @package Modules\Forum\Entities
 */
class Article extends ForumBaseModel
{
    protected $table = 'article';

    protected $touches = ['parent'];

    protected $fillable = [
        'forum_id', 'parent_id', 'title', 'context', 'audit', 'vote_max_count', 'vote_end_time',
        'user_id', 'user_account', 'user_nick_name',
        'audit_user_id', 'audit_user_account', 'audit_user_nick_name',
        'avatar',
    ];

    protected $hidden = [
        'created_at',
        'audit_user_id', 'audit_user_account', 'audit_user_nick_name', 'user_id',
    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function voteOption()
    {
        return $this->hasMany(Vote::class, 'article_id');
    }

    public function voteItem()
    {
        return $this->hasMany(VoteItem::class, 'article_id');
    }

    public function images()
    {
        return $this->belongsToMany(ImageFile::class, 'article_image_file', 'article_id', 'image_id')
            ->orderBy('id');
    }

    public function test()
    {
        return $this->hasMany(VoteItem::class, 'article_id');
    }
}
