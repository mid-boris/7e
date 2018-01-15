<?php

namespace Modules\Entrust\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Entrust\Services\NodePermissionService;

class NodePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // 把路徑賦予給節點, 之後路徑便依賴節點權限控管
        /** @var NodePermissionService $nodePmServ */
        $nodePmServ = app()->make(NodePermissionService::class);
        $nodePmServ->addUriPermissionToNode('/permission', '系統設置.權限管理');
        $nodePmServ->addUriPermissionToNode('/api/system/permission/update', '系統設置.權限管理');
        $nodePmServ->addUriPermissionToNode('/account', '系統設置.帳號管理');
        $nodePmServ->addUriPermissionToNode('/account/create', '系統設置.帳號管理');
        $nodePmServ->addUriPermissionToNode('/account/update', '系統設置.帳號管理');
        $nodePmServ->addUriPermissionToNode('/role', '系統設置.角色管理');
        $nodePmServ->addUriPermissionToNode('/role/create', '系統設置.角色管理');
        $nodePmServ->addUriPermissionToNode('/role/update', '系統設置.角色管理');
        $nodePmServ->addUriPermissionToNode('/role/delete', '系統設置.角色管理');

        $nodePmServ->addUriPermissionToNode('/area', '資料設置.地區管理');
        $nodePmServ->addUriPermissionToNode('/area/create', '資料設置.地區管理');
        $nodePmServ->addUriPermissionToNode('/area/update', '資料設置.地區管理');
        $nodePmServ->addUriPermissionToNode('/area/delete', '資料設置.地區管理');

        $nodePmServ->addUriPermissionToNode('/shop', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/update', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/delete', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/api/area/search/fuzzy', '資料設置.商家管理');

        $nodePmServ->addUriPermissionToNode('/menu', '資料設置.菜單管理');
        $nodePmServ->addUriPermissionToNode('/menu/create', '資料設置.菜單管理');
        $nodePmServ->addUriPermissionToNode('/menu/update', '資料設置.菜單管理');
        $nodePmServ->addUriPermissionToNode('/menu/delete', '資料設置.菜單管理');

        $nodePmServ->addUriPermissionToNode('/article_audit', '資料設置.文章審核');
        $nodePmServ->addUriPermissionToNode('/article_audit/auditPass', '資料設置.文章審核');
        $nodePmServ->addUriPermissionToNode('/article_audit/delete', '資料設置.文章審核');
        $nodePmServ->addUriPermissionToNode('/api/article/audit/count', '資料設置.文章審核');

        $nodePmServ->addUriPermissionToNode('/forum', '資料設置.討論版管理');
        $nodePmServ->addUriPermissionToNode('/forum/create', '資料設置.討論版管理');
        $nodePmServ->addUriPermissionToNode('/forum/update', '資料設置.討論版管理');
        $nodePmServ->addUriPermissionToNode('/forum/delete', '資料設置.討論版管理');

        $nodePmServ->addUriPermissionToNode('/vote', '資料呈現.投票專區');
        $nodePmServ->addUriPermissionToNode('/vote/add', '資料呈現.投票專區');
        $nodePmServ->addUriPermissionToNode('/article', '資料呈現.投票專區');
        $nodePmServ->addUriPermissionToNode('/article/create', '資料呈現.投票專區');
        $nodePmServ->addUriPermissionToNode('/article/update', '資料呈現.投票專區');
        $nodePmServ->addUriPermissionToNode('/article/delete', '資料呈現.投票專區');

        $nodePmServ->addUriPermissionToNode('/board', '資料呈現.項目討論');

        $nodePmServ->addUriPermissionToNode('/message', '客服專區');
        $nodePmServ->addUriPermissionToNode('/message/create', '客服專區.客服信件');

        // 會員app端權限
        $memberPermissionName = '會員app';
        $nodePmServ->addUriPermissionToNode('/api/1.0/user/edit', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/area/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/forum/vote', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/forum/board', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/article/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/article/show', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/article/create', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/vote/add', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/message/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/message/create', $memberPermissionName);
    }
}
