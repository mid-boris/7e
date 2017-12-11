<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Forum\Repositories\ForumRepository;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $forumRepo = app()->make(ForumRepository::class);
        $forumRepo->create('項目討論', null, 0);
        $forumRepo->create('投票專區', null, 0);
    }
}
