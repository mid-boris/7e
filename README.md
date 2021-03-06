## Api Response

> HTTP status code

收到 Response 時, 請先確認 HTTP status code 是否為 200, 不為 200 時代表發生非預期錯誤.
請參考[網路狀態碼](https://en.wikipedia.org/wiki/List_of_HTTP_status_codes)

> Header

該筆回傳是否成功的 code 在 header 裡, 
當 code 為 0 時即為成功響應, 其餘請參考[錯誤碼](https://github.com/mid-boris/7e/blob/master/ErrorCode.md)

    code → 0

## Api System Required Package
1. [Simple QrCode](https://www.simplesoftware.io/docs/simple-qrcode)

## Api Doc

#### 登入

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/login             |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 無                         |              | Null                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | user                       | string(32)   |                                       |
|                           | password                   | string(32)   |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "id": 3,
        "account": "member",
        "nick_name": "會員一號",
        "mail": null,
        "phone": null,
        "area_id": null,
        "gender": null,
        "created_at": "2017-12-19 08:52:29",
        "updated_at": "2017-12-19 08:52:29",
        "role": [
            {
                "id": 3,
                "name": "榮耀會員",
                "relate": {
                    "user_id": 3,
                    "role_id": 3
                }
            }
        ]
    }

#### 登出

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/logout            |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 無                         |              | Null                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": true
    }

#### 是否登入中

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/isLogin           |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 無                         |              | Null                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": false
    }

#### 取得地區

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/area/index        |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | parent_id                  | id           |                                       |

> 回應

    [
        {
            "id": 1,
            "parent_id": null,
            "name": "台灣",
            "children_count": 1,
            "children": [
                {
                    "id": 2,
                    "parent_id": 1,
                    "name": "台中市"
                }
            ]
        }
    ]

#### 編輯會員資料

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/user/edit         |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 更新                       |              | UPDATE                                |
| <b>必填參數</b>           |                            |              |                                       |
|                           | user_id                    | id           | 會員 id                               |
|                           | nick_name                  | string(16)   | 暱稱                                  |
|                           | email                      | string       | e mail                                |
|                           | phone                      | string(10)   | 手機                                  |
|                           | gender                     | string(0/1)  | 性別                                  |
|                           | area_id                    | id           | 地區 id                               |
|                           | language                   | string       | 語系code [附件](https://github.com/mid-boris/7e#語系附件)                     |
|                           | avatar                     | string       | 大頭貼 base64 字串 (size <= 64KB)     |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": true
    }


#### 取得投票專區

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/forum/vote        |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | forum_id                   | id           |                                       |

#### 取得討論專區

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/forum/board       |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | forum_id                   | id           |                                       |

> 回應

#### 參數說明
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
|                           | sort                       | integer      | 為 9 時是置頂, 其餘一般               |

    {
        "forum": {
            "current_page": 1,
            "data": [],
            "first_page_url": "http://7e.net/api/1.0/forum/board?page=1",
            "from": null,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/forum/board?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/forum/board",
            "per_page": 35,
            "prev_page_url": null,
            "to": null,
            "total": 0
        },
        "article": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "forum_id": 3,
                    "parent_id": null,
                    "title": "標題測試",
                    "context": "標題測試123",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1,
                    "updated_at": "2018-02-14 21:08:23",
                    "vote_end_time": null,
                    "avatar": null,
                    "children_count": 0,
                    "type_like_count": 1,
                    "type_unlike_count": 0,
                    "images": [],
                    "type_like": [
                        {
                            "id": 1,
                            "article_id": 1,
                            "user_id": 4,
                            "like_type": 0
                        }
                    ],
                    "type_unlike": [],
                    "children": [],
                    "vote_option": [],
                    "vote_item": []
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/forum/board?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/forum/board?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/forum/board",
            "per_page": 35,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        }
    }
    
#### 取得文章列表

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/article/index     |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | forum_id                   | id           | 討論版id                              |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

#### 參數說明
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
|                           | image                      | array        | 圖片s                                 |
|                           | image.*                    | image        | 圖片                                  |
| image路徑                 | /images/article            | uri          |                                       |

