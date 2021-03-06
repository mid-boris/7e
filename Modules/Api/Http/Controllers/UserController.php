<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\UserEdit;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\User\Repositories\UserRepository;
use Session;

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
        $language = $request->input('language');
//        $avatar = $request->input('avatar');
        $updatedData = [
            'nick_name' => $nickName,
            'mail' => $mail,
            'phone' => $phone,
            'gender' => $gender,
            'area_id' => $areaId,
            'language' => $language,
//            'avatar' => $avatar,
        ];
        /** @var UserRepository $userRepo */
        $userRepo = app()->make(UserRepository::class);
        /** @var \Modules\User\Entities\User|false $user */
        $user = $userRepo->update($updatedData, $userId);
        if ($user) {
            // 新增圖片
            if (!is_null($request->file('avatar'))) {
                $userRepo->imageCreate($user, $request->file('avatar'));
            }

            // update完成順便更新session manager
            $user = $userRepo->getWithRoleById($userId);
            Session::put('user', $user->toArray());
            Session::save();
        }
        return BaseResponse::response(['data' => true]);
    }
}
