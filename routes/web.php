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

//// 后台除登陆控制器
//Route::group(['middleware'=>'check.login'],function(){
//	Route::get('/admin/index','Admin\IndexController@index');
//	Route::get('/admin/myIndex','Admin\IndexController@myIndex');
//	Route::get('/admin/myIndex/del/{id?}','Admin\IndexController@myDel');
//});

//权限管理中间件
Route::group(['middleware'=>'check.login'],function() {
    Route::group(['middleware' => 'rbac', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
        //Route::get('admin/permission/role','Admin\RoleController@roleList');
        //  权限
        Route::group(['prefix' => 'permission'], function () {
            Route::get('permission', 'PermissionController@permissionList');
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
        Route::get('index', 'IndexController@index');

        // 信息
        Route::get('new', 'NewsController@newsIndex');
        Route::group(['prefix' => 'new'], function () {
            Route::get('delete', 'NewsController@delete');
            Route::get('edit', 'NewsController@edit');
        });
        // 信息
        Route::get('newtype', 'NewtypeController@newsIndex');
        Route::group(['prefix' => 'newtype'], function () {
            Route::post('type-add', 'NewtypeController@typeAdd');
            Route::get('newtype', 'NewtypeController@edit');
            Route::get('delete', 'NewtypeController@delete');
            Route::any('newtype-update/{id}', 'NewtypeController@newtypeUpdate');
            Route::get('newtype/{id}', 'NewtypeController@newtypefind');
        });
        // 友情链接
        Route::get('friendlylink', 'FriendlylinkController@newsIndex');
        Route::group(['prefix' => 'friendlylink'], function () {
            Route::get('delete', 'FriendlylinkController@delete');
            Route::post('friendlylink-add', 'FriendlylinkController@friendlylinkAdd');
            Route::get('friendlylink', 'FriendlylinkController@edit');
            Route::any('friendlylink-update/{id}', 'FriendlylinkController@friendlylinkUpdate');
            Route::get('friendlylink/{id}', 'FriendlylinkController@friendlylinkfind');
        });

        // 广告
        Route::get('advert', 'AdvertController@newsIndex');
        Route::group(['prefix' => 'advert'], function () {
            Route::get('delete', 'AdvertController@delete');
            Route::post('advert-add', 'AdvertController@advertAdd');
            Route::get('advert', 'AdvertController@edit');
            Route::any('advert-update/{id}', 'AdvertController@advertUpdate');
            Route::get('advert/{id}', 'AdvertController@advertfind');
        });

        // 公告
        Route::get('announcement', 'AnnouncementController@newsIndex');
        Route::group(['prefix' => 'announcement'], function () {
            Route::get('delete', 'AnnouncementController@delete');
            Route::post('announcement-add', 'AnnouncementController@advertAdd');
            Route::get('announcement', 'AnnouncementController@edit');
            Route::get('edit', 'AnnouncementController@status');
            Route::any('announcement-update/{id}', 'AnnouncementController@advertUpdate');
            Route::get('announcement/{id}', 'AnnouncementController@advertfind');
        });

        // 用户
        Route::get('user', 'HomeUserController@index');
        Route::group(['prefix' => 'user'], function () {
            Route::post('doAdd', 'HomeUserController@add');
            Route::get('doDel/{id}', 'HomeUserController@del');
            Route::get('doFind/{id}', 'HomeUserController@find');
            Route::post('doEdit/{id}', 'HomeUserController@edit');
            Route::get('changeStatus', 'HomeUserController@changeStatus');
        });
        //关于网站简介的管理
        Route::get('AboutUs','AboutUsController@index');
        Route::post('AboutUsadd','AboutUsController@add');
        Route::get('AboutUsDelete','AboutUsController@delete');
        Route::post('AboutUsUp','AboutUsController@update');
    });
});

//后台登陆控制器
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
    Route::get('login','LoginController@login');
    Route::post('login','LoginController@showlogin');
    Route::get('logout','LoginController@logout');
});

//----------------------前后台-----------------------------
//天气api
Route::get('home/weather','Home\ApiController@weather');

