<?php

Route::group(['middleware' => 'api' ,"namespace" => "Bdwey\Specs\Http\Controllers"],function () {
    Route::get('/api/getspecs/{spec}', 'SpecsController@index');
});