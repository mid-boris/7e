<?php

namespace Modules\Entrust\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Repositories\NodeRepository;
use Modules\Entrust\Repositories\RoleRepository;
use Modules\Entrust\Services\RoleNodeService;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return BaseResponse
     */
    public function index()
    {
        /** @var RoleNodeService $roleNodeServ */
        $roleNodeServ = app()->make(RoleNodeService::class);
        $roleNodeServ->addAllNodeToRole('admin');

        return BaseResponse::response('test ok');
    }
}
