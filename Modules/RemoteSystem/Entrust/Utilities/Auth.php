<?php
namespace Modules\RemoteSystem\Entrust\Utilities;

use Modules\Base\Exception\BaseException;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Error\Constants\ErrorCode;
use Modules\RemoteSystem\Src\GloryConnection;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\UserService;
use Session;

class Auth
{
    public static function login(string $account, string $password)
    {
        /** @var GloryConnection $connection */
        $connection = app()->make(GloryConnection::class);
        $userInfo = $connection->sendToken($account, $password)->sendUserInfo()->getUserInfo();

        if ($userInfo) {
            $password = md5($password);

            /** @var UserRepository $userRepo */
            $userRepo = app()->make(UserRepository::class);
            $result = $userRepo->getWithRoleByAccountPassword($account, $password);
            $phone = $userInfo['phone']['number'] ?? null;
            $userData = [
                'account' => $account,
                'password' => $password,
                'phone' => $phone,
                'trivial' => json_encode($userInfo),
            ];
            // 帳號存在就 update
            if ($result) {
                $userRepo->update($userData, $result->getKey());
            } else {
                // 使用service新增 順便增加腳色
                /** @var UserService $userServ */
                $userServ = app()->make(UserService::class);
                $userServ->createAccountAddRole($userData, '榮耀會員');
                $result = $userRepo->getWithRoleByAccountPassword($account, $password);
            }
        } else {
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
