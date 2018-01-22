<?php

Route::group(['prefix' => 'remotesystem', 'namespace' => 'Modules\RemoteSystem\Http\Controllers'], function() {
    Route::get('/', 'RemoteSystemController@index');
});
