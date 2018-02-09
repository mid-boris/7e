<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\SurpriseUsed;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Surprise\Services\SurpriseService;

class SurpriseController extends Controller
{
    public function index()
    {
        /** @var SurpriseService $surpriseServ */
        $surpriseServ = app()->make(SurpriseService::class);
        return BaseResponse::response(['data' => $surpriseServ->list()]);
    }
    
    public function lucky()
    {
        /** @var SurpriseService $surpriseServ */
        $surpriseServ = app()->make(SurpriseService::class);
        return BaseResponse::response(['data' => $surpriseServ->lucky()]);
    }

    public function used(SurpriseUsed $require)
    {
        /** @var SurpriseService $surpriseServ */
        $surpriseServ = app()->make(SurpriseService::class);
        $surpriseServ->used($require->input('id'));
        return BaseResponse::response(['data' => true]);
    }
}
