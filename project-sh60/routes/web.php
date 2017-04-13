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

Route::get('/', 'IndexController@index');
Route::get('/register', 'UserController@register');
Route::get('/login', 'UserController@login');
Route::post('/singin', 'UserController@singin');
Route::get('/logout', 'UserController@logout');
Route::post('/store', 'UserController@store');
Route::get('/verify/{confirmed_code}', 'UserController@emailConfirm');
Route::get('/sendSMS', 'UserController@sendSMS');
Route::get('/admin/index', 'AdminController@index');

//权限管理
Route::get('/permission-list', 'PermissionController@permissionList');
Route::any('/permission-add', 'PermissionController@permissionAdd');
Route::any('/permission-update/{permission_id}', 'PermissionController@permissionUpdate')->middleware('rbac');
Route::get('/permission-delete/{permission_id}', 'PermissionController@permissionDelete');
//角色管理
Route::get('/role-list', 'RoleController@roleList')->middleware('rbac');
Route::any('/role-add', 'RoleController@roleAdd')->middleware('rbac');
Route::any('/role-update/{role_id}', 'RoleController@roleUpdate')->middleware('rbac');
Route::get('/role-delete/{role_id}', 'RoleController@roleDelete')->middleware('rbac');
Route::any('/attach-permission/{role_id}', 'RoleController@attachPermission')->middleware('rbac');
//管理员管理
Route::get('/user-list', 'UserController@userList')->middleware('rbac');
Route::any('/user-add', 'UserController@userAdd');
Route::any('/attach-role/{user_id}', 'UserController@attachRole');
