<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Message\Http\Requests\MessageCreate;

class MessageController extends \Modules\Message\Http\Controllers\MessageController
{
    public function create(MessageCreate $request)
    {
        parent::create($request);
        return redirect()->back();
    }
}
