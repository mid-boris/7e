## Api Response

> HTTP status code

收到 Response 時, 請先確認 HTTP status code 是否為 200, 不為 200 時代表發生非預期錯誤.
請參考[網路狀態碼](https://en.wikipedia.org/wiki/List_of_HTTP_status_codes)

> Header

該筆回傳是否成功的 code 在 header 裡, 
當 code 為 0 時即為成功響應, 其餘請參考[錯誤碼](https://github.com/mid-boris/7e/blob/master/ErrorCode.md)

    code → 0

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
            "children_count": 1
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

> 回應

    {
        "current_page": 1,
        "data": [
            {
                "id": 3,
                "parent_id": 2,
                "name": "投票專區一",
                "audit": 1,
                "status": 1,
                "sort": 0
            },
            {
                "id": 4,
                "parent_id": 2,
                "name": "投票專區二",
                "audit": 0,
                "status": 1,
                "sort": 0
            }
        ],
        "first_page_url": "http://7e.net/api/1.0/forum/vote?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://7e.net/api/1.0/forum/vote?page=1",
        "next_page_url": null,
        "path": "http://7e.net/api/1.0/forum/vote",
        "per_page": 35,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }

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
        "current_page": 1,
        "data": [
            {
                "id": 3,
                "parent_id": 2,
                "name": "投票專區一",
                "audit": 1,
                "status": 1,
                "sort": 0
            },
            {
                "id": 4,
                "parent_id": 2,
                "name": "投票專區二",
                "audit": 0,
                "status": 1,
                "sort": 0
            }
        ],
        "first_page_url": "http://7e.net/api/1.0/forum/vote?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://7e.net/api/1.0/forum/vote?page=1",
        "next_page_url": null,
        "path": "http://7e.net/api/1.0/forum/vote",
        "per_page": 35,
        "prev_page_url": null,
        "to": 2,
        "total": 2
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

#### 發文、回文

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/article/create    |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
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

> 回應

    {
        "data": true
    }


#### 投票

| 項目                      | 內容                       | 類型         | 說明                                  |
|---------------------------|----------------------------|--------------|---------------------------------------|
| <b>路徑</b>               | /api/1.0/vote/add          |              |                                       |
| <b>方法</b>               | POST                       |              |                                       |
| <b>權限</b>               | 檢視                       |              | READ                                  |
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
|                           | 無                           |              |                                       |
| <b>選填參數</b>           |                              |              |                                       |
|                           | 無                           |              |                                       |

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
|                           | shop_lat                   | float        | 經度                                  |
|                           | shop_lng                   | float        | 緯度                                  |
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
                    "shop_lat": 24.18,
                    "shop_lng": 120.65,
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
                    "shop_lat": 24.15,
                    "shop_lng": 120.66,
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


#### 
