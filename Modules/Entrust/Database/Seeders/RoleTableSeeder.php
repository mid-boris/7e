<?php

namespace Modules\Entrust\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Entrust\Repositories\RoleRepository;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /** @var RoleRepository $roleRepo */
        $roleRepo = \App::make(RoleRepository::class);
        $roleRepo->create('admin');
        $roleRepo->create('webmaster');
        $roleRepo->create('榮耀會員');
    }
}
