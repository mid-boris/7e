<?php
namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Announcement\Http\Requests\AnnouncementDelete;
use Modules\Announcement\Services\AnnouncementService;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Template\Http\Requests\AnnouncementCreate;
use Modules\Template\Http\Requests\AnnouncementShopSearch;
use Modules\Template\Http\Requests\AnnouncementUpdate;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('template::index');
    }

    public function create(AnnouncementCreate $request)
    {
        $highLight = $request->input('high_light') ?? 0;
        $status = $request->input('status') ?? 0;

        $announcementServ = app()->make(AnnouncementService::class);
        $announcementServ->create(
            $request->input('title'),
            $request->input('content'),
            $request->input('language'),
            $request->input('type'),
            $status,
            $highLight,
            $request->file('image'),
            $request->input('start_time'),
            $request->input('end_time'),
            $request->input('shop_id')
        );
        return redirect()->back();
    }

    public function update(AnnouncementUpdate $request)
    {
        $highLight = $request->input('high_light') ?? 0;
        $status = $request->input('status') ?? 0;

        $announcementServ = app()->make(AnnouncementService::class);
        $announcementServ->update(
            $request->input('id'),
            $request->input('title'),
            $request->input('content'),
            $request->input('language'),
            $request->input('type'),
            $status,
            $highLight,
            $request->file('image'),
            $request->input('start_time'),
            $request->input('end_time'),
            $request->input('shop_id')
        );
        return redirect()->back();
    }

    public function delete(AnnouncementDelete $request)
    {
        $announcementServ = app()->make(AnnouncementService::class);
        $announcementServ->delete($request->input('id'));
        return redirect()->back();
    }

    public function shopSearch(AnnouncementShopSearch $request)
    {
        $shopRepo = app()->make(ShopRepository::class);
        $shop = $shopRepo->getShopByName($request->input('shop_name'));
        return BaseResponse::response(['data' => $shop]);
    }
}
