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
    return view('/welcome');
});

// 控制器
Route::get('/admin/index','Admin\IndexController@index');
Route::get('/admin/newsIndex','Admin\NewsController@newsIndex');
Route::get('/admin/newsIndex/delete/{id}','Admin\NewsController@delete');
Route::get('/admin/newsIndex/edit/{id}','Admin\NewsController@edit');

Route::get('/home/index','Home\IndexController@index');
