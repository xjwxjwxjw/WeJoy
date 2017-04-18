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

//权限管理中间件
Route::group(['middleware'=>'rbac','prefix' => 'admin', 'namespace' => 'Admin'],function(){
    //Route::get('admin/permission/role','Admin\RoleController@roleList');
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
    Route::group(['prefix' => 'adminuser'], function () {
        Route::any('/user-add', 'UserController@userAdd');
        Route::any('/attach-role/{id}', 'UserController@attachRole');
    });
  });

});
//管理员列表
 Route::get('/admin/permission/adminuser', 'Admin\UserController@userList');
// 后台路由
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('index','IndexController@index');

	// 信息
	Route::get('new','NewsController@newsIndex');
	Route::group(['prefix' => 'new'], function () {
		Route::get('delete','NewsController@delete');
    Route::get('edit','NewsController@edit');
	});


	// 用户
	Route::get('user', 'HomeUserController@index');
	Route::group(['prefix' => 'user'], function () {
		Route::post('doAdd', 'HomeUserController@add');
    	Route::get('doDel/{id}', 'HomeUserController@del');
    	Route::get('doFind/{id}', 'HomeUserController@find');
    	Route::post('doEdit/{id}', 'HomeUserController@edit');
	});
});

Route::get('home/weather','Home\ApiController@weather');

// 前台路由
Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
  Route::get('index','LoginHomeController@index');
  Route::post('index/doLogin','LoginHomeController@doLogin');
    Route::get('user','UserController@index');
    Route::get('addFans','UserController@addFans');
  Route::get('index/doLogout', 'LoginHomeController@doLogout');
  Route::get('registersuccess', function (){return view('home.registersuccess');});
  Route::get('register', function (){return view('home.register');});
  Route::post('index/doRegister', 'LoginHomeController@store');
  Route::get('verify/{confirmed_code}', 'LoginHomeController@emailConfirm');
  Route::any('content','ContentController@contentAdd');
  Route::get('contentIndex','ContentController@contentFind');
  Route::get('contentComment','ContentController@publishComments');
  Route::post('contentIssue','ContentController@publishIssue');
  Route::get('contentPos','ContentController@contentPos');
  Route::get('contentGood','ContentController@contentGood');
  Route::get('contentFindcollect','ContentController@contentFindcollect');

 //	用户路由
 Route::group(['prefix'=>'user'],function(){
       Route::get('index','UserController@index');
       Route::get('info','UserController@info');
     Route::post('edit','UserController@edit');
     Route::post('editIcon','UserController@editIcon');
    });
    Route::get('user/{id}','UserController@lookIndex');

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
Route::post('home/store','Home\LoginController@store');
Route::get('verify/{confirmed_code}', 'Home\LoginController@emailConfirm');
Route::get('home/login','Home\LoginController@login');
Route::post('home/singin', 'Home\LoginController@singin');
Route::get('home/logout', 'Home\LoginController@logout');
