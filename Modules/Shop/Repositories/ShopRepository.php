<?php

namespace Modules\Shop\Repositories;

use Modules\Popularity\Repositories\ShopPopularityRepository;
use Modules\Shop\Entities\Shop;

class ShopRepository extends ShopBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 加入人數統計用的方法
     * 由會員端呼叫
     * @param int $shopId
     */
    public function measurement(int $shopId)
    {
        // 埋入加人氣之方法
        /** @var ShopPopularityRepository $popularityRepo */
        $popularityRepo = app()->make(ShopPopularityRepository::class);
        $popularityRepo->addPopularity($shopId);
    }

    /**
     * 會員端用
     * @param null|int $areaId
     * @param int $perpage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginationWithImages($areaId = null, int $perpage = 35)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        $shop = $shop->with(['trademark', 'preview', 'menu']);
        if (!is_null($areaId)) {
            $shop = $shop->where('area_id', $areaId);
        }
        return $shop
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate($perpage);
    }

    /**
     * 會員端用
     * @param int $type
     * @param null|int $areaId
     * @param int $perpage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginationByTypeWithRelate(int $type, $areaId = null, int $perpage = 35)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        $shop = $shop->with(['trademark', 'preview', 'menu']);
        if (!is_null($areaId)) {
            $shop = $shop->where('area_id', $areaId);
        }
        return $shop
            ->where('shop_type', $type)
            ->where('status', 1)
            ->orderByDesc('id')
            ->paginate($perpage);
    }

    /**
     * 會員端用
     * @param float $lat
     * @param float $lng
     * @param int $radius
     * @param null $type
     * @param int $perpage
     * @return mixed
     */
    public function getPaginationByTypeLatLngWithRelate(
        float $lat,
        float $lng,
        int $radius,
        $type = null,
        $perpage = 35
    ) {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        $connectionName = $shop->getConnectionName();
        $subWhereCondition = " status = 1";
        if ($type) {
            $subWhereCondition .= " AND shop_type = {$type}";
        }

        // 經緯度計算公式
        \DB::connection($connectionName)->statement(
            "SET @orig_latitude = {$lat},@orig_longitude = {$lng},@radius = {$radius};"
        );
        $subQuery = $shop->select(
            '*',
            \DB::raw("
                6371 * ACOS(
                     COS(RADIANS(@orig_latitude)) * COS(RADIANS(`shop_lat`)) * COS(
                         RADIANS(@orig_longitude) - RADIANS(`shop_lng`)
                     ) + SIN(RADIANS(@orig_latitude)) * SIN(RADIANS(`shop_lat`))
                ) AS `distance`
            ")
        )->whereRaw("`shop_lat` BETWEEN @orig_latitude - (@radius / 111)")
            ->whereRaw("@orig_latitude + (@radius / 111)")
            ->whereRaw("
                `shop_lng` BETWEEN @orig_longitude - (
                    @radius / (
                        111 * COS(RADIANS(@orig_latitude))
                    )
                )
            ")
            ->whereRaw("
                @orig_longitude + (
                    @radius / (
                        111 * COS(RADIANS(@orig_latitude))
                    )
                )
            ")
            ->whereRaw("$subWhereCondition");

        /** @var \Eloquent $shop */
        $nearByShop = new Shop;
        $result = $nearByShop
            ->with(['trademark', 'preview', 'menu'])
            ->from(\DB::raw("({$subQuery->toSql()}) as r"))
            ->whereRaw("`distance` < @radius")
            ->orderBy('distance')
            ->paginate($perpage);

        /** 原始公式 */
//        $result = \DB::connection($connectionName)->select("
//            SELECT
//                *
//            FROM
//                (
//                    SELECT
//                        `id`,
//                        `name`,
//                        6371 * ACOS(
//                            COS(RADIANS(@orig_latitude)) * COS(RADIANS(`shop_lat`)) * COS(
//                                RADIANS(@orig_longitude) - RADIANS(`shop_lng`)
//                            ) + SIN(RADIANS(@orig_latitude)) * SIN(RADIANS(`shop_lat`))
//                        ) AS `distance`
//                    FROM
//                        `shop`
//                    WHERE
//                        `shop_lat` BETWEEN @orig_latitude - (@radius / 111)
//                    AND @orig_latitude + (@radius / 111)
//                    AND `shop_lng` BETWEEN @orig_longitude - (
//                        @radius / (
//                            111 * COS(RADIANS(@orig_latitude))
//                        )
//                    )
//                    AND @orig_longitude + (
//                        @radius / (
//                            111 * COS(RADIANS(@orig_latitude))
//                        )
//                    )
//                    {$subWhereCondition}
//                ) r
//            WHERE
//                `distance` < @radius
//            ORDER BY
//                `distance` ASC;
//        ");

        return $result;
    }

    public function getShopByName(string $shopName)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->like('name', $shopName)->where('status', 1)->get();
    }

    /**
     * 後臺呈現用
     * @param int $id
     * @return Shop|\Eloquent
     */
    public function getShop(int $id)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->with(['menu', 'trademark', 'preview', 'discount'])->where('id', $id)->first();
    }

    /**
     * 後臺呈現用
     * @param null $fuzzyName
     * @param int $perpage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPagination($fuzzyName = null, int $perpage = 35)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        if (!is_null($fuzzyName)) {
            $shop = $shop->like('name', $fuzzyName);
        }
        return $shop->with(['area'])->orderBy('id', 'DESC')->paginate($perpage);
    }

    public function create(
        string $name,
        $tel,
        $phone,
        $type,
        $busHours,
        $startTime,
        $endTime,
        $special,
        $status,
        $iPass,
        array $closedDay,
        $address,
        $lat,
        $lng,
        $components,
        $areaId = null
    ) {
        $data = [
            'name' => $name,
            'shop_lat' => $lat,
            'shop_lng' => $lng,
            'telphone' => $tel,
            'phone' => $phone,
            'shop_type' => $type,
            'address' => $address,
            'business_hours' => $busHours,
            'business_hours_start_time' => $startTime,
            'business_hours_end_time' => $endTime,
            'special' => $special,
            'status' => $status,
            'i_pass' => $iPass,
            'area_id' => $areaId,
            'closed_day' => json_encode($closedDay),
        ];
        /** @var \Eloquent $shop */
        $shop = new Shop;
        \DB::connection($shop->getConnectionName())->beginTransaction();
        $shop->fill($data)->save();
        $shop->googleArea()->createMany($components);
        \DB::connection($shop->getConnectionName())->commit();
        return $shop;
    }

    public function update(
        int $id,
        string $name,
        $tel,
        $phone,
        $type,
        $busHours,
        $startTime,
        $endTime,
        $special,
        $status,
        $iPass,
        array $closedDay,
        $address,
        $lat,
        $lng,
        $components,
        $areaId = null
    ) {
        $data = [
            'name' => $name,
            'shop_lat' => $lat,
            'shop_lng' => $lng,
            'telphone' => $tel,
            'phone' => $phone,
            'shop_type' => $type,
            'address' => $address,
            'business_hours' => $busHours,
            'business_hours_start_time' => $startTime,
            'business_hours_end_time' => $endTime,
            'special' => $special,
            'status' => $status,
            'i_pass' => $iPass,
            'area_id' => $areaId,
            'closed_day' => json_encode($closedDay),
        ];
        /** @var \Eloquent $shop */
        $shop = new Shop;
        \DB::connection($shop->getConnectionName())->beginTransaction();
        $shop->where('id', $id)->update($data);

        // relate updated
        /** @var Shop $shop */
        $shop = Shop::where('id', $id)->first();
        $shop->googleArea()->delete();
        $shop->googleArea()->createMany($components);
        \DB::connection($shop->getConnectionName())->commit();
        return $shop->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->where('id', $id)->delete();
    }
}
