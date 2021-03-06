<?php
namespace Modules\Entrust\Utilities;

use Session;

class SessionManager
{
    public static function getRole() : array
    {
        return Session::get('user.role.0');
    }

    public static function getRoleId() : int
    {
        return Session::get('user.role.0.id');
    }

    public static function getUser() : array
    {
        return Session::get('user');
    }

    public static function getUserId() : int
    {
        return self::getUser()['id'];
    }

    public static function getUserAreaId()
    {
        return self::getUser()['area_id'];
    }

    public static function getUserGender()
    {
        return self::getUser()['gender'];
    }

    public static function getUserAvatar()
    {
        return self::getUser()['avatar'];
    }

    public static function getUserLanguage() : string
    {
        return self::getUser()['language'];
    }

    public static function getUserAccount() : string
    {
        return self::getUser()['account'];
    }

    public static function getUserNickName() : string
    {
        return self::getUser()['nick_name'];
    }

    public static function isLogin() : bool
    {
        return Session::has('user');
    }

    public static function isAdmin() : bool
    {
        return Session::get('user.role.0.name') == 'admin';
    }
}