> 回應

    {
        "current_page": 1,
        "data": [
            {
                "id": 2,
                "forum_id": 4,
                "parent_id": null,
                "title": "測試文章二號",
                "context": "測試文章二號測試文章二號\r\n測試文章二號測試文章二號測試文章二號\r\n測試文章二號測試文章二號\r\n測試文章二號\r\n\r\n測試文章二號測試文章二號\r\n測試文章二號測試文章二號測試文章二號\r\n\r\n測試文章二號\r\n測試文章二號\r\n測試文章二號\r\n測試文章二號",
                "audit": 0,
                "user_account": "admin",
                "user_nick_name": "ffhh",
                "vote_max_count": 1
            },
            {
                "id": 1,
                "forum_id": 4,
                "parent_id": null,
                "title": "測試文章",
                "context": "測試文章測試文章\r\n測試文章測試文章測試文章\r\n\r\n測試文章測試文章測試文章\r\n測試文章測試文章\r\n\r\n測試文章測試文章測試文章",
                "audit": 0,
                "user_account": "admin",
                "user_nick_name": "ffhh",
                "vote_max_count": 1
            }
        ],
        "first_page_url": "http://7eapp.honor-financial.com/api/1.0/article/index?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://7eapp.honor-financial.com/api/1.0/article/index?page=1",
        "next_page_url": null,
        "path": "http://7eapp.honor-financial.com/api/1.0/article/index",
        "per_page": 35,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }

#### 取得目標文章

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/article/show      |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | article_id                 | id           |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "article": {
            "id": 1,
            "forum_id": 4,
            "parent_id": null,
            "title": "無投票測試",
            "context": "無投票測試\r\n無投票測試\r\n無投票測試無投票測試\r\n無投票測試無投票測試\r\n無投票測試無投票測試\r\n\r\n無投票測試\r\n無投票測試無投票測試\r\n無投票測試",
            "audit": 0,
            "user_account": "admin",
            "user_nick_name": "admin",
            "vote_max_count": 1,
            "vote_option": [],
            "vote_item": []
        },
        "reports": {
            "current_page": 1,
            "data": [
                {
                    "id": 7,
                    "forum_id": 4,
                    "parent_id": 1,
                    "title": "RE: 無投票測試",
                    "context": "回文測試6",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1
                },
                {
                    "id": 6,
                    "forum_id": 4,
                    "parent_id": 1,
                    "title": "RE: 無投票測試",
                    "context": "回文測試5",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1
                },
                {
                    "id": 5,
                    "forum_id": 4,
                    "parent_id": 1,
                    "title": "RE: 無投票測試",
                    "context": "回文測試4\r\n回文測試2\r\n回文測試2",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1
                },
                {
                    "id": 4,
                    "forum_id": 4,
                    "parent_id": 1,
                    "title": "RE: 無投票測試",
                    "context": "回文測試3",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1
                },
                {
                    "id": 3,
                    "forum_id": 4,
                    "parent_id": 1,
                    "title": "RE: 無投票測試",
                    "context": "回文測試2",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1
                },
                {
                    "id": 2,
                    "forum_id": 4,
                    "parent_id": 1,
                    "title": "RE: 無投票測試",
                    "context": "回文測試\r\n回文測試回文測試\r\n回文測試\r\n\r\n回文測試\r\n回文測試回文測試\r\n\r\n回文測試回文測試回文測試",
                    "audit": 0,
                    "user_account": "admin",
                    "user_nick_name": "admin",
                    "vote_max_count": 1
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/article/show?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/article/show?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/article/show",
            "per_page": 35,
            "prev_page_url": null,
            "to": 6,
            "total": 6
        }
    }

#### 針對目標文章 Like
#### 針對目標文章 UnLike

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/article/like      |              |                                       |
|                           | /api/1.0/article/unlike    |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 更新                       |              | UPDATE                                |
| <b>必填參數</b>           |                            |              |                                       |
|                           | article_id                 | id           |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": true
    }

#### 發文、回文

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/article/create    |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 新增                       |              | CREATE                                |
| <b>必填參數</b>           |                            |              |                                       |
|                           | title                      | string       | 標題                                  |
|                           | content                    | string       | 內文                                  |
|                           | forum_id                   | id           | 版id                                  |
|                           | vote_max_count             | integer      | 投票最大數                            |
| <b>選填參數</b>           |                            |              |                                       |
|                           | parent_id                  | id           | 文章id                                |
|                           | vote_option                | array        | 投票項目                              |
|                           | vote_option.*              | string       | 投票項目文字                          |
|                           | vote_end_time              | integer      | 投票截止時間 (unix time)              |
|                           | image                      | array        | 圖片陣列                              |
|                           | image.*                    | image        | 圖片 (jpg, jpeg) (max: 1024 x 500)    |

