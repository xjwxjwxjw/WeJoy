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
<<<<<<< HEAD
    return view('welcome');
});
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/login','Admin\LoginController@showlogin');
=======
    return view('/welcome');
});

// 控制器
Route::get('/admin/index','Admin\IndexController@index');
Route::get('/admin/myIndex','Admin\IndexController@myIndex');
Route::get('/admin/myIndex/del/{id?}','Admin\IndexController@myDel');
>>>>>>> d5738c0f965f8c0a6fa27c702ae0e7d8e28f781a
