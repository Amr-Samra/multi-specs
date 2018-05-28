<?php

Route::group(['middleware' => 'guest' ,"namespace" => "Bdwey\Specs\Http"],function () {

    Route::get('/tests', 'SpecsController@index');
    // Route::get('/categories/specs/{category}/', ['as' => 'categories.specs' , 'uses' => 'SpecsApiController@getSpecs']);
});