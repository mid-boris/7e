<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Area\Repositories\AreaRepository;
use Modules\Entrust\Repositories\RoleRepository;
use Modules\Entrust\Services\RoleNodeService;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Forum\Http\Requests\Board;
use Modules\Forum\Repositories\ArticleRepository;
use Modules\Forum\Repositories\ForumRepository;
use Modules\Forum\Services\ForumService;
use Modules\Menu\Repositories\MenuRepository;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Template\Http\Requests\Area;
use Modules\Template\Http\Requests\Article;
use Modules\Template\Http\Requests\ArticleAudit;
use Modules\Template\Http\Requests\Forum;
use Modules\Template\Http\Requests\Menu;
use Modules\Template\Http\Requests\Vote;
use Modules\User\Repositories\UserRepository;

class TemplateController extends Controller
{
    /** @var RoleNodeService  */
    protected $roleNodeServ;

    public function __construct(RoleNodeService $roleNodeService)
    {
        $this->roleNodeServ = $roleNodeService;
    }

    public function index()
    {
        if (SessionManager::isLogin()) {
            return $this->home();
        }
        return $this->login();
    }

    public function login()
    {
        return view('template::login');
    }

    public function home()
    {
        return $this->render('index');
    }

    public function permission()
    {
        $roleNode = $this->roleNodeServ->getAllRoleAndNode();
        return $this->render('permission', $roleNode);
    }

    public function account()
    {
        $userRepo = app()->make(UserRepository::class);
        $user = $userRepo->getPaginationWithRole();
        $roleRepo = app()->make(RoleRepository::class);
        $role = $roleRepo->getAllExceptAdmin();
        return $this->render('account', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function role()
    {
        $roleRepo = app()->make(RoleRepository::class);
        $role = $roleRepo->getPagination();
        return $this->render('role', [
            'role' => $role,
        ]);
    }

    public function area(Area $request)
    {
        $areaRepo = app()->make(AreaRepository::class);
        $area = $areaRepo->getPaginationWithIdOrNull($request->input('id'));
        return $this->render('area', [
            'area' => $area,
            'parameter' => $request->except('page'),
            'id' => $request->input('id'),
            'name' => $request->input('name'),
        ]);
    }

    public function shop()
    {
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPagination();
        return $this->render('shop', [
            'shop' => $shop,
        ]);
    }

    public function menu(Menu $request)
    {
        $menuRepo = app()->make(MenuRepository::class);
        $menu = $menuRepo->getPaginationWithIdOrNull($request->input('id'));
        return $this->render('menu', [
            'menu' => $menu,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'id' => $request->input('id'),
        ]);
    }

    public function forum(Forum $request)
    {
        $forumRepo = app()->make(ForumRepository::class);
        $forum = $forumRepo->getPaginationWithIdOrNull($request->input('parent_id'));
        return $this->render('forum', [
            'forum' => $forum,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'parentId' => $request->input('parent_id'),
        ]);
    }

    public function articleAudit(ArticleAudit $request)
    {
        $articleRepo = app()->make(ArticleRepository::class);
        $articles = $articleRepo->getPaginationByAudit();
        return $this->render('article_audit', [
            'article' => $articles,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'parentId' => $request->input('parent_id'),
        ]);
    }

    public function vote(Vote $request)
    {
        if (is_null($request->input('parent_id'))) {
            // 沒上層ID時則拿留言板
            $forumRepo = app()->make(ForumRepository::class);
            $data = $forumRepo->getVoteForum();
        } else {
            // 有上層ID時拿取內文訊息
            $forumServ = app()->make(ForumService::class);
            $data = $forumServ->getArticle($request->input('parent_id'));
        }
        return $this->render('vote', [
            'data' => $data,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'parentId' => $request->input('parent_id'),
        ]);
    }

    public function board(Board $request)
    {
        if (is_null($request->input('parent_id'))) {
            // 沒上層ID時則拿留言板
            $forumRepo = app()->make(ForumRepository::class);
            $data = $forumRepo->getBoardForum();
        } else {
            // 有上層ID時拿取內文訊息
            $forumServ = app()->make(ForumService::class);
            $data = $forumServ->getArticle($request->input('parent_id'));
        }
        return $this->render('board', [
            'data' => $data,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'parentId' => $request->input('parent_id'),
        ]);
    }

    public function article(Article $request)
    {
        $parentId = $request->input('parent_id');
        $articleRepo = app()->make(ArticleRepository::class);
        $article = $articleRepo->getArticleByParentId($parentId);
        $reports = $articleRepo->getReportByParentId($parentId);
        return $this->render('article', [
            'article' => $article,
            'reports' => $reports,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'parentId' => $request->input('parent_id'),
            'forumId' => $request->input('forum_id'),
        ]);
    }

    private function render(string $tag, array $exData = [])
    {
        $menu = $this->getMenu();
        $data = [
            'nav' => $menu,
        ];
        if (count($exData) > 0) {
            $data = array_merge($exData, $data);
        }
        return view('template::' . $tag, $data);
    }

    private function getMenu()
    {
        $data = $this->roleNodeServ->getNodesByRole();
        $menu = [];
        foreach ($data as $datum) {
            if (is_null($datum->parent_id)) {
                $menu[$datum->id] = $datum;
            } else {
                if (!array_key_exists($datum->parent_id, $menu)) {
                    continue;
                }
                if (is_null($menu[$datum->parent_id]->children)) {
                    $menu[$datum->parent_id]->children = [];
                }
                $menu[$datum->parent_id]->children =
                    array_merge($menu[$datum->parent_id]->children, [$datum->id => $datum]);
            }
        }
        return $menu;
    }
}
