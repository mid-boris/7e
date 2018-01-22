<?php

namespace Modules\RemoteSystem\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\RemoteSystem\Src\GloryConnection;
use Modules\RemoteSystem\Src\GoogleMapConnection;

class RemoteSystemController extends Controller
{
    public function index()
    {
        /** @var GoogleMapConnection $connection */
        $connection = app()->make(GoogleMapConnection::class);
        $connection->getMapInfoFromAddress('台中市西區公益路276號');
        dd($connection->getResults());
    }
}
