<?php

namespace Modules\Entrust\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Entrust\Services\RoleNodeService;

class RoleNodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /** @var RoleNodeService $roleNodeServ */
        $roleNodeServ = app()->make(RoleNodeService::class);
        $roleNodeServ->addAllNodeToRole('admin');
    }
}
