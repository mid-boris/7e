<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\ArticleIndex;
use Modules\Api\Http\Requests\ArticleShow;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Forum\Http\Requests\ArticleCreate;
use Modules\Forum\Repositories\ArticleRepository;
use Modules\Forum\Services\ForumService;
use Modules\Popularity\Repositories\ForumPopularityRepository;

class ArticleController extends Controller
{
    public function index(ArticleIndex $request)
    {
        $forumId = $request->input('forum_id');
        /** @var ForumService $forumServ */
        $forumServ = app()->make(ForumService::class);
        $articles = $forumServ->getArticle($forumId);
        // 埋入加人氣之方法
        /** @var ForumPopularityRepository $popularityRepo */
        $popularityRepo = app()->make(ForumPopularityRepository::class);
        $popularityRepo->addPopularity($forumId);
        return BaseResponse::response($articles);
    }
    
    public function show(ArticleShow $request)
    {
        $articleId = $request->input('article_id');
        /** @var ArticleRepository $articleRepo */
        $articleRepo = app()->make(ArticleRepository::class);
        $article = $articleRepo->getArticleByParentId($articleId);
        $reports = $articleRepo->getReportByParentId($articleId, 'DESC');
        return BaseResponse::response([
            'article' => $article,
            'reports' => $reports,
        ]);
    }

    public function create(ArticleCreate $request)
    {
        /** @var ForumService $forumServ */
        $forumServ = app()->make(ForumService::class);
        $forumId = $request->input('forum_id');
        $needReview = $forumServ->needToReview($forumId);

        /** @var ArticleRepository $articleRepo */
        $articleRepo = app()->make(ArticleRepository::class);
        $title = $request->input('title');
        $text = $request->input('content');
        $parentId = $request->input('parent_id');
        $voteMaxCount = $request->input('vote_max_count') ?? 1;
        $voteEndTime = $request->input('vote_end_time');
        $article = $articleRepo->create($title, $text, $forumId, $needReview, $voteMaxCount, $parentId, $voteEndTime);
        // 如果有投票項目
        if (!is_null($request->input('vote_option'))) {
            $vote = [];
            foreach ($request->input('vote_option') as $item) {
                $vote[] = ['option_name' => $item];
            }
            $articleRepo->voteCreateMany($article, $vote);
        }
        // 如果有圖片
        if (!is_null($request->input('image'))) {
            if (count($request->input('image')) > 0) {
                foreach ($request->input('image') as $image) {
                    $articleRepo->imageCreate($article, $image);
                }
            }
        }
        return BaseResponse::response(['data' => true]);
    }
}
