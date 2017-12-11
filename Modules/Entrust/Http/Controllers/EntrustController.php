<?php

namespace Modules\Entrust\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Exception\BaseException;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Http\Requests\LoginPost;
use Modules\Entrust\Utilities\Auth;

class EntrustController extends Controller
{
    /**
     * @param LoginPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginPost $request)
    {
        $account = $request->input('user');
        $password = $request->input('password');
        Auth::login($account, $password);
        return BaseResponse::response([
            'data' => true,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return BaseResponse::response([
            'data' => true,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function isLogin()
    {
        return BaseResponse::response([
            'data' => Auth::isLogin(),
        ]);
    }
}