> 回應

    {
        "data": true
    }


#### 投票

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/vote/add          |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 更新                       |              | UPDATE                                |
| <b>必填參數</b>           |                            |              |                                       |
|                           | vote_ids                   | array        | 投票目標ids                           |
|                           | vote_ids.*                 | id           | 投票目標id                            |
|                           | article_id                 | id           | 文章id                                |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": true
    }

#### 獲得聯絡客服list

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/message/index     |              |                                       |
| <b>方法</b>               | GET                        |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
| <b>必填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 5,
                    "content": "回覆測試回覆測試回覆測試回覆測試",
                    "target_id": 4,
                    "target_account": "tuohoi87",
                    "target_nick_name": "測試會員",
                    "user_id": 1,
                    "user_account": "admin",
                    "user_nick_name": "admin"
                },
                {
                    "id": 3,
                    "content": "毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒",
                    "target_id": 4,
                    "target_account": "tuohoi87",
                    "target_nick_name": "測試會員",
                    "user_id": 4,
                    "user_account": "tuohoi87",
                    "user_nick_name": "測試會員"
                },
                {
                    "id": 4,
                    "content": "毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒",
                    "target_id": 4,
                    "target_account": "tuohoi87",
                    "target_nick_name": "測試會員",
                    "user_id": 4,
                    "user_account": "tuohoi87",
                    "user_nick_name": "測試會員"
                },
                {
                    "id": 2,
                    "content": "毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒毛毛hen棒",
                    "target_id": 4,
                    "target_account": "tuohoi87",
                    "target_nick_name": "測試會員",
                    "user_id": 4,
                    "user_account": "tuohoi87",
                    "user_nick_name": "測試會員"
                },
                {
                    "id": 1,
                    "content": "留言測試留言測試留言測試留言測試留言測試留言測試",
                    "target_id": 4,
                    "target_account": "tuohoi87",
                    "target_nick_name": "測試會員",
                    "user_id": 4,
                    "user_account": "tuohoi87",
                    "user_nick_name": "測試會員"
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/message/index?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/message/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/message/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": 7,
            "total": 7
        }
    }

#### 新增聯絡客服留言

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/message/create    |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 新增                       |              | CREATE                                |
| <b>必填參數</b>           |                            |              |                                       |
|                           | content                    |              | 內文                                  |
| <b>選填參數</b>           |                            |              |                                       |
|                           | 無                         |              |                                       |

> 回應

    {
        "data": true
    }


#### 獲得首頁推薦商家

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/top            |              |                                       |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

#### 獲得商家列表

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/index          |              |                                       |
|                           | /api/1.0/shop/food           |              | 食                                    |
|                           | /api/1.0/shop/clothing       |              | 衣                                    |
|                           | /api/1.0/shop/housing        |              | 住                                    |
|                           | /api/1.0/shop/transportation |              | 行                                    |
|                           | /api/1.0/shop/education      |              | 育                                    |
|                           | /api/1.0/shop/entertainment  |              | 樂                                    |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | area_id                      | integer      | 地區id                                |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

#### 獲得特約商家列表

| 項目                      | 內容                                | 類型         | 說明                                  |
|---------------------------|-------------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/specialShop/index          |              |                                       |
|                           | /api/1.0/specialShop/food           |              | 食                                    |
|                           | /api/1.0/specialShop/clothing       |              | 衣                                    |
|                           | /api/1.0/specialShop/housing        |              | 住                                    |
|                           | /api/1.0/specialShop/transportation |              | 行                                    |
|                           | /api/1.0/specialShop/education      |              | 育                                    |
|                           | /api/1.0/specialShop/entertainment  |              | 樂                                    |
| <b>方法</b>               | POST                                |              |                                       |
| <b>權限</b>               | 檢視                                |              | READ                                  |
| <b>必填參數</b>           |                                     |              |                                       |
|                           | area_id                             | integer      | 地區id                                |
| <b>選填參數</b>           |                                     |              |                                       |
|                           | 無                                  |              |                                       |

#### 獲得附近商家列表

