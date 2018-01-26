<?php
namespace Modules\Shop\Tools;

use Modules\Base\Exception\BaseException;
use Modules\Error\Constants\ErrorCode;

class GoogleMapInfoProcess
{
    /**
     * 處理成自己後續想使用的資料格式
     * @param string $mapInfo
     * @return mixed
     * @throws BaseException
     */
    public static function mapInfoProcess(string $mapInfo)
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
