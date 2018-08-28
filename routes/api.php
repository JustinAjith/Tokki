<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'Web'], function($routes){
    $routes->group(['prefix'=>'web-home', 'namespace'=>'Home'], function($routes){
        $routes->get('/new-products', 'HomeController@newProduct');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
