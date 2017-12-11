<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Template\Http\Requests\AccountCreate;
use Modules\Template\Http\Requests\AccountUpdate;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\UserService;

class AccountController extends Controller
{
    /** @var UserRepository  */
    private $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }
    
    public function create(AccountCreate $request)
    {
        $status = $request->input('status') ?? 0;
        if ($this->userRepo->create($request['account'], $request['password'], $request['nick_name'], $status)) {
            $userService = app()->make(UserService::class);
            $roleId = $request->input('role');
            if ($roleId > 0) {
                $userService->accountAddRoleByRoleId($request['account'], $roleId);
            }
        }
        return redirect('/account');
    }

    public function update(AccountUpdate $request)
    {
        $status = $request->input('status') ?? 0;
        $data = $request->all();
        $data['status'] = $status;
        $this->userRepo->update($data, $request['id']);
        $roleId = $request->input('role');
        if ($roleId > 0) {
            $userService = app()->make(UserService::class);
            $userService->accountAddRoleByRoleId($request['account'], $roleId);
        }
        return redirect('/account');
    }
}
