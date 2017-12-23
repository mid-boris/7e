<?php

Route::group(['middleware' => 'web', 'prefix' => 'sort', 'namespace' => 'Modules\Sort\Http\Controllers'], function()
{
    Route::get('/', 'SortController@index');
});
