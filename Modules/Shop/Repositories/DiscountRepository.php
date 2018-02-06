<?php
namespace Modules\Shop\Repositories;

use Modules\Shop\Entities\Discount;

class DiscountRepository extends ShopBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPaginationWithIdOrNull($shopId = null)
    {
        /** @var \Eloquent $discount */
        $discount = new Discount;
        return $discount->where('shop_id', $shopId)->orderBy('id', 'DESC')->paginate(35);
    }

    public function create(array $data)
    {
        /** @var \Eloquent $discount */
        $discount = new Discount;
        $this->dataParameter($data);
        return $discount->fill($data)->save();
    }

    public function update(array $data, int $discountId)
    {
        /** @var \Eloquent $discount */
        $discount = new Discount;
        $this->dataParameter($data);
        return $discount->where('id', $discountId)->update($data);
    }

    public function delete(int $discountId)
    {
        /** @var \Eloquent $discount */
        $discount = new Discount;
        return $discount->where('id', $discountId)->delete();
    }

    private function dataParameter(&$data)
    {
        if (array_key_exists('start_time', $data)) {
            $this->timeProcess($data['start_time']);
        }
        if (array_key_exists('end_time', $data)) {
            $this->timeProcess($data['end_time'], 1);
        }
    }

    private function timeProcess(&$time, $plusDay = 0)
    {
        if (!is_null($time)) {
            $time = strtotime($time . "+{$plusDay} days");
        }
    }
}
