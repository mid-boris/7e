<?php

namespace Modules\RemoteSystem\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\RemoteSystem\Src\GloryConnection;

class RemoteSystemController extends Controller
{
    public function index()
    {
        /** @var GloryConnection $connection */
        $connection = app()->make(GloryConnection::class);
        $user = 'tuohoi87';
        $password = '123456';
        $connection->sendToken($user, $password)->sendUserInfo()->getUserInfo();
    }
}
