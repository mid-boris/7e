<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\UserService;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /** @var UserRepository $userRepo */
        $userRepo = \App::make(UserRepository::class);
        $userRepo->create('admin', 'aa1234', 'admin');

        // 幫admin加入角色admin
        /** @var UserService $userSv */
        $userSv = \App::make(UserService::class);
        $userSv->accountAddRole('admin', 'admin');

        // 測試會員
        $userRepo->create('member', 'member', '會員一號');
        $userSv->accountAddRole('member', '榮耀會員');
    }
}
