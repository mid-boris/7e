<?php
namespace Modules\RemoteSystem\Constants;

use Modules\Error\Constants\ErrorCode;

class GloryErrorCode
{
    const UNDEFINED_ARGUMENT = 101;
    const TOKEN_EXPIRE = 102;
    const TOKEN_BE_REVOKED = 103;
    const UNDEFINED_LANGUAGE = 104;
    const UNDEFINED_COUNTRY = 105;
    const MULTI_PHONE_NUMBER = 106;
    const MULTI_ID_NUMBER = 107;
    const MULTI_LINE_ID = 108;
    const MULTI_WECHAT_ID = 109;
    const MULTI_WHATSAPP_ID = 110;
    const MORE_THAN_DAILY_SMS_TIMES = 111;
    const SENT_TIME_IS_TOO_CLOSE = 112;

    const NOT_FIND_ACCOUNT = 201;
    const PASSWORD_VERIFY_FAIL = 202;
    const AGE_DOES_NOT_MATCH = 203;
    const ILLEGAL_ACCOUNT = 204;
    const ILLEGAL_NAME = 205;
    const ILLEGAL_ID_NUMBER = 206;
    const ILLEGAL_PHONE = 207;
    const ILLEGAL_LINE_ID = 208;
    const ILLEGAL_WECHAT_ID = 209;
    const ILLEGAL_WHATSAPP_ID = 210;
    const NO_WAY_OF_COMMUNICATION = 211;
    const AREA_IS_NOT_OPEN = 212;
    const PHONE_AREA_IS_NOT_OPEN = 213;
    const ACCOUNT_IS_USED = 214;
    const ACCOUNT_IS_SUSPENDED = 215;
    const ACCOUNT_IS_SUSPENSION_INCOME = 216;
    const PHONE_VERIFY_FAIL = 217;
    const REG_POINT_IS_NOT_ENOUGH = 218;
    const GAME_POINT_IS_NOT_ENOUGH = 219;
    const SE_COIN_IS_NOT_ENOUGH = 220;

    const NOT_FIND_SUB_ACCOUNT = 301;
    const MAX_SUB_ACCOUNT_OPERATING = 302;
    const SUB_ACCOUNT_OPERATING = 303;
    const RECOMMENDED_SUPERIOR = 304;
    const OTHER_OR_NOT_AGENT = 305;

    public static function mappingCode(int $code)
    {
        $mapping = [
            self::NOT_FIND_ACCOUNT => ErrorCode::ENTRUST_USER_NOT_FOUND,
            self::PASSWORD_VERIFY_FAIL => ErrorCode::ENTRUST_USER_VALIDATE_ERROR,
        ];
        return array_key_exists($code, $mapping) ?
            $mapping[$code] :
            ErrorCode::REMOTE_SYSTEM_NORMAL_ERROR;
    }
}