// 前台路由
Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
  Route::get('index','LoginHomeController@index');
  Route::post('index/doLogin','LoginHomeController@doLogin');
  Route::get('user','UserController@index');
  Route::get('addFans','UserController@addFans');
  Route::get('doFans','UserController@doFans');
  Route::get('index/doLogout', 'LoginHomeController@doLogout');
  Route::get('registersuccess', function (){return view('home.registersuccess');});
  Route::get('register', function (){return view('home.register');});
  Route::post('index/doRegister', 'LoginHomeController@store');
  Route::get('verify/{confirmed_code}', 'LoginHomeController@emailConfirm');
  Route::any('content','ContentController@contentAdd');
  Route::get('contentIndex','ContentController@contentFind');
  Route::get('contentComment','ContentController@publishComments');
  Route::post('contentIssue','ContentController@publishIssue');
  Route::post('twocontentIssue','ContentController@twopublishIssue');
  Route::get('contentPos','ContentController@contentPos');
  Route::get('contentGood','ContentController@contentGood');
  Route::get('contentFindcollect','ContentController@contentFindcollect');
  Route::get('contentCount','ContentController@contentCount');
  Route::get('commentdel','ContentController@contentDel');
  Route::post('commentimg','ContentController@contentImg');
  Route::get('contentOnegly','ContentController@oneglyDel');
  Route::post('traform','ContentController@traForm');

    //关于我们
    Route::get('AboutUs','AboutUsController@index');
    Route::get('AboutUsUp','AboutUsController@update');
 //	用户路由
 Route::group(['prefix'=>'user'],function(){
     Route::get('contentPos','ContentController@contentPos');
     Route::get('contentGood','ContentController@contentGood');
     Route::get('contentFindcollect','ContentController@contentFindcollect');
     Route::get('contentCount','ContentController@contentCount');
     Route::get('commentdel','ContentController@contentDel');
     Route::post('commentimg','ContentController@contentImg');
     Route::get('contentOnegly','ContentController@oneglyDel');
     Route::get('contentComment','ContentController@publishComments');
     Route::post('contentIssue','ContentController@publishIssue');
     Route::post('twocontentIssue','ContentController@twopublishIssue');

     Route::get('index','UserController@index');//个人主页
     Route::get('info','UserController@info');//个人信息
     Route::post('edit','UserController@edit');//修改
     Route::post('editIcon','UserController@editIcon');//修改头像
     Route::post('changePwd','UserController@changePwd');//修改头像
     Route::get('photo/{id?}','AlbumController@photo');//相册 有id为他人，没id为自己
     Route::get('editDescription','AlbumController@editDescription');//修改相册描述
     Route::get('editName','AlbumController@editName');//修改相册名字
     Route::post('editPhotoes','InAlbumController@editPhotoes');//修改图片
     Route::get('setFace','InAlbumController@setFace');//修改为封面
     Route::post('addAlbum','AlbumController@addAlbum');//添加相册
     Route::post('addPhoto/{Aid}','InAlbumController@addPhoto');//添加图片
     Route::get('delAlbum','AlbumController@delAlbum');//删除相册
     Route::get('delPhoto','InAlbumController@delPhoto');//删除图片
     Route::get('photos/{uid}/{Aid}','InAlbumController@photo');//相册内图片 有id为他人，没id为自己
     Route::get('photo/my/{Aid}/manage','InAlbumController@manage');//修改自己的相册内图片信息
     Route::get('fans/{id}','UserController@fans');//查看关注(我关注的列表)
     Route::get('fansed/{id}','UserController@fansed');//查看粉丝（关注我的粉丝列表）
     Route::get('black/{id}','UserController@black');//查看黑名单（被我拉黑的人）
     Route::get('fan/{id}','UserController@fan');//查看关注(ta关注的列表)
     Route::get('faned/{id}','UserController@faned');//查看粉丝（关注ta的粉丝列表）
 });
    Route::get('user/{id}','UserController@lookIndex');

});

//前台登陆注册
Route::post('home/store','Home\LoginController@store');
Route::get('verify/{confirmed_code}', 'Home\LoginController@emailConfirm');
Route::get('home/login','Home\LoginController@login');
Route::post('home/singin', 'Home\LoginController@singin');
Route::get('home/logout', 'Home\LoginController@logout');
