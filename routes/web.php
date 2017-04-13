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

    //  权限
  Route::group(['prefix' => 'permission'], function () {
    Route::get('permission','PermissionController@permissionList');
    Route::group(['prefix' => 'permission'], function () {
        Route::any('/permission-add', 'PermissionController@permissionAdd');
        Route::any('/permission-update/{id}', 'PermissionController@permissionUpdate');
        Route::get('/permission-delete/{id}', 'PermissionController@permissionDelete');
        Route::get('/permissionfind/{id}', 'PermissionController@permissionfind');
    });
    //  角色
    Route::get('/role', 'RoleController@roleList');
    Route::group(['prefix' => 'role'], function () {
        Route::any('/role-add', 'RoleController@roleAdd');
        Route::any('/role-update/{id}', 'RoleController@roleUpdate');
        Route::get('/role-delete/{id}', 'RoleController@roleDelete');
        Route::any('/rolefind/{id}', 'RoleController@rolefind');
        Route::any('/attach-permission/{id}', 'RoleController@attachPermission');
    });
    //管理员管理
    Route::get('/adminuser', 'UserController@userList');
    Route::group(['prefix' => 'adminuser'], function () {
        Route::any('/user-add', 'UserController@userAdd');
        Route::any('/attach-role/{id}', 'UserController@attachRole');
    });
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
	Route::get('user','UserController@index');
// //	用户路由
// 	Route::group(['prefix'=>'user'],function(){
// 	    Route::get('index','UserController@index');
//     });

});
