<?php

namespace Modules\Error\Constants;

class ErrorCode
{
    /** Module Base */
    const BASE_MODEL_NOT_FOUND = 1000;      // 找不到model in base repository
    const BASE_PARAMETER_INVALID = 1001;    // 無效的參數
    const BASE_MIGRATE_MODE_ERROR = 1002;   // migrate 的 mode 錯誤

    /** Module Entrust */
    const ENTRUST_USER_VALIDATE_ERROR = 10001;      // 登入驗證錯誤
    const ENTRUST_USER_NOT_FOUND = 10002;           // 找不到使用者
    const ENTRUST_ROLE_NOT_FOUND = 10003;           // 找不到角色
    const ENTRUST_USER_LOGIN_ERROR = 10004;         // 尚未登入
    const ENTRUST_USER_PERMISSION_ERROR = 10005;         // 權限錯誤

    /** Module  */

    /** Module Forum */
    const FORUM_VOTE_INVALID_COUNT = 20001;      // 投票數大於文章設定的最大投票數
    const FORUM_VOTE_VOTED = 20002;      // 已投過票
    const FORUM_VOTE_INVALID_OPTION_ID = 20003;      // 已投過票
    const FORUM_VOTE_END_TIME_EXPIRED = 20004;      // 投票已過期

    /** Module RemoteSystem */
    const REMOTE_SYSTEM_GET_TOKEN_ERROR = 30001;     // 獲得遠端token時錯誤, http code error
    const REMOTE_SYSTEM_GET_DATA_ERROR = 30002;     // 獲得遠端token時錯誤, 回傳資料為空
    const REMOTE_SYSTEM_DATA_DECODER_ERROR = 30003;     // 獲得遠端token時錯誤, 資料反解錯誤
    const REMOTE_SYSTEM_NORMAL_ERROR = 30004;     // 獲得遠端token時錯誤, 錯誤代碼error用

    /** Module RemoteSystem By Google map */
    const REMOTE_SYSTEM_GOOGLE_MAP_PARAMETER_ERROR = 40001;     // 需帶地址給map查詢
    const REMOTE_SYSTEM_GOOGLE_MAP_GET_DATA_ERROR = 40002;     // 回傳資料為空
    const REMOTE_SYSTEM_GOOGLE_MAP_DATA_DECODER_ERROR = 40003;     // 資料反解錯誤
    const REMOTE_SYSTEM_GOOGLE_MAP_NORMAL_ERROR = 40004;     // 錯誤代碼error用
    const REMOTE_SYSTEM_GOOGLE_MAP_CAN_NOT_GET_RESULT = 40005;     // 獲得不到資料結構內的results

    /** Module Shop */
    const SHOP_DATA_MAP_INFO_INVALID = 50001;      // 地圖資訊錯誤
    const SHOP_HAS_TRADEMARK_IMAGE = 50002;      // 該商家已擁有商標
    const SHOP_PREVIEW_COUNT_INVALID = 50003;      // 該商家預覽圖超過三筆
}
