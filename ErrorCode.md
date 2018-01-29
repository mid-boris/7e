# Error Code List

> 系統錯誤

| 內文                                      | 代碼             | 說明                                  |
|-------------------------------------------|------------------|---------------------------------------|
| <b>BASE_MODEL_NOT_FOUND</b>               | 1000             | 找不到model in repository             |
| <b>BASE_PARAMETER_INVALID</b>             | 1001             | 參數錯誤或無效                        |
| <b>BASE_MIGRATE_MODE_ERROR</b>            | 1002             | Migrate Mode Error                    |

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
| <b>FORUM_VOTE_END_TIME_EXPIRED</b>        | 20004            | 投票時間已過期                        |

> 遠端資訊

| 內文                                      | 代碼             | 說明                                  |
|-------------------------------------------|------------------|---------------------------------------|
| <b>REMOTE_SYSTEM_GET_TOKEN_ERROR</b>      | 30001            | token獲取錯誤                         |
| <b>REMOTE_SYSTEM_GET_DATA_ERROR</b>       | 30002            | 資訊為空                              |
| <b>REMOTE_SYSTEM_DATA_DECODER_ERROR</b>   | 30003            | 無效的編譯                            |
| <b>REMOTE_SYSTEM_NORMAL_ERROR</b>         | 30004            | 其餘錯誤                              |

> google map error

| 內文                                                | 代碼             | 說明                                  |
|-----------------------------------------------------|------------------|---------------------------------------|
| <b>REMOTE_SYSTEM_GOOGLE_MAP_PARAMETER_ERROR</b>     | 40001            | 地址不得為空                          |
| <b>REMOTE_SYSTEM_GOOGLE_MAP_GET_DATA_ERROR</b>      | 40002            | 資訊為空                              |
| <b>REMOTE_SYSTEM_GOOGLE_MAP_DATA_DECODER_ERROR</b>  | 40003            | 無效的編譯                            |
| <b>REMOTE_SYSTEM_GOOGLE_MAP_NORMAL_ERROR</b>        | 40004            | 其餘錯誤                              |
| <b>REMOTE_SYSTEM_GOOGLE_MAP_CAN_NOT_GET_RESULT</b>  | 40005            | 資料結構錯誤                          |

> 商家資訊錯誤 (後台)

| 內文                                                | 代碼             | 說明                                  |
|-----------------------------------------------------|------------------|---------------------------------------|
| <b>SHOP_DATA_MAP_INFO_INVALID</b>                   | 50001            | 地圖資訊錯誤                          |
| <b>SHOP_HAS_TRADEMARK_IMAGE</b>                     | 50002            | 該商家已擁有商標                      |
| <b>SHOP_PREVIEW_COUNT_INVALID</b>                   | 50003            | 預覽圖不得超過3筆                     |
