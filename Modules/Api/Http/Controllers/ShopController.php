<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\ShopAddFavorite;
use Modules\Api\Http\Requests\ShopDecFavorite;
use Modules\Api\Http\Requests\ShopShow;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Shop\Repositories\ShopRepository;
use Modules\User\Services\UserService;

class ShopController extends Controller
{
    protected $type = [
        'food' => 1,
        'clothing' => 2,
        'housing' => 3,
        'transportation' => 4,
        'education' => 5,
        'entertainment' => 6,
    ];

    public function show(ShopShow $request)
    {
        $shopId = $request->input('id');
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getShop($shopId);
        return BaseResponse::response(['data' => $shop]);
    }

    public function index()
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationWithImages();
        return BaseResponse::response(['data' => $shop]);
    }

    public function favorite()
    {
        /** @var UserService $userServ */
        $userServ = app()->make(UserService::class);
        $user = $userServ->getFavoriteShop(SessionManager::getUserId());
        return BaseResponse::response(['data' => $user]);
    }

    public function addFavorite(ShopAddFavorite $request)
    {
        $shopId = $request->input('shop_id');
        /** @var UserService $userServ */
        $userServ = app()->make(UserService::class);
        $userServ->addShopToUser(SessionManager::getUserId(), [$shopId]);
        return BaseResponse::response(['data' => true]);
    }

    public function decFavorite(ShopDecFavorite $request)
    {
        $shopId = $request->input('shop_id');
        /** @var UserService $userServ */
        $userServ = app()->make(UserService::class);
        $userServ->decShopFromUser(SessionManager::getUserId(), [$shopId]);
        return BaseResponse::response(['data' => true]);
    }

    public function food()
    {
        return $this->shopFilter(\Request::route()->getActionMethod());
    }

    public function clothing()
    {
        return $this->shopFilter(\Request::route()->getActionMethod());
    }

    public function housing()
    {
        return $this->shopFilter(\Request::route()->getActionMethod());
    }

    public function transportation()
    {
        return $this->shopFilter(\Request::route()->getActionMethod());
    }

    public function education()
    {
        return $this->shopFilter(\Request::route()->getActionMethod());
    }

    public function entertainment()
    {
        return $this->shopFilter(\Request::route()->getActionMethod());
    }

    protected function shopFilter(string $typeName)
    {
        $type = $this->type[$typeName];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }
}
