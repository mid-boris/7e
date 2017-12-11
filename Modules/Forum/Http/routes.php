<?php

Route::group(['middleware' => 'web', 'prefix' => 'forum', 'namespace' => 'Modules\Forum\Http\Controllers'], function()
{
    Route::get('/', 'ForumController@index');
});
