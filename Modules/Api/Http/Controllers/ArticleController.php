<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\ArticleShow;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Forum\Repositories\ArticleRepository;

class ArticleController extends Controller
{
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
