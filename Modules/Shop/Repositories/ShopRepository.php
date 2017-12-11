<?php

namespace Modules\Shop\Repositories;

use Modules\Shop\Entities\Shop;

class ShopRepository extends ShopBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPagination(int $perpage = 35)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->with(['area'])->orderBy('id', 'DESC')->paginate($perpage);
    }

    public function create(
        string $name,
        $tel,
        $phone,
        $busHours,
        $startTime,
        $endTime,
        $special,
        $status,
        array $closedDay,
        $address,
        $x,
        $y,
        $areaId = null
    ) {
        $data = [
            'name' => $name,
            'x' => $x,
            'y' => $y,
            'telphone' => $tel,
            'phone' => $phone,
            'address' => $address,
            'business_hours' => $busHours,
            'business_hours_start_time' => $startTime,
            'business_hours_end_time' => $endTime,
            'special' => $special,
            'status' => $status,
            'area_id' => $areaId,
            'closed_day' => json_encode($closedDay),
        ];
        /** @var \Eloquent $shop */
        $shop = new Shop;
        $shop->fill($data)->save();
        return $shop;
    }

    public function update(
        int $id,
        string $name,
        $tel,
        $phone,
        $busHours,
        $startTime,
        $endTime,
        $special,
        $status,
        array $closedDay,
        $address,
        $x,
        $y,
        $areaId = null
    ) {
        $data = [
            'name' => $name,
            'x' => $x,
            'y' => $y,
            'telphone' => $tel,
            'phone' => $phone,
            'address' => $address,
            'business_hours' => $busHours,
            'business_hours_start_time' => $startTime,
            'business_hours_end_time' => $endTime,
            'special' => $special,
            'status' => $status,
            'area_id' => $areaId,
            'closed_day' => json_encode($closedDay),
        ];
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $shop */
        $shop = new Shop;
        return $shop->where('id', $id)->delete();
    }
}
