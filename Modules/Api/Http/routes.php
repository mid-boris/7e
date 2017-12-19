<?php
Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::group(['prefix' => '1.0'], function () {
        Route::group(['namespace' => 'Modules\Api\Http\Controllers'], function () {
            // login, logout
            Route::post('/login', 'ApiController@login');
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
                    Route::get('show', 'ArticleController@show');
                });
            });
        });
    });
});