| 項目                      | 內容                               | 類型         | 說明                                  |
|---------------------------|------------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/nearByShop/index          |              |                                       |
|                           | /api/1.0/nearByShop/food           |              | 食                                    |
|                           | /api/1.0/nearByShop/clothing       |              | 衣                                    |
|                           | /api/1.0/nearByShop/housing        |              | 住                                    |
|                           | /api/1.0/nearByShop/transportation |              | 行                                    |
|                           | /api/1.0/nearByShop/education      |              | 育                                    |
|                           | /api/1.0/nearByShop/entertainment  |              | 樂                                    |
| <b>方法</b>               | POST                               |              |                                       |
| <b>權限</b>               | 檢視                               |              | READ                                  |
| <b>必填參數</b>           |                                    |              |                                       |
|                           | lat                                | float        | 緯度 (為加速運算, 至小數下二位)       |
|                           | lng                                | float        | 經度 (為加速運算, 至小數下二位)       |
|                           | radius                             | integer      | 半徑 (驗證範圍 1~30)                  |
| <b>選填參數</b>           |                                    |              |                                       |
|                           | 無                                 |              |                                       |

> 回應

#### 參數說明
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
|                           | business_hours             | string       | 營業時間                              |
|                           | business_hours_start_time  | string       | 開始營業時間                          |
|                           | business_hours_end_time    | string       | 結束營業時間                          |
|                           | closed_day                 | string,array | 休息日                                |
|                           | special                    | integer      | 是否為特約                            |
|                           | status                     | integer      | 是否啟用 (無須顯示)                   |
|                           | i_pass                     | integer      | 是否能用一卡通                        |
|                           | distance                   | float        | 距離 (附近商家功能才有)               |
|                           | trademark                  | array        | 商標 (至多1筆)                        |
| 圖片位置 (範例)           |                            |              | /images/1516957367.jpg                |
|                           | preview                    | array        | 預覽圖 (至多3筆)                      |
| 圖片位置 (範例)           |                            |              | /images/1516957367.jpg                |
|                           | menu                       | array        | 菜單                                  |
|                           | menu->name                 | string       | 品項名稱                              |
|                           | menu->price                | integer      | 品項價格                              |
|                           | menu->vegetarian           | integer      | 是否素食                              |
|                           | menu->height_light         | integer      | 是否置頂                              |
|                           | menu->hot                  | integer      | 是否熱門商品                          |

    {
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 2,
                    "name": "一般店家",
                    "telphone": "0966 834 114",
                    "phone": "0966 834 114",
                    "address": "台中市西屯區慶和街75號",
                    "business_hours": "15:00:00 ~ 01:00:00",
                    "business_hours_start_time": "3:00 PM",
                    "business_hours_end_time": "1:00 AM",
                    "closed_day": "[]",
                    "special": 1,
                    "status": 1,
                    "i_pass": 0,
                    "area_id": 6,
                    "shop_type": 1,
                    "distance": 3.0438860349537524,
                    "trademark": [
                        {
                            "id": 9,
                            "saved_uri": "1516957367.jpg",
                            "image_size": 22100,
                            "created_at": "2018-01-26 09:02:47",
                            "updated_at": "2018-01-26 09:02:47",
                            "image_width": 256,
                            "image_height": 256,
                            "pivot": {
                                "shop_id": 2,
                                "image_id": 9
                            }
                        }
                    ],
                    "preview": [
                        {
                            "id": 10,
                            "saved_uri": "1516957376.jpg",
                            "image_size": 67445,
                            "created_at": "2018-01-26 09:02:56",
                            "updated_at": "2018-01-26 09:02:56",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "shop_id": 2,
                                "image_id": 10
                            }
                        },
                        {
                            "id": 11,
                            "saved_uri": "1516957383.jpg",
                            "image_size": 55624,
                            "created_at": "2018-01-26 09:03:03",
                            "updated_at": "2018-01-26 09:03:03",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "shop_id": 2,
                                "image_id": 11
                            }
                        },
                        {
                            "id": 14,
                            "saved_uri": "1516958919.jpg",
                            "image_size": 55624,
                            "created_at": "2018-01-26 09:28:39",
                            "updated_at": "2018-01-26 09:28:39",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "shop_id": 2,
                                "image_id": 14
                            }
                        }
                    ]
                },
                {
                    "id": 1,
                    "name": "測試店家",
                    "telphone": "04 2305 2799",
                    "phone": "0912345678",
                    "address": "台中市西區公益路235號",
                    "business_hours": "10:00:00 ~ 21:00:00",
                    "business_hours_start_time": "10:00 AM",
                    "business_hours_end_time": "9:00 PM",
                    "closed_day": "[]",
                    "special": 0,
                    "status": 1,
                    "i_pass": 0,
                    "area_id": 6,
                    "shop_type": 1,
                    "distance": 3.0438860349537524,
                    "trademark": [
                        {
                            "id": 5,
                            "saved_uri": "1516957130.jpg",
                            "image_size": 36040,
                            "created_at": "2018-01-26 08:58:50",
                            "updated_at": "2018-01-26 08:58:50",
                            "image_width": 256,
                            "image_height": 256,
                            "pivot": {
                                "shop_id": 1,
                                "image_id": 5
                            }
                        }
                    ],
                    "preview": [
                        {
                            "id": 6,
                            "saved_uri": "1516957209.jpg",
                            "image_size": 127941,
                            "created_at": "2018-01-26 09:00:09",
                            "updated_at": "2018-01-26 09:00:09",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "shop_id": 1,
                                "image_id": 6
                            }
                        },
                        {
                            "id": 7,
                            "saved_uri": "1516957216.jpg",
                            "image_size": 281890,
                            "created_at": "2018-01-26 09:00:16",
                            "updated_at": "2018-01-26 09:00:16",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "shop_id": 1,
                                "image_id": 7
                            }
                        },
                        {
                            "id": 8,
                            "saved_uri": "1516957224.jpg",
                            "image_size": 173112,
                            "created_at": "2018-01-26 09:00:24",
                            "updated_at": "2018-01-26 09:00:24",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "shop_id": 1,
                                "image_id": 8
                            }
                        }
                    ]
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/shop/index?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/shop/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/shop/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": 2,
            "total": 2
        }
    }


