<?php

namespace Modules\Shop\Repositories;

use Modules\Shop\Entities\Shop;

class ShopRepository extends ShopBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 會員端用
     * @param int $perpage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginationWithImages(int $perpage = 35)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->with(['trademark', 'preview', 'menu'])
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate($perpage);
    }

    /**
     * 會員端用
     * @param int $type
     * @param int $perpage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginationByTypeWithRelate(int $type, int $perpage = 35)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->with(['trademark', 'preview', 'menu'])
            ->where('shop_type', $type)
            ->where('status', 1)
            ->orderByDesc('id')
            ->paginate($perpage);
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
        return $shop->with(['trademark', 'preview'])->where('id', $id)->first();
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
