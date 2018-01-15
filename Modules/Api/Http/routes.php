<?php
Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::group(['prefix' => '1.0'], function () {
        Route::group(['namespace' => 'Modules\Api\Http\Controllers'], function () {
            // login, logout
            Route::post('/login', 'ApiController@remoteLogin');
            Route::get('/logout', 'ApiController@logout');
            Route::get('/isLogin', 'ApiController@isLogin');

            Route::group(['middleware' => 'permission'], function () {
                // 獲得地區
                Route::get('/area/index', 'AreaController@index');

                // 編輯會員資料
                Route::post('/user/edit', 'UserController@edit');

                // 留言版
                Route::group(['prefix' => 'forum'], function () {
                    Route::get('vote', 'ForumController@vote');
                    Route::get('board', 'ForumController@board');
                });

                // 文章
                Route::group(['prefix' => 'article'], function () {
                    Route::get('index', 'ArticleController@index');
                    Route::get('show', 'ArticleController@show');
                    Route::post('create', 'ArticleController@create');
                });

                // 投票
                Route::group(['prefix' => 'vote'], function () {
                    Route::post('add', 'VoteController@add');
                });

                // 聯絡客服
                Route::group([
                    'prefix' => 'message'
                ], function () {
                    Route::get('index', 'MessageController@list');
                    Route::post('create', 'MessageController@create');
                });
            });
        });
    });
});
