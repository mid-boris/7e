<?php
namespace Modules\Shop\Service;

use Modules\RemoteSystem\Src\GoogleMapConnection;

class ShopService
{
    /**
     * 利用地址從google map查詢相關資訊
     * @param string $address
     * @return mixed
     */
    public function getMapInfoByGoogleMap(string $address)
    {
        /** @var GoogleMapConnection $googleMapConnection */
        $googleMapConnection = app()->make(GoogleMapConnection::class);
        $results = $googleMapConnection->getMapInfoFromAddress($address)->getResults();
        if (count($results)) {
            return $results[0];
        }
        return $results;
    }
}
