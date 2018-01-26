<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Shop\Repositories\ShopRepository;

class ShopController extends Controller
{
    public function index()
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPaginationWithImages();
        return BaseResponse::response(['data' => $shop]);
    }
}
