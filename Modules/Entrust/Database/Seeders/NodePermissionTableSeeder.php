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
        $nodePmServ->addUriPermissionToNode('/shopImages', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/tradeMark/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/preview/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/qrcode/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/update', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/shop/delete', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/api/area/search/fuzzy', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/api/shop/map', '資料設置.商家管理');

        $nodePmServ->addUriPermissionToNode('/image/destroy', '資料設置.商家管理');

        $nodePmServ->addUriPermissionToNode('/menu', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/menu/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/menu/update', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/menu/delete', '資料設置.商家管理');

        $nodePmServ->addUriPermissionToNode('/discount', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/discount/create', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/discount/update', '資料設置.商家管理');
        $nodePmServ->addUriPermissionToNode('/discount/delete', '資料設置.商家管理');

        $nodePmServ->addUriPermissionToNode('/announcement', '資料設置.公告管理');
        $nodePmServ->addUriPermissionToNode('/announcement/create', '資料設置.公告管理');
        $nodePmServ->addUriPermissionToNode('/announcement/update', '資料設置.公告管理');
        $nodePmServ->addUriPermissionToNode('/announcement/delete', '資料設置.公告管理');
        $nodePmServ->addUriPermissionToNode('/api/announcement/shop/fuzzy', '資料設置.公告管理');

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

        $nodePmServ->addUriPermissionToNode('/surpriseBox', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseBox/create', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseBox/update', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseBox/delete', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseItem', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseItem/create', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseItem/update', '資料設置.驚喜管理');
        $nodePmServ->addUriPermissionToNode('/surpriseItem/delete', '資料設置.驚喜管理');

        $nodePmServ->addUriPermissionToNode('/reservation', '資料設置.線上預訂');
        $nodePmServ->addUriPermissionToNode('/reservation/applied', '資料設置.線上預訂');
        $nodePmServ->addUriPermissionToNode('/reservation/delete', '資料設置.線上預訂');

        $nodePmServ->addUriPermissionToNode('/board_analysis', '客源分析.討論板相關');
        $nodePmServ->addUriPermissionToNode('/board_analysis_month', '客源分析.討論板相關');
        $nodePmServ->addUriPermissionToNode('/board_analysis_three_month', '客源分析.討論板相關');
        $nodePmServ->addUriPermissionToNode('/shop_analysis', '客源分析.商家相關');
        $nodePmServ->addUriPermissionToNode('/shop_analysis_month', '客源分析.商家相關');
        $nodePmServ->addUriPermissionToNode('/shop_analysis_three_month', '客源分析.商家相關');

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
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/show', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/food', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/clothing', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/housing', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/transportation', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/education', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/entertainment', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/food', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/clothing', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/housing', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/transportation', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/education', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/nearbyShop/entertainment', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/announcement/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/favorite', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/addFavorite', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/decFavorite', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/surprise/lucky', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/surprise/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/surprise/used', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/reservation/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/reservation/send', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/measurement', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/index', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/food', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/clothing', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/housing', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/transportation', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/education', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/specialShop/entertainment', $memberPermissionName);
        $nodePmServ->addUriPermissionToNode('/api/1.0/shop/top', $memberPermissionName);
    }
}
