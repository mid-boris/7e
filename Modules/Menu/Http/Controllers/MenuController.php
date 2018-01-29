<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Http\Requests\MenuDelete;
use Modules\Menu\Http\Requests\MenuUpdate;
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
        $data = $request->all();
        $this->menuRepo->create($data);
        return redirect()->back();
    }

    public function update(MenuUpdate $request)
    {
        $data = $request->all();
        $this->menuRepo->update($data, $request->input('id'));
        return redirect()->back();
    }

    public function delete(MenuDelete $request)
    {
        $menuId = $request->input('id');
        $this->menuRepo->delete($menuId);
        return redirect()->back();
    }
}
