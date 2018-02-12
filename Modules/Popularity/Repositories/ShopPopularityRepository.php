<?php
namespace Modules\Popularity\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\Popularity\Entities\ShopPopularity;
use Modules\Popularity\Entities\ShopPopularitySingle;

class ShopPopularityRepository
{
    /**
     * @param int $shopId
     */
    public function addPopularity(int $shopId)
    {
        $day = $this->todayTime();
        $rows = ShopPopularity::where('shop_id', $shopId)
            ->where('day', $day)
            ->increment('accumulation_popularity');
        if (!$rows) {
            ShopPopularity::create([
                'shop_id' => $shopId,
                'day' => $day,
                'accumulation_popularity' => 1,
            ]);
        }

        // 加入不重複的表單內
        ShopPopularitySingle::firstOrCreate([
            'shop_id' => $shopId,
            'day' => $day,
            'user_id' => SessionManager::getUserId(),
        ], [
            'area_id' => SessionManager::getUserAreaId(),
            'gender' => SessionManager::getUserGender(),
        ]);
    }

    private function todayTime()
    {
        return strtotime(date('Y-m-d'));
    }
}
