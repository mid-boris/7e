<?php

Route::group(['middleware' => 'web', 'prefix' => 'remotesystem', 'namespace' => 'Modules\RemoteSystem\Http\Controllers'], function()
{
    Route::get('/', 'RemoteSystemController@index');
});
