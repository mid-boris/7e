<?php

Route::group(['middleware' => 'web', 'prefix' => 'adminlte', 'namespace' => 'Modules\AdminLTE\Http\Controllers'], function()
{
    Route::get('/', 'AdminLTEController@index');
});
