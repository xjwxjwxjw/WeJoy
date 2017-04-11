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
//	用户路由
	Route::group(['prefix'=>'user'],function(){
	    Route::get('index','UserController@index');
    });

});

