<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\ArticleIndex;
use Modules\Api\Http\Requests\ArticleShow;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Forum\Repositories\ArticleRepository;
use Modules\Forum\Services\ForumService;

class ArticleController extends Controller
{
    public function index(ArticleIndex $request)
    {
        $forumId = $request->input('forum_id');
        /** @var ForumService $forumServ */
        $forumServ = app()->make(ForumService::class);
        $articles = $forumServ->getArticle($forumId);
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
}
