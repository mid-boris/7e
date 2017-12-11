<?php

namespace Modules\Entrust\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Services\RoleNodeService;

class NodeController extends Controller
{
    /** @var RoleNodeService  */
    protected $roleNodeServ;

    public function __construct(RoleNodeService $roleNodeService)
    {
        $this->roleNodeServ = $roleNodeService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return BaseResponse::response([
            'data' => $this->roleNodeServ->getNodesByRole(),
        ]);
    }
}
