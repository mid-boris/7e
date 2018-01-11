<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\Board;
use Modules\Api\Http\Requests\Vote;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Forum\Repositories\ForumRepository;
use Modules\Forum\Services\ForumService;

class ForumController extends Controller
{
    public function vote(Vote $request)
    {
        $forumId = $request->input('forum_id');
        /** @var ForumRepository $forumRepo */
        $forumRepo = app()->make(ForumRepository::class);
        if (is_null($forumId)) {
            $forumId = $forumRepo->getVoteId();
        }
        // 拿取指定投票版
        $forums = $forumRepo->getPaginationForumById($forumId);
        // 拿取特定投票版的文章
        /** @var ForumService $forumServ */
        $forumServ = app()->make(ForumService::class);
        $articles = $forumServ->getArticleWithChildren($forumId);
        return BaseResponse::response([
            'forum' => $forums,
            'article' => $articles,
        ]);
    }

    public function board(Board $request)
    {
        $forumId = $request->input('forum_id');
        /** @var ForumRepository $forumRepo */
        $forumRepo = app()->make(ForumRepository::class);
        if (is_null($forumId)) {
            $forumId = $forumRepo->getBoardId();
        }
        // 拿取指定討論版
        $forums = $forumRepo->getPaginationForumById($forumId);
        // 拿取特定討論版的文章
        /** @var ForumService $forumServ */
        $forumServ = app()->make(ForumService::class);
        $articles = $forumServ->getArticleWithChildren($forumId);
        return BaseResponse::response([
            'forum' => $forums,
            'article' => $articles,
        ]);
    }
}
