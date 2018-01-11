<?php

namespace Modules\Error\Constants;

class ErrorCode
{
    /** Module Base */
    const BASE_MODEL_NOT_FOUND = 1000;      // 找不到model in base repository
    const BASE_PARAMETER_INVALID = 1001;    // 無效的參數

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

    /** Module RemoteSystem */
    const REMOTE_SYSTEM_GET_TOKEN_ERROR = 30001;     // 獲得遠端token時錯誤
}
