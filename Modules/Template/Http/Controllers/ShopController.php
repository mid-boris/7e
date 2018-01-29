<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Exception\BaseException;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Error\Constants\ErrorCode;
use Modules\Shop\Http\Requests\ImagePreviewUpload;
use Modules\Shop\Http\Requests\ImageTrademarkUpload;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Shop\Service\ShopService;
use Modules\Shop\Tools\GoogleMapInfoProcess;
use Modules\Template\Http\Requests\MapInfo;
use Modules\Template\Http\Requests\ShopCreate;
use Modules\Template\Http\Requests\ShopDelete;
use Modules\Template\Http\Requests\ShopUpdate;

class ShopController extends Controller
{
    /** @var ShopRepository  */
    protected $shopRepo;

    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepo = $shopRepository;
    }

    public function create(ShopCreate $request)
    {
        $startTime = strtotime($request->input('start_time'));
        $endTime = strtotime($request->input('end_time'));
        $busHours = date('H:i:s', $startTime) . " ~ " . date('H:i:s', $endTime);
        $special = $request->input('special') ?? 0;
        $status = $request->input('status') ?? 0;
        $iPass = $request->input('i_pass') ?? 0;
        $closedDay = $request->input('closed_day') ?? [];
        $areaId = $request->input('area_id');
        $mapInfo = GoogleMapInfoProcess::mapInfoProcess($request->input('mapInfo'));
        $this->shopRepo->create(
            $request->input('name'),
            $request->input('telphone'),
            $request->input('phone'),
            $request->input('type'),
            $busHours,
            $request->input('start_time'),
            $request->input('end_time'),
            $special,
            $status,
            $iPass,
            $closedDay,
            $request->input('address'),
            $mapInfo['geometry']['location']['lat'],
            $mapInfo['geometry']['location']['lng'],
            $mapInfo['components'],
            $areaId
        );
        return redirect()->back();
    }

    public function update(ShopUpdate $request)
    {
        $startTime = strtotime($request->input('start_time'));
        $endTime = strtotime($request->input('end_time'));
        $busHours = date('H:i:s', $startTime) . " ~ " . date('H:i:s', $endTime);
        $special = $request->input('special') ?? 0;
        $status = $request->input('status') ?? 0;
        $iPass = $request->input('i_pass') ?? 0;
        $closedDay = $request->input('closed_day') ?? [];
        $areaId = $request->input('area_id');
        $mapInfo = GoogleMapInfoProcess::mapInfoProcess($request->input('mapInfo'));
        $this->shopRepo->update(
            $request->input('id'),
            $request->input('name'),
            $request->input('telphone'),
            $request->input('phone'),
            $request->input('type'),
            $busHours,
            $request->input('start_time'),
            $request->input('end_time'),
            $special,
            $status,
            $iPass,
            $closedDay,
            $request->input('address'),
            $mapInfo['geometry']['location']['lat'],
            $mapInfo['geometry']['location']['lng'],
            $mapInfo['components'],
            $areaId
        );
        return redirect()->back();
    }

    public function delete(ShopDelete $request)
    {
        $this->shopRepo->delete($request->input('id'));
        return redirect()->back();
    }

    public function mapInfo(MapInfo $request)
    {
        $address = $request->input('address');
        /** @var ShopService $shopServ */
        $shopServ = app()->make(ShopService::class);
        $results = $shopServ->getMapInfoByGoogleMap($address);
        return BaseResponse::response(['data' => $results]);
    }

    public function trademarkUpload(ImageTrademarkUpload $request)
    {
        $shopId = $request->input('shop_id');
        $image = $request->file('image');
        $shopServ = app()->make(ShopService::class);
        $hasTrademark = $shopServ->hasTrademark($shopId);
        if ($hasTrademark) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::SHOP_HAS_TRADEMARK_IMAGE),
                ErrorCode::SHOP_HAS_TRADEMARK_IMAGE
            );
        }
        $shopServ->imageUpload($shopId, $image, true);
        return redirect()->back();
    }

    public function previewUpload(ImagePreviewUpload $request)
    {
        $shopId = $request->input('shop_id');
        $image = $request->file('image');
        $shopServ = app()->make(ShopService::class);
        // 最多三筆
        $hasPreview = $shopServ->hasPreview($shopId);
        if ($hasPreview) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::SHOP_PREVIEW_COUNT_INVALID),
                ErrorCode::SHOP_PREVIEW_COUNT_INVALID
            );
        }
        $shopServ->imageUpload($shopId, $image);
        return redirect()->back();
    }
}
