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
}
