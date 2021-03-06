<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Announcement\Constants\AnnouncementConstants;
use Modules\Announcement\Repositories\AnnouncementRepository;
use Modules\Area\Repositories\AreaRepository;
use Modules\Entrust\Repositories\RoleRepository;
use Modules\Entrust\Services\RoleNodeService;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Forum\Http\Requests\Board;
use Modules\Forum\Repositories\ArticleRepository;
use Modules\Forum\Repositories\ForumRepository;
use Modules\Forum\Services\ForumService;
use Modules\Menu\Repositories\MenuRepository;
use Modules\Message\Repository\MessageRepository;
use Modules\Popularity\Services\ForumPopularityService;
use Modules\Popularity\Services\ShopPopularityService;
use Modules\Push\Services\PushService;
use Modules\Reservation\Repositories\ReservationRepository;
use Modules\Shop\Constants\DiscountTypeConstants;
use Modules\Shop\Repositories\DiscountRepository;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Surprise\Repositories\SurpriseItemRepository;
use Modules\Surprise\Repositories\SurpriseRepository;
use Modules\Template\Http\Requests\Announcement;
use Modules\Template\Http\Requests\Area;
use Modules\Template\Http\Requests\Article;
use Modules\Template\Http\Requests\ArticleAudit;
use Modules\Template\Http\Requests\BoardAnalysisMonth;
use Modules\Template\Http\Requests\Discount;
use Modules\Template\Http\Requests\Forum;
use Modules\Template\Http\Requests\Menu;
use Modules\Template\Http\Requests\Message;
use Modules\Template\Http\Requests\Shop;
use Modules\Template\Http\Requests\ShopAnalysisMonth;
use Modules\Template\Http\Requests\ShopImages;
use Modules\Template\Http\Requests\SurpriseItem;
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

    public function shop(Shop $request)
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getPagination($request->input('fuzzy_name'));
        $googleMapKey = config('remotesystem.googleMapApiKey');
        return $this->render('shop', [
            'shop' => $shop,
            'fuzzyName' => $request->input('fuzzy_name'),
            'googleMapKey' => $googleMapKey,
        ]);
    }

    public function shopImages(ShopImages $request)
    {
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getShop($request->input('id'));
        return $this->render('shopImages', [
            'shop' => $shop,
            'shopId' => $request->input('id'),
        ]);
    }

    public function menu(Menu $request)
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getShop($request->input('id'));
        $menuRepo = app()->make(MenuRepository::class);
        $menu = $menuRepo->getPaginationWithIdOrNull($request->input('id'));
        return $this->render('menu', [
            'shop' => $shop,
            'menu' => $menu,
            'parameter' => $request->except('page'),
            'name' => $request->input('name'),
            'id' => $request->input('id'),
        ]);
    }

    public function discount(Discount $request)
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getShop($request->input('id'));
        $menuRepo = app()->make(DiscountRepository::class);
        $discount = $menuRepo->getPaginationWithIdOrNull($request->input('id'));
        return $this->render('discount', [
            'shop' => $shop,
            'discount' => $discount,
            'parameter' => $request->except('page'),
            'id' => $request->input('id'),
            'discountType' => DiscountTypeConstants::all(),
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

    public function message(Message $request)
    {
        $account = $request->input('account');
        $messageRepo = app()->make(MessageRepository::class);
        $results = $messageRepo->getByFuzzy($account);
        return $this->render('message', [
            'message' => $results,
            'account' => $account,
            'parameter' => $request->except('page'),
        ]);
    }

    public function announcement(Announcement $request)
    {
        /** @var AnnouncementRepository $annRepo */
        $annRepo = app()->make(AnnouncementRepository::class);
        $announcement = $annRepo->getPagination(null, $request->input('type'));
        return $this->render('announcement', [
            'announcement' => $announcement,
            'languages' => AnnouncementConstants::getSupportLanguage(),
            'type' => AnnouncementConstants::getAllWithView(),
            'request' => $request,
            'parameter' => $request->except('page'),
        ]);
    }

    public function surpriseBox()
    {
        /** @var SurpriseRepository $surpriseRepo */
        $surpriseRepo = app()->make(SurpriseRepository::class);
        $surprise = $surpriseRepo->getPagination();
        return $this->render('surpriseBox', [
            'surprise' => $surprise,
        ]);
    }

    public function surpriseItem(SurpriseItem $request)
    {
        /** @var SurpriseRepository $surpriseRepo */
        $surpriseRepo = app()->make(SurpriseRepository::class);
        $surprise = $surpriseRepo->get($request->input('id'));
        /** @var SurpriseItemRepository $surpriseRepo */
        $surpriseItemRepo = app()->make(SurpriseItemRepository::class);
        $surpriseItem = $surpriseItemRepo->getPagination($request->input('id'));
        return $this->render('surpriseItem', [
            'surprise' => $surprise,
            'surpriseItem' => $surpriseItem,
            'surpriseBoxId' => $request->input('id'),
        ]);
    }

    public function boardAnalysis()
    {
        /** @var ForumPopularityService $forumPopularityServ */
        $forumPopularityServ = app()->make(ForumPopularityService::class);
        $forumPopularity = $forumPopularityServ->getForumPopularityToday();
        return $this->render('boardAnalysis', [
            'forumPopularity' => $forumPopularity,
        ]);
    }

    public function boardAnalysisMonth(BoardAnalysisMonth $request)
    {
        /** @var ForumPopularityService $forumPopularityServ */
        $forumPopularityServ = app()->make(ForumPopularityService::class);
        $forumPopularity = $forumPopularityServ->getForumPopularityOneMonth($request->input('forum_id'));
        $popularity = $forumPopularity->popularity->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('accumulation_popularity', 'dayDate');
        return $this->render('boardAnalysisMonth', [
            'forumPopularity' => $forumPopularity,
            'popularity' => $popularity,
        ]);
    }

    public function boardAnalysisThreeMonth(BoardAnalysisMonth $request)
    {
        /** @var ForumPopularityService $forumPopularityServ */
        $forumPopularityServ = app()->make(ForumPopularityService::class);
        $forumPopularity = $forumPopularityServ->getForumPopularityThreeMonth($request->input('forum_id'));
        $popularity = $forumPopularity->popularity->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('accumulation_popularity', 'dayDate');
        return $this->render('boardAnalysisMonth', [
            'forumPopularity' => $forumPopularity,
            'popularity' => $popularity,
        ]);
    }

    public function shopAnalysis()
    {
        /** @var ShopPopularityService $popularityServ */
        $popularityServ = app()->make(ShopPopularityService::class);
        $shopPopularity = $popularityServ->getPopularityToday();
        return $this->render('shopAnalysis', [
            'shopPopularity' => $shopPopularity,
        ]);
    }

    public function shopAnalysisMonth(ShopAnalysisMonth $request)
    {
        /** @var ShopPopularityService $popularityServ */
        $popularityServ = app()->make(ShopPopularityService::class);
        $shopPopularity = $popularityServ->getPopularityOneMonth($request->input('shop_id'));
        $popularity = $shopPopularity->popularity->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('accumulation_popularity', 'dayDate');
        $popularityMale = $shopPopularity->popularitySingleMale->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('count', 'dayDate');
        $popularityFemale = $shopPopularity->popularitySingleFemale->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('count', 'dayDate');
        return $this->render('shopAnalysisMonth', [
            'shopPopularity' => $shopPopularity,
            'popularity' => $popularity,
            'popularityMale' => $popularityMale,
            'popularityFemale' => $popularityFemale,
        ]);
    }

    public function shopAnalysisThreeMonth(ShopAnalysisMonth $request)
    {
        /** @var ShopPopularityService $popularityServ */
        $popularityServ = app()->make(ShopPopularityService::class);
        $shopPopularity = $popularityServ->getPopularityThreeMonth($request->input('shop_id'));
        $popularity = $shopPopularity->popularity->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('accumulation_popularity', 'dayDate');
        $popularityMale = $shopPopularity->popularitySingleMale->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('count', 'dayDate');
        $popularityFemale = $shopPopularity->popularitySingleFemale->map(function ($item) {
            $item->dayDate = date('Y-m-d', $item->day);
            return $item;
        })->pluck('count', 'dayDate');
        return $this->render('shopAnalysisMonth', [
            'shopPopularity' => $shopPopularity,
            'popularity' => $popularity,
            'popularityMale' => $popularityMale,
            'popularityFemale' => $popularityFemale,
        ]);
    }

    public function push()
    {
        /** @var PushService $pushServ */
        $pushServ = app()->make(PushService::class);
        $push = $pushServ->list();
        return $this->render('push', [
            'push' => $push,
        ]);
    }

    public function reservation()
    {
        /** @var ReservationRepository $reservation */
        $reservationRepo = app()->make(ReservationRepository::class);
        $reservation = $reservationRepo->getPagination();
        return $this->render('reservation', [
            'reservation' => $reservation,
        ]);
    }

    public function test()
    {
        return view('template::test');
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
