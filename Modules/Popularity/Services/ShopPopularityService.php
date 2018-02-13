<?php
namespace Modules\Popularity\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Popularity\Entities\Shop;

class ShopPopularityService
{
    public function getPopularityToday()
    {
        /** @var \Eloquent|Shop $model */
        $model = new Shop;
        $results = $model->with(['popularity' => function ($query) {
            $now = $this->todayTime();
            /** @var \Eloquent  $query */
            $query->where('day', $now);
        }])->withCount(['favorite'])->orderBy('id')->paginate(35);
        $this->dataMapping($results);
        return $results;
    }

    public function getPopularityOneMonth(int $forumId)
    {
        \DB::connection(ConnectionConfigConstants::MAIN_CONNECTION_NAME)->enableQueryLog();
        /** @var \Eloquent|Shop $model */
        $model = new Shop;
        $results = $model->with(['popularity' => function ($query) {
            $now = $this->todayTime();
            $before30DaysAge = $this->beforeDaysAgoTime(30);
            /** @var \Eloquent  $query */
            $query->where('day', '<=', $now)->where('day', '>=', $before30DaysAge)->orderBy('day');
        }, 'popularitySingleMale' => function ($query) {
            $now = $this->todayTime();
            $before30DaysAge = $this->beforeDaysAgoTime(30);
            /** @var \Eloquent  $query */
            $query->select(
                \DB::raw('count(gender) as count, shop_id, day')
            )->where('day', '<=', $now)->where('day', '>=', $before30DaysAge)->groupBy('day', 'shop_id');
        }, 'popularitySingleFemale' => function ($query) {
            $now = $this->todayTime();
            $before30DaysAge = $this->beforeDaysAgoTime(30);
            /** @var \Eloquent  $query */
            $query->select(
                \DB::raw('count(gender) as count, shop_id, day')
            )->where('day', '<=', $now)->where('day', '>=', $before30DaysAge)->groupBy('day', 'shop_id');
        }])->find($forumId);
        return $results;
    }

    public function getPopularityThreeMonth(int $forumId)
    {
        /** @var \Eloquent|Shop $model */
        $model = new Shop;
        $results = $model->with(['popularity' => function ($query) {
            $now = $this->todayTime();
            $before90DaysAge = $this->beforeDaysAgoTime(90);
            /** @var \Eloquent  $query */
            $query->where('day', '<=', $now)->where('day', '>=', $before90DaysAge)->orderBy('day');
        }, 'popularitySingleMale' => function ($query) {
            $now = $this->todayTime();
            $before30DaysAge = $this->beforeDaysAgoTime(30);
            /** @var \Eloquent  $query */
            $query->select(
                \DB::raw('count(gender) as count, shop_id, day')
            )->where('day', '<=', $now)->where('day', '>=', $before30DaysAge)->groupBy('day', 'shop_id');
        }, 'popularitySingleFemale' => function ($query) {
            $now = $this->todayTime();
            $before30DaysAge = $this->beforeDaysAgoTime(30);
            /** @var \Eloquent  $query */
            $query->select(
                \DB::raw('count(gender) as count, shop_id, day')
            )->where('day', '<=', $now)->where('day', '>=', $before30DaysAge)->groupBy('day', 'shop_id');
        }])->find($forumId);
        return $results;
    }

    private function dataMapping(&$forumPopularity)
    {
        if ($forumPopularity) {
            if ($forumPopularity instanceof Model) {
                $this->setDataPopularity($forumPopularity);
            } else {
                /** @var \Illuminate\Database\Eloquent\Collection $forumPopularity */
                $forumPopularity->map(function ($item) {
                    $this->setDataPopularity($item);
                    return $item;
                });
            }
        }
    }

    private function setDataPopularity(&$data)
    {
        if ($data->popularity->count() > 0) {
            $popularity = $data->popularity->first();
            $data->popularity = $popularity->accumulation_popularity;
        } else {
            $data->popularity = 0;
        }
    }

    private function todayTime()
    {
        return strtotime(date('Y-m-d'));
    }

    private function beforeDaysAgoTime(int $days)
    {
        return strtotime(date('Y-m-d') . " -{$days} days");
    }
}
