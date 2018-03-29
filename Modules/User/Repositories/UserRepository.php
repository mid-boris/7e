<?php

namespace Modules\User\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\User\Entities\User;
use Illuminate\Http\UploadedFile;
use Modules\Image\Entities\ImageFile;

class UserRepository extends UserBaseRepository
{
    private $dir = '/images/user';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $account
     * @param string $password
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getWithRoleByAccountPassword(string $account, string $password)
    {
        /** @var \Eloquent $user */
        $user = new User;
        return $user->with('role')->where('account', $account)->where('password', $password)->first();
    }

    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getWithRoleById(int $userId)
    {
        /** @var \Eloquent $user */
        $user = new User;
        return $user->with('role')->where('id', $userId)->first();
    }

    public function getPaginationWithRole(int $perpage = 50)
    {
        /** @var \Eloquent $user */
        $user = new User;
        $user = $user->with(['role']);
        if (!SessionManager::isAdmin()) {
            $user = $user->where('account', '!=', 'admin');
        }
        return $user->orderBy('id', 'DESC')->paginate($perpage);
    }

    /**
     * @param string $account
     * @param string $password
     * @param string $nickName
     * @param int $status
     * @return User
     */
    public function create(string $account, string $password, string $nickName, $status = 1)
    {
        $userData = [
            'account' => $account,
            'password' => md5($password),
            'nick_name' => $nickName,
            'status' => $status,
        ];
        return $this->createAttributes($userData);
    }

    public function createAttributes(array $attributes)
    {
        $user = new User;
        $user->fill($attributes)->save();
        return $user;
    }

    public function update(array $data, int $id)
    {
        /** @var \Eloquent $user */
        $user = new User;
        $target = $user->where('id', $id)->first();
        if ($target) {
            $target->fill($data)->save();
            return $target;
        }
        return false;
    }

    public function getByAccount(string $account)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $user */
        $user = new User;
        return $user->where('account', $account)->first();
    }

    public function imageCreate(User $user, UploadedFile $image)
    {
        // 儲存圖片
        $fileName = microtime(true) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($this->dir);
        $result = $image->move($destinationPath, $fileName);
        if ($result) {
            \DB::transaction(function () use ($result, $user) {
                $image = new ImageFile;
                $image->saved_uri = $result->getFilename();
                $image->image_size = $result->getSize();
                list($width, $height) = getimagesize($result->getRealPath());
                $image->image_width = $width;
                $image->image_height = $height;
                $image->save();

                $user->avatar = $result->getFilename();
            });
        }
        return $result ? true : false;
    }
}
