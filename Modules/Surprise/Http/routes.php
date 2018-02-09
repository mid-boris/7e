<?php

Route::group(['middleware' => 'web', 'prefix' => 'surprise', 'namespace' => 'Modules\Surprise\Http\Controllers'], function()
{
    Route::get('/', 'SurpriseController@index');
});
