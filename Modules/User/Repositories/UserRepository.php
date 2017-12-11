<?php

namespace Modules\User\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\User\Entities\User;

class UserRepository extends UserBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $account
     * @param string $password
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getWithRoleByAccountPassword(string $account, string $password)
    {
        /** @var \Eloquent $user */
        $user = new User;
        return $user->with('role')->where('account', $account)->where('password', $password)->first();
    }

    public function getPaginationWithRole(int $perpage = 50)
    {
        /** @var \Eloquent $user */
        $user = new User;
        $user = $user->with(['role']);
        if (!SessionManager::isAdmin()) {
            $user = $user->where('account', '!=', 'admin');
        }
        return $user->orderBy('id', 'DESC')->paginate($perpage);
    }

    /**
     * @param string $account
     * @param string $password
     * @param string $nickName
     * @param int $status
     * @return bool
     */
    public function create(string $account, string $password, string $nickName, $status = 1)
    {
        $user = new User;
        return $user->fill([
            'account' => $account,
            'password' => md5($password),
            'nick_name' => $nickName,
            'status' => $status,
        ])->save();
    }

    public function update(array $data, int $id)
    {
        /** @var \Eloquent $user */
        $user = new User;
        $target = $user->where('id', $id)->first();
        if ($target) {
            return $target->fill($data)->save();
        }
        return false;
    }

    public function getByAccount(string $account)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $user */
        $user = new User;
        return $user->where('account', $account)->first();
    }
}