#### 獲得指定商家

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/show           |              |                                       |
| <b>方法</b>               | POST                         |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | id                           | integer      | 商家id                                |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

#### 參數說明
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
|                           | discount                   | array        | 優惠                                  |
|                           | discount.type              | int          | 優惠類型                              |
|                           | discount.menu_id           | int          | 對應的菜單id                          |
|                           | discount.age               | int          | 年紀                                  |
|                           | discount.action            | string       | 操作符                                |
|                           | discount.numeric           | float        | 值的倍率                              |
|                           | discount.custom            | string       | 自定義文字                            |
|                           | discount.start_time        | timestamp    | 開始時間                              |
|                           | discount.end_time          | timestamp    | 結束時間                              |

#### 各discount.type會使用的參數
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| discount.type             | 1                          |              | 單品項折扣                            |
|                           | discount.menu_id           | int          | 對應的菜單id                          |
|                           | discount.action            | string       | 操作符                                |
|                           | discount.numeric           | float        | 值的倍率                              |
|                           | discount.start_time        | timestamp    | 開始時間                              |
|                           | discount.end_time          | timestamp    | 結束時間                              |
|---------------------------|----------------------------|--------------|---------------------------------------|
| discount.type             | 2                          |              | 總價折扣                              |
| discount.type             | 5                          |              | 出清折扣                              |
| discount.type             | 8                          |              | 會員價                                |
| discount.type             | 9                          |              | 生日折扣                              |
|                           | discount.action            | string       | 操作符                                |
|                           | discount.numeric           | float        | 值的倍率                              |
|                           | discount.start_time        | timestamp    | 開始時間                              |
|                           | discount.end_time          | timestamp    | 結束時間                              |
|---------------------------|----------------------------|--------------|---------------------------------------|
| discount.type             | 3                          |              | 文字優惠                              |
| discount.type             | 6                          |              | 紅利回饋                              |
| discount.type             | 7                          |              | 紅利增額                              |
|                           | discount.custom            | string       | 自定義文字                            |
|                           | discount.start_time        | timestamp    | 開始時間                              |
|                           | discount.end_time          | timestamp    | 結束時間                              |
|---------------------------|----------------------------|--------------|---------------------------------------|
| discount.type             | 4                          |              | 年紀折扣                              |
|                           | discount.age               | int          | 年紀                                  |
|                           | discount.action            | string       | 操作符                                |
|                           | discount.numeric           | float        | 值的倍率                              |
|                           | discount.start_time        | timestamp    | 開始時間                              |
|                           | discount.end_time          | timestamp    | 結束時間                              |

    {
        "data": {
            "id": 2,
            "name": "衣物店家",
            "telphone": "0966 834 114",
            "phone": "0966 834 114",
            "address": "台中市西屯區慶和街75號",
            "business_hours": "15:00:00 ~ 01:00:00",
            "business_hours_start_time": "3:00 PM",
            "business_hours_end_time": "1:00 AM",
            "closed_day": "[]",
            "special": 1,
            "status": 1,
            "i_pass": 0,
            "area_id": 6,
            "shop_type": 2,
            "menu": [
                {
                    "id": 3,
                    "shop_id": 2,
                    "parent_id": null,
                    "name": "菜單三號",
                    "price": 500,
                    "vegetarian": 0,
                    "status": 1,
                    "created_at": "2018-01-29 12:25:03",
                    "updated_at": "2018-01-29 12:25:03",
                    "height_light": 1,
                    "hot": 1
                },
                {
                    "id": 1,
                    "shop_id": 2,
                    "parent_id": null,
                    "name": "菜單一號",
                    "price": 100,
                    "vegetarian": 0,
                    "status": 1,
                    "created_at": "2018-01-29 12:23:17",
                    "updated_at": "2018-01-29 12:23:17",
                    "height_light": 0,
                    "hot": 0
                }
            ],
            "trademark": [
                {
                    "id": 9,
                    "saved_uri": "1516957367.jpg",
                    "image_size": 22100,
                    "created_at": "2018-01-26 09:02:47",
                    "updated_at": "2018-01-26 09:02:47",
                    "image_width": 256,
                    "image_height": 256,
                    "pivot": {
                        "shop_id": 2,
                        "image_id": 9
                    }
                }
            ],
            "preview": [
                {
                    "id": 10,
                    "saved_uri": "1516957376.jpg",
                    "image_size": 67445,
                    "created_at": "2018-01-26 09:02:56",
                    "updated_at": "2018-01-26 09:02:56",
                    "image_width": 1024,
                    "image_height": 500,
                    "pivot": {
                        "shop_id": 2,
                        "image_id": 10
                    }
                },
                {
                    "id": 11,
                    "saved_uri": "1516957383.jpg",
                    "image_size": 55624,
                    "created_at": "2018-01-26 09:03:03",
                    "updated_at": "2018-01-26 09:03:03",
                    "image_width": 1024,
                    "image_height": 500,
                    "pivot": {
                        "shop_id": 2,
                        "image_id": 11
                    }
                },
                {
                    "id": 14,
                    "saved_uri": "1516958919.jpg",
                    "image_size": 55624,
                    "created_at": "2018-01-26 09:28:39",
                    "updated_at": "2018-01-26 09:28:39",
                    "image_width": 1024,
                    "image_height": 500,
                    "pivot": {
                        "shop_id": 2,
                        "image_id": 14
                    }
                }
            ],
            "discount": [
                {
                    "id": 17,
                    "shop_id": 2,
                    "type": 1,
                    "menu_id": 1,
                    "age": null,
                    "action": "-",
                    "numeric": "200.00",
                    "custom": null,
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 16,
                    "shop_id": 2,
                    "type": 9,
                    "menu_id": null,
                    "age": null,
                    "action": "x",
                    "numeric": "0.80",
                    "custom": null,
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 13,
                    "shop_id": 2,
                    "type": 8,
                    "menu_id": null,
                    "age": null,
                    "action": "x",
                    "numeric": "0.90",
                    "custom": null,
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 12,
                    "shop_id": 2,
                    "type": 7,
                    "menu_id": null,
                    "age": null,
                    "action": null,
                    "numeric": null,
                    "custom": "紅利限時兩倍",
                    "status": 1,
                    "start_time": 1517414400,
                    "end_time": 1518710400
                },
                {
                    "id": 10,
                    "shop_id": 2,
                    "type": 6,
                    "menu_id": null,
                    "age": null,
                    "action": null,
                    "numeric": null,
                    "custom": "滿1000點加碼500點紅利",
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 9,
                    "shop_id": 2,
                    "type": 5,
                    "menu_id": null,
                    "age": null,
                    "action": "x",
                    "numeric": "0.50",
                    "custom": null,
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 8,
                    "shop_id": 2,
                    "type": 4,
                    "menu_id": null,
                    "age": 12,
                    "action": "-",
                    "numeric": "200.00",
                    "custom": null,
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 6,
                    "shop_id": 2,
                    "type": 3,
                    "menu_id": null,
                    "age": null,
                    "action": null,
                    "numeric": null,
                    "custom": "衣服買三送一",
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                },
                {
                    "id": 5,
                    "shop_id": 2,
                    "type": 2,
                    "menu_id": null,
                    "age": null,
                    "action": "x",
                    "numeric": "0.75",
                    "custom": null,
                    "status": 1,
                    "start_time": null,
                    "end_time": null
                }
            ]
        }
    }

