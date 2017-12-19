<?php

namespace Modules\Entrust\Utilities;

use Lang;
use Modules\Base\Exception\BaseException;
use Session;
use Modules\Error\Constants\ErrorCode;
use Modules\User\Repositories\UserRepository;

class Auth
{
    public static function login(string $account, string $password)
    {
        $password = md5($password);
        $userRepo = app()->make(UserRepository::class);
        $result = $userRepo->getWithRoleByAccountPassword($account, $password);
        if (!$result) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::ENTRUST_USER_VALIDATE_ERROR),
                ErrorCode::ENTRUST_USER_VALIDATE_ERROR
            );
        }
        Session::put('user', $result->toArray());
        Session::save();
        return $result;
    }

    public static function logout()
    {
        Session::flush();
    }

    public static function isLogin() : bool
    {
        return SessionManager::isLogin();
    }
}
