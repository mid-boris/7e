<?php
namespace Modules\Shop\Constants;

class ShopType
{
    private static $type = [
        0 => '無',
        1 => '食',
        2 => '衣',
        3 => '住',
        4 => '行',
        5 => '育',
        6 => '樂',
    ];

    public static function getTypeName($type)
    {
        return is_null($type) ? '' : self::$type[$type];
    }
}
