<?php

namespace Modules\RemoteSystem\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\RemoteSystem\Src\Connection;

class RemoteSystemController extends Controller
{
    public function index()
    {
        /** @var Connection $connection */
        $connection = app()->make(Connection::class);
        $connection->getToken();
    }
}
