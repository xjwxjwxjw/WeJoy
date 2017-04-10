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

// 控制器
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('user', 'UserController@index');
    Route::post('user/doAdd', 'UserController@add');
    Route::get('user/doDel/{id}', 'UserController@del');
    Route::get('user/doFind/{id}', 'UserController@find');
    Route::post('user/doEdit/{id}', 'UserController@edit');
});
