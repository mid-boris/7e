<?php
namespace Modules\Forum\Services;

use Modules\Forum\Entities\Article;
use Modules\Forum\Entities\Forum;

class ForumService
{
    public function getArticle(int $forumId)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $article */
        $article = new Article;
        $articles = $article->orderNew()->where('audit', 0)->where('forum_id', $forumId)->paginate(35);
        return $articles;
    }

    public function needToReview(int $forumId)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $forum */
        $forum = new Forum;
        $item = $forum->where('id', $forumId)->where('audit', 1)->count();
        return $item;
    }
}
