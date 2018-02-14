<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Entrust\Utilities\SessionManager;
use Modules\Push\Services\PushService;
use Modules\Template\Http\Requests\PushCreate;

class PushController extends Controller
{
    public function create(PushCreate $request)
    {
        $data = $request->all();
        $data['user_id'] = SessionManager::getUserId();
        $data['user_account'] = SessionManager::getUserAccount();
        $pushServ = app()->make(PushService::class);
        $pushServ->create($data);
        return redirect()->back();
    }
}