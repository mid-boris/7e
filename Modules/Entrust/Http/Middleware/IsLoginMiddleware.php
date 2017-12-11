<?php

namespace Modules\Entrust\Http\Middleware;

use Closure;
use Modules\Base\Exception\BaseException;
use Session;
use Modules\Error\Constants\ErrorCode;
use Illuminate\Http\Request;

class IsLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('user')) {
            return $next($request);
        }
        throw new BaseException(
            trans('entrust::errors.' . ErrorCode::ENTRUST_USER_LOGIN_ERROR),
            ErrorCode::ENTRUST_USER_LOGIN_ERROR
        );
    }
}
