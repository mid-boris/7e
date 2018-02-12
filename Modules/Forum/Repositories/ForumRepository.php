<?php
namespace Modules\Forum\Repositories;

use Modules\Forum\Entities\Forum;

class ForumRepository extends ForumBaseRepository
{
    const VOTE_ID = 2;

    const BOARD_ID = 1;

    public function __construct()
    {
        parent::__construct();
    }

    public function getPaginationWithIdOrNull($id = null)
    {
        /** @var \Eloquent $forum */
        $forum = new Forum;
        return $forum->where('parent_id', $id)->orderBy('sort', 'DESC')->paginate(35);
    }

    public function getVoteId()
    {
        return self::VOTE_ID;
    }

    public function getBoardId()
    {
        return self::BOARD_ID;
    }

    /**
     * 前台用
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVoteForum()
    {
        return $this->getPaginationForumById(self::VOTE_ID);
    }

    /**
     * 前台用
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBoardForum()
    {
        return $this->getPaginationForumById(self::BOARD_ID);
    }

    public function getPaginationForumById(int $forumId)
    {
        /** @var \Eloquent $forum */
        $forum = new Forum;
        return $forum->where('parent_id', $forumId)->where('status', 1)->orderByDesc('sort')->paginate(35);
    }

    public function getForum(int $forumId)
    {
        /** @var \Eloquent $forum */
        $forum = new Forum;
        return $forum->where('id', $forumId)->first();
    }

    public function create(string $name, $parentId = null, int $audit = 0, $status = 1, $sort = 0)
    {
        $data = [
            'name' => $name,
            'parent_id' => $parentId,
            'audit' => $audit,
            'status' => $status,
            'sort' => $sort,
        ];
        /** @var \Eloquent $forum */
        $forum = new Forum;
        return $forum->fill($data)->save();
    }

    public function update(int $id, string $name, int $audit = 0, $status = 1, $sort = 0)
    {
        $data = [
            'name' => $name,
            'audit' => $audit,
            'status' => $status,
            'sort' => $sort,
        ];
        /** @var \Eloquent $forum */
        $forum = new Forum;
        return $forum->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $forum */
        $forum = new Forum;
        return $forum->where('id', $id)->delete();
    }
}
