# Error Code List

> 系統錯誤

| 內文                                      | 代碼             | 說明                                  |
|-------------------------------------------|------------------|---------------------------------------|
| <b>BASE_MODEL_NOT_FOUND</b>               | 1000             | 找不到model in repository             |
| <b>BASE_PARAMETER_INVALID</b>             | 1001             | 參數錯誤或無效                        |

> 驗證錯誤

| 內文                                      | 代碼             | 說明                                  |
|-------------------------------------------|------------------|---------------------------------------|
| <b>ENTRUST_USER_VALIDATE_ERROR</b>        | 10001            | 登入驗證錯誤                          |
| <b>ENTRUST_USER_NOT_FOUND</b>             | 10002            | 找不到使用者                          |
| <b>ENTRUST_ROLE_NOT_FOUND</b>             | 10003            | 找不到角色                            |
| <b>ENTRUST_USER_LOGIN_ERROR</b>           | 10004            | 尚未登入                              |
| <b>ENTRUST_USER_PERMISSION_ERROR</b>      | 10005            | 權限錯誤                              |

> 討論版錯誤

| 內文                                      | 代碼             | 說明                                  |
|-------------------------------------------|------------------|---------------------------------------|
| <b>FORUM_VOTE_INVALID_COUNT</b>           | 20001            | 投票數大於文章設定的最大投票數        |
| <b>FORUM_VOTE_VOTED</b>                   | 20002            | 已投過票                              |
| <b>FORUM_VOTE_INVALID_OPTION_ID</b>       | 20003            | 投票項目參數無效                      |