<?php
namespace Modules\Forum\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\Forum\Entities\Article;

class ArticleRepository extends ForumBaseRepository
{
    /** @var string 加在回覆文章標題前面的字串 */
    protected $reportPrefixStr = 'RE: ';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAuditCount()
    {
        /** @var \Eloquent $article */
        $article = new Article;
        return $article->where('audit', 1)->count();
    }

    public function getPaginationWithIdOrNull($id = null)
    {
        /** @var \Eloquent $article */
        $article = new Article;
        return $article->where('parent_id', $id)->where('audit', 1)->orderBy('id', 'DESC')->paginate(35);
    }

    public function getPaginationByAudit()
    {
        /** @var \Eloquent $article */
        $article = new Article;
        return $article->where('audit', 1)->orWhereNotNull('audit_user_id')->orderBy('id', 'DESC')->paginate(35);
    }

    public function getArticleByParentId(int $parentId)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $article */
        $article = new Article;
        $articles = $article->where('id', $parentId)->where('audit', 0)->first();
        return $articles;
    }

    public function getReportByParentId(int $parentId)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $article */
        $article = new Article;
        $reports = $article->where(function ($query) use ($parentId) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->where('parent_id', $parentId)->where('audit', 0);
        })->orWhere(function ($query) use ($parentId) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->where('parent_id', $parentId)->where('user_id', SessionManager::getUserId());
        })->orderBy('id', 'ASC')->paginate(35);
        return $reports;
    }

    public function create(string $title, string $text, int $forumId, $audit = 0, int $parentId = null)
    {
        $data = [
            'title' => $title,
            'context' => $text,
            'forum_id' => $forumId,
            'parent_id' => $parentId,
            'audit' => $audit,

            'user_id' => SessionManager::getUser()['id'],
            'user_account' => SessionManager::getUser()['account'],
            'user_nick_name' => SessionManager::getUser()['nick_name'],
        ];
        /** @var \Illuminate\Database\Eloquent\Builder $article */
        $article = new Article;
        $article->fill($data)->save();
        return $article;
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $article */
        $article = new Article;
        return $article->where('id', $id)->delete();
    }

    public function auditPass(int $id)
    {
        /** @var \Eloquent $article */
        $article = new Article;
        return $article->where('id', $id)->update([
            'audit' => 0,

            'audit_user_id' => SessionManager::getUser()['id'],
            'audit_user_account' => SessionManager::getUser()['account'],
            'audit_user_nick_name' => SessionManager::getUser()['nick_name'],
        ]);
    }
}
