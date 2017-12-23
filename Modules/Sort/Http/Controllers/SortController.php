<?php

namespace Modules\Sort\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sort\Tools\Connection;

class SortController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        /** @var Connection $kirara */
        $kirara = app()->make(Connection::class);
        $kirara->getVersion();
    }
}
