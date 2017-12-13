<?php
namespace Modules\Forum\Services;

use Modules\Base\Exception\BaseException;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Error\Constants\ErrorCode;
use Modules\Forum\Entities\Article;

class VoteService
{
    public function voteIncrement(array $voteIds, int $articleId)
    {
        // 先算複選最多幾票
        /** @var \Eloquent $articleMd */
        $articleMd = new Article;
        /** @var Article $article */
        $article = $articleMd->where('id', $articleId)->first();
        $maxCount = $article->vote_max_count;

        if (count($voteIds) > $maxCount) {
            throw new BaseException(
                'invalid vote count',
                ErrorCode::FORUM_VOTE_INVALID_COUNT
            );
        }

        // 那些Ids是否存在
        $voteOptions = $article->voteOption()->whereIn('id', $voteIds)->get();
        if ($voteOptions->count() != count($voteIds)) {
            throw new BaseException(
                'invalid vote ids',
                ErrorCode::FORUM_VOTE_INVALID_OPTION_ID
            );
        }

        // 如果已投過票
        /** @var \Illuminate\Database\Eloquent\Collection $votes */
        $votes = $article->voteItem()
            ->whereIn('id', $voteIds)
            ->where('user_id', SessionManager::getUserId())
            ->get();
        if ($votes->count() > 0) {
            throw new BaseException(
                'voted',
                ErrorCode::FORUM_VOTE_VOTED
            );
        }

        $insertData = [];
        foreach ($voteIds as $key => $val) {
            $insertData[] = [
                'vote_id' => $val,
                'user_id' => SessionManager::getUserId(),
            ];
        }
        $article->voteItem()->createMany($insertData);
        $article->voteOption()->whereIn('id', $voteIds)->increment('vote_count');
    }
}
