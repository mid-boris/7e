<?php
namespace Modules\Forum\Services;

use Modules\Entrust\Utilities\SessionManager;
use Modules\Forum\Entities\Article;
use Modules\Forum\Entities\Forum;

class ForumService
{
    public function getArticle(int $forumId)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $article */
        $article = new Article;
        $articles = $article->orderNew()->where(function ($query) use ($forumId) {
            /** @var \Illuminate\Database\Query\Builder $query */
            $query->whereNull('parent_id')->where('audit', 0)->where('forum_id', $forumId);
        })->orWhere(function ($query) use ($forumId) {
            /** @var \Illuminate\Database\Query\Builder $query */
            $query->whereNull('parent_id')->where('user_id', SessionManager::getUserId())->where('forum_id', $forumId);
        })->paginate(35);
        return $articles;
    }

    public function getArticleWithChildren(int $forumId, int $childrenCount = 3)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $article */
        $article = new Article;
        $articles = $article
            ->orderNew()
            ->withCount(['children'])
            ->where(function ($query) use ($forumId) {
            /** @var \Illuminate\Database\Query\Builder $query */
                $query->whereNull('parent_id')->where('audit', 0)->where('forum_id', $forumId);
            })->orWhere(function ($query) use ($forumId) {
                /** @var \Illuminate\Database\Query\Builder $query */
                $query->whereNull('parent_id')
                    ->where('user_id', SessionManager::getUserId())
                    ->where('forum_id', $forumId);
            })->paginate(35);

            $childrenCount *= $articles->total();
            $articles->load(['children' => function ($query) use ($childrenCount) {
                /** @var \Illuminate\Database\Query\Builder $query */
                $query->orderBy('updated_at', 'DESC')->limit($childrenCount);
            }, 'voteOption', 'voteItem']);

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
