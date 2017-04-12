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

// 后台路由
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('index','IndexController@index');

	// 信息
	Route::get('new','NewsController@newsIndex');
	Route::group(['prefix' => 'new'], function () {
		Route::get('delete/{id}','NewsController@delete');
		Route::get('edit/{id}','NewsController@edit');
	});

	// 用户
	Route::get('user', 'UserController@index');
	Route::group(['prefix' => 'user'], function () {
		Route::post('doAdd', 'UserController@add');
    	Route::get('doDel/{id}', 'UserController@del');
    	Route::get('doFind/{id}', 'UserController@find');
    	Route::post('doEdit/{id}', 'UserController@edit');
	});
});

// 前台路由
Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
	Route::get('index','IndexController@index');
});
//后台登陆控制器
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/login','Admin\LoginController@showlogin');

//// 后台除登陆控制器
//Route::group(['middleware'=>'check.login'],function(){
//	Route::get('/admin/index','Admin\IndexController@index');
//	Route::get('/admin/myIndex','Admin\IndexController@myIndex');
//	Route::get('/admin/myIndex/del/{id?}','Admin\IndexController@myDel');
//});

//前台登陆注册
Route::get('home/register','Home\LoginController@register');
Route::post('home/store','Home\LoginController@store');
Route::get('verify/{confirmed_code}', 'Home\LoginController@emailConfirm');
Route::get('home/login','Home\LoginController@login');
Route::post('home/singin', 'Home\LoginController@singin');