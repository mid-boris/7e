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
            Route::get('/menu', 'TemplateController@menu');
            Route::get('/forum', 'TemplateController@forum');
            Route::get('/article', 'TemplateController@article');
            Route::get('/article_audit', 'TemplateController@articleAudit');

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
        'prefix' => 'api/article',
        'namespace' => 'Modules\Forum\Http\Controllers'
    ], function () {
        /* 需完整權限 (登入、角色的節點權限) */
        Route::group(['middleware' => 'permission',], function () {
            // 獲得審核數
            Route::get('audit/count', 'ArticleController@auditCount');
        });
    });
});
