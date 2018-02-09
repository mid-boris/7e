<?php
namespace Modules\Popularity\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\Popularity\Entities\ForumPopularity;
use Modules\Popularity\Entities\ForumPopularitySingle;

class ForumPopularityRepository
{
    /**
     * @param int $forumId
     */
    public function addPopularity(int $forumId)
    {
        $day = $this->todayTime();
        $rows = ForumPopularity::where('forum_id', $forumId)
            ->where('day', $day)
            ->increment('accumulation_popularity');
        if (!$rows) {
            ForumPopularity::create([
                'forum_id' => $forumId,
                'day' => $day,
                'accumulation_popularity' => 1,
            ]);
        }

        // 加入不重複的表單內
        ForumPopularitySingle::firstOrCreate([
            'forum_id' => $forumId,
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
