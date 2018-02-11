<?php
namespace Modules\Surprise\Services;

use Modules\Base\Exception\BaseException;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Error\Constants\ErrorCode;
use Modules\Surprise\Entities\SurpriseBox;
use Modules\Surprise\Entities\SurpriseItem;
use Modules\User\Entities\User;

class SurpriseService
{
    public function list()
    {
        $userId = SessionManager::getUserId();
        return User::find($userId)->surprise()->orderByDesc('id')->paginate(10);
    }
    
    public function lucky()
    {
        $user = $this->qualification();
        if ($user) {
            $lottery = $this->lottery();
            if ($lottery) {
                $this->save($user, $lottery);
                return $lottery;
            }
        }
        throw new BaseException(
            'can not use more.',
            ErrorCode::SURPRISE_USED_LUCKY
        );
    }

    public function used(int $surpriseItemId)
    {
        $userId = SessionManager::getUserId();
        $userModel = new User;
        $user = $userModel->with(['surprise' => function ($query) use ($surpriseItemId) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->where('user_surprise_item.id', $surpriseItemId);
        }])->find($userId);
        $now = time();
        $surprise = $user->surprise->first();
        if ($surprise) {
            if ($now <= $surprise->pivot->expiration_date_time || is_null($surprise->pivot->expiration_date_time)) {
                $surprise->pivot->used = 1;
                $surprise->pivot->save();
            } else {
                throw new BaseException('expired', ErrorCode::SURPRISE_EXPIRED);
            }
        }
    }

    /**
     * 判斷是否有抽選資格
     * @return bool|User
     */
    protected function qualification()
    {
        $userId = SessionManager::getUserId();
        $userModel = new User;
        $user = $userModel->with(['surpriseToday'])->find($userId);
        if ($user->surpriseToday->count() == 0) {
            // 代表今天還沒抽過, 有抽獎資格
            return $user;
        }
        return false;
    }

    /**
     * 抽驚喜item
     * @return \Illuminate\Database\Eloquent\Model|null|SurpriseItem
     */
    protected function lottery()
    {
        /** @var \Eloquent $surpriseBoxModel */
        $surpriseBoxModel = new SurpriseBox;
        $box = $surpriseBoxModel->where(function ($sub) {
            /** @var \Illuminate\Database\Eloquent\Builder $sub */
            $sub->where(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereNull('start_time')->whereNull('end_time');
            })->orWhere(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('start_time', '<=', time())->whereNull('end_time');
            })->orWhere(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereNull('start_time')->where('end_time', '>=', time());
            })->orWhere(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('start_time', '<=', time())->where('end_time', '>=', time());
            });
        })->where('status', 1)->orderBy(\DB::raw('RAND()'))->first();
        if ($box) {
            /** @var \Eloquent $surpriseItemModel */
            $surpriseItemModel = new SurpriseItem;
            return $surpriseItemModel
                ->where('surprise_box_id', $box->getKey())
                ->orderBy(\DB::raw('RAND()'))
                ->first();
        }
        return null;
    }

    protected function save(User $user, SurpriseItem $surpriseItem)
    {
        if ($surpriseItem->expiration) {
            $expireDateTime = time() + (24 * 60 * 60) * $surpriseItem->expiration;
        } else {
            $expireDateTime = $surpriseItem->expiration;
        }
        $user->surprise()->attach($surpriseItem->getKey(), [
            'manufacture' => strtotime(date('Y-m-d')),
            'expiration_date_time' => $expireDateTime,
        ]);
    }
}
