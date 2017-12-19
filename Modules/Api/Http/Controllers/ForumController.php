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
        if (is_null($forumId)) {
            // 拿取所有投票版
            /** @var ForumRepository $forumRepo */
            $forumRepo = app()->make(ForumRepository::class);
            $data = $forumRepo->getVoteForum();
        } else {
            // 拿取特定投票版的文章
            /** @var ForumService $forumServ */
            $forumServ = app()->make(ForumService::class);
            $data = $forumServ->getArticleWithChildren($forumId);
        }
        return BaseResponse::response($data);
    }

    public function board(Board $request)
    {
        $forumId = $request->input('forum_id');
        if (is_null($forumId)) {
            // 拿取所有討論版
            /** @var ForumRepository $forumRepo */
            $forumRepo = app()->make(ForumRepository::class);
            $data = $forumRepo->getVoteForum();
        } else {
            // 拿取特定討論版的文章
            /** @var ForumService $forumServ */
            $forumServ = app()->make(ForumService::class);
            $data = $forumServ->getArticleWithChildren($forumId);
        }
        return BaseResponse::response($data);
    }
}
