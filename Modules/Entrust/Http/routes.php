<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::group(['prefix' => '1.0'], function () {
        Route::group([
            'prefix' => 'entrust',
            'namespace' => 'Modules\Entrust\Http\Controllers'
        ], function () {
            /* 不需要權限的入口 */
            Route::post('login', 'EntrustController@login');
            Route::get('logout', 'EntrustController@logout');
            Route::get('isLogin', 'EntrustController@isLogin');

            /* 需完整權限 (登入、角色的節點權限) */
            Route::group(['middleware' => 'permission',], function () {
                Route::get('test', 'TestController@index');
            });
        });

        Route::group([
            'prefix' => 'node',
            'namespace' => 'Modules\Entrust\Http\Controllers'
        ], function () {
            /* 需登入的權限 */
            Route::group(['middleware' => 'login',], function () {
                Route::get('list', 'NodeController@index');
            });
        });
    });
});
