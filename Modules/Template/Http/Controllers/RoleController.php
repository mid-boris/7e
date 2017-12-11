<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Entrust\Repositories\RoleRepository;
use Modules\Template\Http\Requests\RoleCreate;
use Modules\Template\Http\Requests\RoleDelete;
use Modules\Template\Http\Requests\RoleUpdate;

class RoleController extends Controller
{
    /** @var RoleRepository  */
    protected $roleRepo;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepo = $roleRepository;
    }

    public function create(RoleCreate $request)
    {
        $this->roleRepo->create($request->input('name'));
        return redirect()->back();
    }

    public function update(RoleUpdate $request)
    {
        $this->roleRepo->update($request->input('name'), $request->input('id'));
        return redirect()->back();
    }

    public function delete(RoleDelete $request)
    {
        $this->roleRepo->delete($request->input('id'));
        return redirect()->back();
    }
}
