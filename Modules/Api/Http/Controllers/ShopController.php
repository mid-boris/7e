<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Shop\Repositories\ShopRepository;

class ShopController extends Controller
{
    private $type = [
        'food' => 1,
        'clothing' => 2,
        'housing' => 3,
        'transportation' => 4,
        'education' => 5,
        'entertainment' => 6,
    ];

    public function index()
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationWithImages();
        return BaseResponse::response(['data' => $shop]);
    }

    public function food()
    {
        $type = $this->type[\Request::route()->getActionMethod()];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }

    public function clothing()
    {
        $type = $this->type[\Request::route()->getActionMethod()];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }

    public function housing()
    {
        $type = $this->type[\Request::route()->getActionMethod()];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }

    public function transportation()
    {
        $type = $this->type[\Request::route()->getActionMethod()];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }

    public function education()
    {
        $type = $this->type[\Request::route()->getActionMethod()];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }

    public function entertainment()
    {
        $type = $this->type[\Request::route()->getActionMethod()];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeWithRelate($type);
        return BaseResponse::response(['data' => $shop]);
    }
}
