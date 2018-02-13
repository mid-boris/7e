<?php
namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\SpecialShopIndex;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Shop\Repositories\ShopRepository;

class SpecialShopController extends Controller
{
    protected $type = [
        'food' => 1,
        'clothing' => 2,
        'housing' => 3,
        'transportation' => 4,
        'education' => 5,
        'entertainment' => 6,
    ];

    public function index(SpecialShopIndex $request)
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeAndSpecialWithRelate(null, $request->input('area_id'));
        return BaseResponse::response(['data' => $shop]);
    }

    public function food(SpecialShopIndex $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function clothing(SpecialShopIndex $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function housing(SpecialShopIndex $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function transportation(SpecialShopIndex $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function education(SpecialShopIndex $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    public function entertainment(SpecialShopIndex $request)
    {
        return $this->shopFilter($request, \Request::route()->getActionMethod());
    }

    protected function shopFilter(SpecialShopIndex $request, string $typeName)
    {
        $areaId = $request->input('area_id');

        $type = $this->type[$typeName];
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationByTypeAndSpecialWithRelate($type, $areaId);
        return BaseResponse::response(['data' => $shop]);
    }
}
