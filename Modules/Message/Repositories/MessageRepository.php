<?php
namespace Modules\Message\Repository;

use Modules\Base\Contract\Repository\BaseRepository;
use Modules\Base\Exception\BaseException;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Error\Constants\ErrorCode;
use Modules\Message\Entities\Message;
use Modules\User\Repositories\UserRepository;

class MessageRepository extends BaseRepository
{
    /**
     * 客服查詢用
     * @param null $account
     * @param string $column
     * @return mixed
     */
    public function getByFuzzy($account = null, $column = 'target_account')
    {
        /** @var Message $msg */
        $msg = new Message;
        if (!is_null($account)) {
            $msg = $msg->like($column, $account);
        }
        return $results = $msg->orderByDesc('updated_at')->paginate(35);
    }

    /**
     * 會員(登入者)用
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLoginUserMessages()
    {
        /** @var Message $msg */
        $msg = new Message;
        return $results = $msg->orderNew()->where('target_id', SessionManager::getUserId())->paginate(35);
    }

    public function createContent(string $content, $target = null)
    {
        $data = [
            'content' => $content,
            'user_id' => SessionManager::getUserId(),
            'user_account' => SessionManager::getUserAccount(),
            'user_nick_name' => SessionManager::getUserNickName(),
        ];
        if (is_null($target)) {
            $data = array_merge($data, [
                'target_id' => SessionManager::getUserId(),
                'target_account' => SessionManager::getUserAccount(),
                'target_nick_name' => SessionManager::getUserNickName(),
            ]);
        } else {
            // 查出目標user資料
            /** @var UserRepository $userRepo */
            $userRepo = app()->make(UserRepository::class);
            $user = $userRepo->getByAccount($target);
            if (!$user) {
                throw new BaseException(
                    'user not found.',
                    ErrorCode::ENTRUST_USER_NOT_FOUND
                );
            }
            $data = array_merge($data, [
                'target_id' => $user->id,
                'target_account' => $user->account,
                'target_nick_name' => $user->nick_name,
            ]);
        }
        /** @var Message $msg */
        $msg = new Message;
        $msg->fill($data)->save();
        return $msg;
    }
}
