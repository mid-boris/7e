<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Repositories\MenuRepository;
use Modules\Template\Http\Requests\MenuCreate;

class MenuController extends Controller
{
    protected $menuRepo;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepo = $menuRepository;
    }

    public function create(MenuCreate $request)
    {
        $status = $request->input('status') ?? 0;
        $vegetarian = $request->input('vegetarian') ?? 0;
        $data = $request->all();
        $data['status'] = $status;
        $data['vegetarian'] = $vegetarian;
        $this->menuRepo->create($data);
        return redirect()->back();
    }
}
