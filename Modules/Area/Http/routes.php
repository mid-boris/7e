<?php

Route::group(['middleware' => 'web', 'prefix' => 'area', 'namespace' => 'Modules\Area\Http\Controllers'], function()
{
    Route::get('/', 'AreaController@index');
});
