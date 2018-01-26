<?php
use Modules\Error\Constants\ErrorCode;

return [
    ErrorCode::BASE_MODEL_NOT_FOUND       => '找不到模組',

    ErrorCode::ENTRUST_USER_VALIDATE_ERROR       => '找不到使用者或密碼錯誤',
    ErrorCode::ENTRUST_USER_NOT_FOUND       => '找不到使用者',
    ErrorCode::ENTRUST_ROLE_NOT_FOUND       => '找不到角色',
    ErrorCode::ENTRUST_USER_LOGIN_ERROR     => '尚未登入',
    ErrorCode::ENTRUST_USER_PERMISSION_ERROR     => '權限錯誤',

    ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_PARAMETER_ERROR     => '地址不能為空',
    ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_CAN_NOT_GET_RESULT     => '獲取不到 google map 的結果',

    ErrorCode::SHOP_DATA_MAP_INFO_INVALID => '地圖資訊不合法',
    ErrorCode::SHOP_HAS_TRADEMARK_IMAGE => '該商家已擁有商標, 請先刪除後再嘗試',
    ErrorCode::SHOP_PREVIEW_COUNT_INVALID => '該商家預覽圖超過三筆',
];
