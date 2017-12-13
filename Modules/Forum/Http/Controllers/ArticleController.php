<?php

namespace Modules\Forum\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Forum\Http\Requests\ArticleCreate;
use Modules\Forum\Http\Requests\ArticleDelete;
use Modules\Forum\Http\Requests\AuditPass;
use Modules\Forum\Repositories\ArticleRepository;
use Modules\Forum\Services\ForumService;

class ArticleController extends Controller
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepo = $articleRepository;
    }

    public function auditCount()
    {
        $count = $this->articleRepo->getAuditCount();
        return BaseResponse::response([
            'article_audit_count' => $count,
        ]);
    }

    public function create(ArticleCreate $request)
    {
        /** @var ForumService $forumServ */
        $forumServ = app()->make(ForumService::class);
        $forumId = $request->input('forum_id');
        $needReview = $forumServ->needToReview($forumId);

        $title = $request->input('title');
        $text = $request->input('content');
        $parentId = $request->input('parent_id');
        $voteMaxCount = $request->input('vote_max_count') ?? 1;
        $article = $this->articleRepo->create($title, $text, $forumId, $needReview, $voteMaxCount, $parentId);
        // 如果有投票項目
        if (!is_null($request->input('vote_option'))) {
            $vote = [];
            foreach ($request->input('vote_option') as $item) {
                $vote[] = ['option_name' => $item];
            }
            $this->articleRepo->voteCreateMany($article, $vote);
        }
        return redirect()->back();
    }

    public function auditPass(AuditPass $request)
    {
        $id = $request->input('id');
        $this->articleRepo->auditPass($id);
        return redirect()->back();
    }

    public function delete(ArticleDelete $request)
    {
        $id = $request->input('id');
        $this->articleRepo->delete($id);
        return redirect()->back();
    }
}
