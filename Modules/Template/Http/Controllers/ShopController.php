<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Base\Exception\BaseException;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Error\Constants\ErrorCode;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Shop\Service\ShopService;
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
        $mapInfo = $this->mapInfoProcess($request->input('mapInfo'));
        $this->shopRepo->create(
            $request->input('name'),
            $request->input('telphone'),
            $request->input('phone'),
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
        $mapInfo = $this->mapInfoProcess($request->input('mapInfo'));
        $this->shopRepo->update(
            $request->input('id'),
            $request->input('name'),
            $request->input('telphone'),
            $request->input('phone'),
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

    private function mapInfoProcess(string $mapInfo)
    {
        $json = json_decode($mapInfo, true);
        if (count($json) < 1 ||
            !array_key_exists('geometry', $json) ||
            !array_key_exists('address_components', $json)
        ) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::SHOP_DATA_MAP_INFO_INVALID),
                ErrorCode::SHOP_DATA_MAP_INFO_INVALID
            );
        }
        if (!array_key_exists('location', $json['geometry'])) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::SHOP_DATA_MAP_INFO_INVALID),
                ErrorCode::SHOP_DATA_MAP_INFO_INVALID
            );
        }
        if (!array_key_exists('lat', $json['geometry']['location']) ||
            !array_key_exists('lng', $json['geometry']['location'])
        ) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::SHOP_DATA_MAP_INFO_INVALID),
                ErrorCode::SHOP_DATA_MAP_INFO_INVALID
            );
        }
        // 處理components
        $components = [];
        foreach ($json['address_components'] as $component) {
            if (in_array('route', $component['types']) || in_array('political', $component['types'])) {
                $components[$component['long_name']] = 1;
                $components[$component['short_name']] = 1;
            }
        }
        $components = array_keys($components);
        $json['components'] = [];
        foreach ($components as $component) {
            $json['components'][] = [
                'name' => $component,
            ];
        }
        return $json;
    }
}
