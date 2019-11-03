<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category', function(){
    return view('category');
});

//API
Route::group(['prefix'=>'api'], function(){
    Route::post('category/add','API\CategoryController@add');
    Route::get('category/list','API\CategoryController@list');
    Route::get('category/available','API\CategoryController@available');
    Route::post('category/change-status','API\CategoryController@change_status');

    Route::post('product/create','API\ProductController@create');
    Route::get('product/list','API\ProductController@list');
    Route::post('product/change-status','API\ProductController@change_status');
    Route::get('product/visible','API\ProductController@visible');
});

Route::get('/product', function(){
    return view('product');
});