#### 獲得公告s

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/announcement/index  |              |                                       |
| <b>方法</b>               | POST                         |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

#### 參數說明
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
|                           | carousel                   | array        | 輪播圖                                |
|                           | marquee                    | array        | 跑馬燈                                |
|                           | announcement               | array        | 公告                                  |
|                           | lesson                     | array        | 課程                                  |
|                           | shop_refer_status          | array        | 被tag的店家                           |
|                           | *.start_time               | unix time    | 開始日期                              |
|                           | *.end_time                 | unix time    | 結束日期                              |
|                           | *.high_light               | integer      | 是否置頂 (0 / 9)                      |
|                           | *.content                  | array        | 內文                                  |
|                           | *.content.title            | string       | 標題                                  |
|                           | *.content.content          | string       | 內文                                  |
|                           | *.images                   | array        | 圖片                                  |
| 圖片位置 (範例)           |                            |              | /images/announcement/1517581910.jpg   |

    {
        "carousel": {
            "current_page": 1,
            "data": [
                {
                    "id": 2,
                    "status": 1,
                    "start_time": 1517414400,
                    "end_time": 1519056000,
                    "type": 1,
                    "high_light": 0,
                    "content": [
                        {
                            "id": 2,
                            "announcement_id": 2,
                            "language": "en",
                            "title": "title testqwfwq",
                            "content": "<p>content testwqfw</p>"
                        }
                    ],
                    "images": [
                        {
                            "id": 19,
                            "saved_uri": "1517581910.jpg",
                            "image_size": 55624,
                            "created_at": "2018-02-02 22:31:50",
                            "updated_at": "2018-02-02 22:31:50",
                            "image_width": 1024,
                            "image_height": 500,
                            "pivot": {
                                "announcement_id": 2,
                                "image_id": 19
                            }
                        }
                    ],
                    "shop_refer_status": [
                        {
                            "id": 1,
                            "name": "測試店家",
                            "telphone": "04 2305 2799",
                            "phone": "0912345678",
                            "address": "台中市西區公益路235號",
                            "business_hours": "10:00:00 ~ 21:00:00",
                            "business_hours_start_time": "10:00 AM",
                            "business_hours_end_time": "9:00 PM",
                            "closed_day": "[]",
                            "special": 0,
                            "status": 1,
                            "i_pass": 0,
                            "area_id": 6,
                            "shop_type": 0,
                            "pivot": {
                                "announcement_id": 5,
                                "shop_id": 1
                            }
                        }
                    ]
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/announcement/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        },
        "marquee": {
            "current_page": 1,
            "data": [],
            "first_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "from": null,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/announcement/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": null,
            "total": 0
        },
        "announcement": {
            "current_page": 1,
            "data": [],
            "first_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "from": null,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/announcement/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": null,
            "total": 0
        },
        "lesson": {
            "current_page": 1,
            "data": [],
            "first_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "from": null,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/announcement/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/announcement/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": null,
            "total": 0
        }
    }

#### 獲得收藏店家列表

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/favorite       |              |                                       |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

    {
        "data": {
            "id": 4,
            "account": "tuohoi87",
            "nick_name": null,
            "mail": null,
            "phone": "0985206359",
            "area_id": null,
            "gender": null,
            "created_at": "2018-01-26 09:41:50",
            "updated_at": "2018-01-30 12:29:51",
            "avatar": null,
            "language": "zh-TW",
            "shop_refer_status": [
                {
                    "id": 2,
                    "name": "衣物店家",
                    "telphone": "0966 834 114",
                    "phone": "0966 834 114",
                    "address": "台中市西屯區慶和街75號",
                    "business_hours": "15:00:00 ~ 01:00:00",
                    "business_hours_start_time": "3:00 PM",
                    "business_hours_end_time": "1:00 AM",
                    "closed_day": "[]",
                    "special": 1,
                    "status": 1,
                    "i_pass": 0,
                    "area_id": 6,
                    "shop_type": 2,
                    "sub": {
                        "user_id": 4,
                        "shop_id": 2
                    }
                }
            ]
        }
    }

#### 收藏店家

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/addFavorite    |              |                                       |
| <b>方法</b>               | POST                         |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | shop_id                      |              | 商家 id                               |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

    {
        "data": true
    }
    
#### 移除店家

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/decFavorite    |              |                                       |
| <b>方法</b>               | POST                         |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | shop_id                      |              | 商家 id                               |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

    {
        "data": true
    }

#### 驚喜收藏列表

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/surprise/index      |              |                                       |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

    {
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 3,
                    "surprise_box_id": 2,
                    "name": "測試三",
                    "description": "測試三描述",
                    "expiration": null,
                    "deleted_at": null,
                    "pivot": {
                        "user_id": 4,
                        "surprise_item_id": 3,
                        "created_at": "2018-02-09 20:13:32",
                        "updated_at": "2018-02-09 20:13:32",
                        "id": 50,
                        "used": 0,
                        "expiration_date_time": null,
                        "manufacture": 1518105600
                    }
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/surprise/index?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/surprise/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/surprise/index",
            "per_page": 10,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        }
    }


#### 抽驚喜

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/surprise/lucky      |              |                                       |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>ErrorCode</b>          |                              |              |                                       |
|                           | SURPRISE_USED_LUCKY          | integer      | 60001                                 |

> 回應

    {
        "data": true
    }
    
#### 使用驚喜收藏

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/surprise/used       |              |                                       |
| <b>方法</b>               | POST                         |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | id                           |              | 驚喜收藏的id                          |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>ErrorCode</b>          |                              |              |                                       |
|                           | SURPRISE_EXPIRED             | integer      | 60002                                 |

> 回應

    {
        "data": true
    }
    
#### 獲得線上預訂列表

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/reservation/index   |              |                                       |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

#### 參數說明
| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
|                           | nick_name                  | string       | 預定時的名稱                          |
|                           | phone                      | string       | 預定時的手機                          |
|                           | reservation_time           | integer      | 預約時間                              |
|                           | number_of_people           | integer      | 預約人數                              |
|                           | applied                    | integer      | 預約是否成立 0:尚未, 1:完成           |
|                           | shop                       | array        | 被預約的商家資訊                      |

> 回應

    {
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "shop_id": 2,
                    "account_id": 4,
                    "account": "tuohoi87",
                    "nick_name": "陳建銘",
                    "phone": "0999999999",
                    "reservation_time": 1518564300,
                    "number_of_people": 2,
                    "applied": 1,
                    "created_at": "2018-02-09 22:28:46",
                    "updated_at": "2018-02-09 22:30:13",
                    "shop": {
                        "id": 2,
                        "name": "衣物店家",
                        "telphone": "0966 834 114",
                        "phone": "0966 834 114",
                        "address": "台中市西屯區慶和街75號",
                        "business_hours": "15:00:00 ~ 01:00:00",
                        "business_hours_start_time": "3:00 PM",
                        "business_hours_end_time": "1:00 AM",
                        "closed_day": "[]",
                        "special": 1,
                        "status": 1,
                        "i_pass": 0,
                        "area_id": 6,
                        "shop_type": 2
                    }
                }
            ],
            "first_page_url": "http://7e.net/api/1.0/reservation/index?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://7e.net/api/1.0/reservation/index?page=1",
            "next_page_url": null,
            "path": "http://7e.net/api/1.0/reservation/index",
            "per_page": 35,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        }
    }

#### 獲得線上預訂列表

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/reservation/send    |              |                                       |
| <b>方法</b>               | POST                         |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | shop_id                      | integer      | 被預訂的商家id                        |
|                           | nick_name                    | string       | 預定的名字                            |
|                           | phone                        | string       | 手機                                  |
|                           | reservation_time             | unix time    | 預約時間                              |
|                           | number_of_people             | integer      | 預約人數                              |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

    {
        "data": true
    }

#### 針對指定店家增加人氣

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/shop/measurement    |              |                                       |
| <b>方法</b>               | GET                          |              |                                       |
| <b>權限</b>               | 檢視                         |              | READ                                  |
| <b>必填參數</b>           |                              |              |                                       |
|                           | id                           | integer      | 商家id                                |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

> 回應

    {
        "data": true
    }




#### 語系附件

| 項目                      | 內容                         | 類型         | 說明                                  |
|---------------------------|------------------------------|--------------|---------------------------------------|
| <b>變數</b>               | language                     | string       | 語系code                              |
|                           | zh-TW                        |              | 繁中                                  |
|                           | en                           |              | 英文                                  |

####
