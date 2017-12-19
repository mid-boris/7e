<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\UserEdit;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\User\Repositories\UserRepository;

class UserController extends Controller
{
    public function edit(UserEdit $request)
    {
        $userId = $request->input('user_id');
        $nickName = $request->input('nick_name');
        $mail = $request->input('email');
        $phone = $request->input('phone');
        $gender = $request->input('gender');
        $areaId = $request->input('area_id');
        $updatedData = [
            'nick_name' => $nickName,
            'mail' => $mail,
            'phone' => $phone,
            'gender' => $gender,
            'area_id' => $areaId,
        ];
        /** @var UserRepository $userRepo */
        $userRepo = app()->make(UserRepository::class);
        $result = $userRepo->update($updatedData, $userId);
        return BaseResponse::response(['data' => $result]);
    }
}
