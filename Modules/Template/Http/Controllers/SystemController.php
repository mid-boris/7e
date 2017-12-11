<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Services\RoleNodeService;
use Modules\Template\Http\Requests\SystemPermission;

class SystemController extends Controller
{
    /** @var RoleNodeService  */
    private $roleNodeServ;

    public function __construct(RoleNodeService $roleNodeService)
    {
        $this->roleNodeServ = $roleNodeService;
    }

    public function permissionUpdate(SystemPermission $request)
    {
        $nodeIds = $request->input('node') ?? [];
        $result = $this->roleNodeServ->addNodeToRoleById($request->input('role'), $nodeIds);
        return BaseResponse::response([
            'data' => $result,
        ]);
    }
}
