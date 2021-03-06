<?php

Route::group(['middleware' => 'api'], function () {
    //-------------------------------------------------//
    //                   版面呈現
    //-------------------------------------------------//
    Route::group([
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        Route::get('/', 'TemplateController@index');
        Route::get('/login', 'TemplateController@login');

        // test
        Route::get('/test', 'TemplateController@test');

        Route::group(['middleware' => 'login'], function () {
            Route::get('/home', 'TemplateController@home');
        });
        Route::group(['middleware' => 'permission'], function () {
            // 權限設定
            Route::get('/permission', 'TemplateController@permission');
            Route::get('/account', 'TemplateController@account');
            Route::get('/role', 'TemplateController@role');
            Route::get('/area', 'TemplateController@area');
            Route::get('/shop', 'TemplateController@shop');
            Route::get('/shopImages', 'TemplateController@shopImages');
            Route::get('/menu', 'TemplateController@menu');
            Route::get('/forum', 'TemplateController@forum');
            Route::get('/article', 'TemplateController@article');
            Route::get('/article_audit', 'TemplateController@articleAudit');
            Route::get('/message', 'TemplateController@message');
            Route::get('/announcement', 'TemplateController@announcement');
            Route::get('/discount', 'TemplateController@discount');
            Route::get('/surpriseBox', 'TemplateController@surpriseBox');
            Route::get('/surpriseItem', 'TemplateController@surpriseItem');
            Route::get('/reservation', 'TemplateController@reservation');
            Route::get('/board_analysis', 'TemplateController@boardAnalysis');
            Route::get('/board_analysis_month', 'TemplateController@boardAnalysisMonth');
            Route::get('/board_analysis_three_month', 'TemplateController@boardAnalysisThreeMonth');
            Route::get('/shop_analysis', 'TemplateController@shopAnalysis');
            Route::get('/shop_analysis_month', 'TemplateController@shopAnalysisMonth');
            Route::get('/shop_analysis_three_month', 'TemplateController@shopAnalysisThreeMonth');
            Route::get('/push', 'TemplateController@push');

            //資料呈現
            Route::get('/vote', 'TemplateController@vote');
            Route::get('/board', 'TemplateController@board');
        });
    });

    //-------------------------------------------------//
    //                   資料處理
    //-------------------------------------------------//
    Route::group([
        'prefix' => 'entrust',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 不需要權限的入口 */
        Route::post('login', 'EntrustController@login');
        Route::get('logout', 'EntrustController@logout');
    });

    Route::group([
        'prefix' => 'account',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 權限設定
            Route::post('create', 'AccountController@create');
            Route::post('update', 'AccountController@update');
        });
    });

    Route::group([
        'prefix' => 'role',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 權限設定
            Route::post('create', 'RoleController@create');
            Route::post('update', 'RoleController@update');
            Route::get('delete', 'RoleController@delete');
        });
    });

    Route::group([
        'prefix' => 'area',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'AreaController@create');
            Route::post('update', 'AreaController@update');
            Route::get('delete', 'AreaController@delete');
        });
    });

    Route::group([
        'prefix' => 'shop',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'ShopController@create');
            Route::post('update', 'ShopController@update');
            Route::get('delete', 'ShopController@delete');
            Route::post('tradeMark/create', 'ShopController@trademarkUpload');
            Route::post('preview/create', 'ShopController@previewUpload');
            Route::post('qrcode/create', 'ShopController@makeQRCode');
        });
    });

    Route::group([
        'prefix' => 'image',
        'namespace' => 'Modules\Image\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::get('destroy', 'ImageController@destroy');
        });
    });

    Route::group([
        'prefix' => 'menu',
        'namespace' => 'Modules\Menu\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'MenuController@create');
            Route::post('update', 'MenuController@update');
            Route::get('delete', 'MenuController@delete');
        });
    });

    Route::group([
        'prefix' => 'forum',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'ForumController@create');
            Route::post('update', 'ForumController@update');
            Route::get('delete', 'ForumController@delete');
        });
    });

    Route::group([
        'prefix' => 'article',
        'namespace' => 'Modules\Forum\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'ArticleController@create');
            Route::post('update', 'ArticleController@update');
            Route::get('delete', 'ArticleController@delete');
        });
    });

    Route::group([
        'prefix' => 'article_audit',
        'namespace' => 'Modules\Forum\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('auditPass', 'ArticleController@auditPass');
            Route::get('delete', 'ArticleController@delete');
        });
    });

    Route::group([
        'prefix' => 'vote',
        'namespace' => 'Modules\Forum\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('add', 'VoteController@add');
        });
    });

    // 客服信件
    Route::group([
        'prefix' => 'message',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'MessageController@create');
        });
    });

    // 公告
    Route::group([
        'prefix' => 'announcement',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'AnnouncementController@create');
            Route::post('update', 'AnnouncementController@update');
            Route::get('delete', 'AnnouncementController@delete');
        });
    });

    Route::group([
        'prefix' => 'discount',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'DiscountController@create');
            Route::post('update', 'DiscountController@update');
            Route::get('delete', 'DiscountController@delete');
        });
    });

    Route::group([
        'prefix' => 'surpriseBox',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'SurpriseBoxController@create');
            Route::post('update', 'SurpriseBoxController@update');
            Route::get('delete', 'SurpriseBoxController@delete');
        });
    });

    Route::group([
        'prefix' => 'surpriseItem',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'SurpriseItemController@create');
            Route::post('update', 'SurpriseItemController@update');
            Route::get('delete', 'SurpriseItemController@delete');
        });
    });

    Route::group([
        'prefix' => 'reservation',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::get('applied', 'ReservationController@applied');
            Route::get('delete', 'ReservationController@delete');
        });
    });

    Route::group([
        'prefix' => 'push',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            Route::post('create', 'PushController@create');
        });
    });


    //-------------------------------------------------//
    //                 ajax 資料處理
    //-------------------------------------------------//
    Route::group([
        'prefix' => 'api/system',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 權限設定
            Route::post('permission/update', 'SystemController@permissionUpdate');
        });
    });

    Route::group([
        'prefix' => 'api/area',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 地區搜尋
            Route::post('search/fuzzy', 'AreaController@getByNameWithParentData');
        });
    });

    Route::group([
        'prefix' => 'api/shop',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 地址查詢 by google map
            Route::post('map', 'ShopController@mapInfo');
        });
    });

    Route::group([
        'prefix' => 'api/article',
        'namespace' => 'Modules\Forum\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 獲得審核數
            Route::get('audit/count', 'ArticleController@auditCount');
        });
    });

    Route::group([
        'prefix' => 'api/announcement',
        'namespace' => 'Modules\Template\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 地區搜尋
            Route::post('shop/fuzzy', 'AnnouncementController@shopSearch');
        });
    });
});
