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
//后台登陆控制器
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/login','Admin\LoginController@showlogin');

// 后台除登陆控制器
Route::group(['middleware'=>'check.login'],function(){
    Route::get('/admin/index','Admin\IndexController@index');
    Route::get('/admin/myIndex','Admin\IndexController@myIndex');
    Route::get('/admin/myIndex/del/{id?}','Admin\IndexController@myDel');
});

Route::get('home/login','Home\LoginController@login');

