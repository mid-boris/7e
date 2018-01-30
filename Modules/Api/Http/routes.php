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

                // 獲得商家
                Route::group([
                    'prefix' => 'shop'
                ], function () {
                    Route::get('index', 'ShopController@index');
                    Route::get('food', 'ShopController@food');
                    Route::get('clothing', 'ShopController@clothing');
                    Route::get('housing', 'ShopController@housing');
                    Route::get('transportation', 'ShopController@transportation');
                    Route::get('education', 'ShopController@education');
                    Route::get('entertainment', 'ShopController@entertainment');
                });

                // 附近商家
                Route::group([
                    'prefix' => 'nearbyShop'
                ], function () {
                    Route::post('index', 'NearByShopController@index');
                    Route::post('food', 'NearByShopController@food');
                    Route::post('clothing', 'NearByShopController@clothing');
                    Route::post('housing', 'NearByShopController@housing');
                    Route::post('transportation', 'NearByShopController@transportation');
                    Route::post('education', 'NearByShopController@education');
                    Route::post('entertainment', 'NearByShopController@entertainment');
                });
            });
        });
    });
});
