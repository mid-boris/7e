<?php

namespace Modules\User\Services;

use Modules\Base\Exception\BaseException;
use Modules\Entrust\Repositories\RoleRepository;
use Modules\Error\Constants\ErrorCode;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class UserService extends UserBaseService
{
    public function createAccountAddRole(array $attributes, string $roleName)
    {
        /** @var UserRepository $userRepo */
        $userRepo = \App::make(UserRepository::class);
        $user = $userRepo->createAttributes($attributes);
        $this->accountModelAddRole($user, $roleName);
    }

    public function accountModelAddRole(User $user, string $roleName)
    {
        /** @var RoleRepository $roleRepo */
        $roleRepo = \App::make(RoleRepository::class);
        /** @var \Modules\Entrust\Entities\Role $role */
        $role = $roleRepo->getByName($roleName);
        if (!$role) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::ENTRUST_ROLE_NOT_FOUND),
                ErrorCode::ENTRUST_ROLE_NOT_FOUND
            );
        }

        $user->role()->attach($role->id);
    }
    
    public function accountAddRole(string $account, string $roleName)
    {
        /** @var UserRepository $userRepo */
        $userRepo = \App::make(UserRepository::class);
        /** @var \Modules\User\Entities\User $user */
        $user = $userRepo->getByAccount($account);
        if (!$user) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::ENTRUST_USER_NOT_FOUND),
                ErrorCode::ENTRUST_USER_NOT_FOUND
            );
        }

        /** @var RoleRepository $roleRepo */
        $roleRepo = \App::make(RoleRepository::class);
        /** @var \Modules\Entrust\Entities\Role $role */
        $role = $roleRepo->getByName($roleName);
        if (!$role) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::ENTRUST_ROLE_NOT_FOUND),
                ErrorCode::ENTRUST_ROLE_NOT_FOUND
            );
        }

        $user->role()->attach($role->id);
    }

    public function accountAddRoleByRoleId(string $account, int $roleId)
    {
        /** @var UserRepository $userRepo */
        $userRepo = \App::make(UserRepository::class);
        /** @var \Modules\User\Entities\User $user */
        $user = $userRepo->getByAccount($account);
        if (!$user) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::ENTRUST_USER_NOT_FOUND),
                ErrorCode::ENTRUST_USER_NOT_FOUND
            );
        }

        /** @var RoleRepository $roleRepo */
        $roleRepo = \App::make(RoleRepository::class);
        /** @var \Modules\Entrust\Entities\Role $role */
        $role = $roleRepo->getById($roleId);
        if (!$role) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::ENTRUST_ROLE_NOT_FOUND),
                ErrorCode::ENTRUST_ROLE_NOT_FOUND
            );
        }

        $user->role()->detach();
        $user->role()->attach($role->id);
    }
}
