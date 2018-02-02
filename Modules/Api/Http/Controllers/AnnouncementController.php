<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Announcement\Constants\AnnouncementConstants;
use Modules\Announcement\Repositories\AnnouncementRepository;
use Modules\Api\Http\Requests\AnnouncementIndex;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Entrust\Utilities\SessionManager;

class AnnouncementController extends Controller
{
    public function index(AnnouncementIndex $request)
    {
        /** @var AnnouncementRepository $annRepo */
        $annRepo = app()->make(AnnouncementRepository::class);

        $userLanguage = SessionManager::getUserLanguage();
        $carousel = $annRepo->getPaginationTimeFilter($userLanguage, AnnouncementConstants::TYPE_CAROUSEL);
        $marquee = $annRepo->getPaginationTimeFilter($userLanguage, AnnouncementConstants::TYPE_MARQUEE);
        $announcement = $annRepo->getPaginationTimeFilter($userLanguage, AnnouncementConstants::TYPE_ANNOUNCEMENT);

        return BaseResponse::response([
            'carousel' => $carousel,
            'marquee' => $marquee,
            'announcement' => $announcement,
        ]);
    }
}
