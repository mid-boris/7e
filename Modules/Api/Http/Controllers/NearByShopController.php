<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\NearByShop;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Shop\Repositories\ShopRepository;

class NearByShopController extends Controller
{
    protected $type = [
        'food' => 1,
        'clothing' => 2,
        'housing' => 3,
        'transportation' => 4,
        'education' => 5,
        'entertainment' => 6,
    ];

    public function index(NearByShop $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $radius = $request->input('radius');

        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeLatLngWithRelate($lat, $lng, $radius);
        return BaseResponse::response(['data' => $shop]);
    }

    public function food(NearByShop $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function clothing(NearByShop $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function housing(NearByShop $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function transportation(NearByShop $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function education(NearByShop $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function entertainment(NearByShop $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    protected function shopFilter(NearByShop $request, string $typeName)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $radius = $request->input('radius');

        $type = $this->type[$typeName];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeLatLngWithRelate($lat, $lng, $radius, $type);
        return BaseResponse::response(['data' => $shop]);
    }
}
