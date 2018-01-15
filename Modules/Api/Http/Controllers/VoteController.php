<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Forum\Http\Requests\VoteAdd;
use Modules\Forum\Services\VoteService;

class VoteController extends Controller
{
    /** @var VoteService  */
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function add(VoteAdd $request)
    {
        $voteIds = $request->input('vote_ids');
        $articleId = $request->input('article_id');
        $this->voteService->voteIncrement($voteIds, $articleId);
        return BaseResponse::response(['data' => true]);
    }
}
