<?php
namespace Modules\Shop\Constants;

class DiscountTypeConstants
{
    const ON_SALE = 1;                  // 單品項折扣
    const TOTAL_OFF = 2;                // 總價折扣
    const BUY_GET_FREE = 3;             // 文字優惠
    const SPECIAL_OFFER = 4;            // 特惠 - 年紀折扣
    const CLEARANCE = 5;                // 出清折扣
    const REBATE = 6;                   // 紅利回饋
    const BONUS_INCREASE = 7;            // 紅利增額
    const PRICE_FOR_MEMBER = 8;          // 會員價
    const BIRTHDAY_OFF = 9;             // 生日折扣

    public static function all()
    {
        return [
            self::ON_SALE,
            self::TOTAL_OFF,
            self::BUY_GET_FREE,
            self::SPECIAL_OFFER,
            self::CLEARANCE,
            self::REBATE,
            self::BONUS_INCREASE,
            self::PRICE_FOR_MEMBER,
            self::BIRTHDAY_OFF,
        ];
    }
}
