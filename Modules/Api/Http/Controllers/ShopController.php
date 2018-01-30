<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Shop\Repositories\ShopRepository;

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

    public function index()
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationWithImages();
        return BaseResponse::response(['data' => $shop]);
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
