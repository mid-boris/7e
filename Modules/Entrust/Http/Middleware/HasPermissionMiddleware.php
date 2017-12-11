<?php

namespace Modules\Entrust\Http\Middleware;

use Closure;
use Modules\Base\Exception\BaseException;
use Modules\Entrust\Services\NodePermissionService;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Error\Constants\ErrorCode;
use Session;
use Illuminate\Http\Request;

class HasPermissionMiddleware
{
    /** @var NodePermissionService  */
    private $pmServ;

    public function __construct(NodePermissionService $service)
    {
        $this->pmServ = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws BaseException
     */
    public function handle(Request $request, Closure $next)
    {
        $roleIdSym = 'user.role.0.id';
        if (Session::has($roleIdSym)) {
            $roleId = SessionManager::getRoleId();
            $uri = $request->getPathInfo();
            if ($this->pmServ->roleHasPermissionByRoleIdAndUri($roleId, $uri) > 0) {
                return $next($request);
            }
        }
        throw new BaseException(
            trans('entrust::errors.' . ErrorCode::ENTRUST_USER_PERMISSION_ERROR),
            ErrorCode::ENTRUST_USER_PERMISSION_ERROR
        );
    }
}
