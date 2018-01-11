<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\ApiLogin;
use Modules\Api\Http\Requests\ApiLogout;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Utilities\Auth;

class ApiController extends Controller
{
    public function login(ApiLogin $request)
    {
        $account = $request->input('user');
        $password = $request->input('password');
        $user = Auth::login($account, $password);
        return BaseResponse::response($user);
    }

    public function remoteLogin(ApiLogin $request)
    {
        $account = $request->input('user');
        $password = $request->input('password');
        $user = \Modules\RemoteSystem\Entrust\Utilities\Auth::login($account, $password);
        return BaseResponse::response($user);
    }

    public function logout()
    {
        Auth::logout();
        return BaseResponse::response([
            'data' => true,
        ]);
    }

    public function isLogin()
    {
        return BaseResponse::response([
            'data' => Auth::isLogin(),
        ]);
    }
}
