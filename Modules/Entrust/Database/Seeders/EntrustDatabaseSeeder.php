<?php

namespace Modules\Entrust\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EntrustDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(NodeTableSeeder::class);
        $this->call(RoleNodeTableSeeder::class);
        $this->call(NodePermissionTableSeeder::class);
    }
}
