<?php

namespace Modules\Entrust\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Entrust\Repositories\NodeRepository;

class NodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /** @var NodeRepository $nodeRepo */
        $nodeRepo = \App::make(NodeRepository::class);

        $nodeRepo->create('系統設置', 'fa-dashboard');
        $nodeRepo->create('權限管理', 'fa-circle-o', '/permission', '系統設置');
        $nodeRepo->create('帳號管理', 'fa-circle-o', '/account', '系統設置');
        $nodeRepo->create('角色管理', 'fa-circle-o', '/role', '系統設置');

        $nodeRepo->create('資料設置', 'fa-files-o');
        $nodeRepo->create('地區管理', 'fa-circle-o', '/area', '資料設置');
        $nodeRepo->create('商家管理', 'fa-circle-o', '/shop', '資料設置');
        $nodeRepo->create('公告管理', 'fa-circle-o', '/announcement', '資料設置');
        $nodeRepo->create('討論版管理', 'fa-circle-o', '/forum', '資料設置');
        $nodeRepo->create('文章審核', 'fa-circle-o', '/article_audit', '資料設置');
        $nodeRepo->create('驚喜管理', 'fa-circle-o', '/surpriseBox', '資料設置');

        $nodeRepo->create('客源分析', 'fa-area-chart');
        $nodeRepo->create('討論板相關', 'fa-circle-o', '/board_analysis', '客源分析');

        $nodeRepo->create('客服專區', 'fa-desktop');
        $nodeRepo->create('客服信件', 'fa-circle-o', '/message', '客服專區');

        $nodeRepo->create('資料呈現', 'fa-desktop');
        $nodeRepo->create('投票專區', 'fa-circle-o', '/vote', '資料呈現');
        $nodeRepo->create('項目討論', 'fa-circle-o', '/board', '資料呈現');

        $nodeRepo->create('會員app', 'fa-circle-o', null, null, 0);
    }
}
