<?php
namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Announcement\Services\AnnouncementService;
use Modules\Template\Http\Requests\AnnouncementCreate;
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
            $request->input('end_time')
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
            $request->input('end_time')
        );
        return redirect()->back();
    }
}
