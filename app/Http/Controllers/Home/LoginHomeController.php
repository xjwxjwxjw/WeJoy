<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginHomeController extends Controller
{

  // 显示首页内容
    public function index()
    {
        return view('home.index');
    }

//    登陆
    public  function doLogin(Request $request)
  {
//      验证 用户名 密码 激活 不存在则验证 手机 不存在则验证 邮箱
//      即 用于验证用户名 或 手机 或 邮箱 登陆
      $loginUser = DB::table('homeuser')
          ->where('password',md5($request->password))
          ->where('is_confirmed','1')
          ->where('name',$request->username)->get();
      if (!sizeof($loginUser)){
          $loginUser = DB::table('homeuser')
              ->where('password',md5($request->password))
              ->where('is_confirmed','1')
              ->where('phone',$request->username)->get();
      }
      if (!sizeof($loginUser)){
          $loginUser = DB::table('homeuser')
              ->where('password',md5($request->password))
              ->where('is_confirmed','1')
              ->where('email',$request->username)->get();
      }
//      判断是否有数据   有 则返回数据  没有  则登陆失败
      if (!sizeof($loginUser)){
         echo false;
         exit;
      }
      Session::put('UserId', $loginUser[0]->id);
      Session::put('UserNickname', $loginUser[0]->name);
//      $_SESSION['UserId'] = $loginUser[0]->id;
      $loginUser = json_encode($loginUser);
      echo $loginUser;
  }



//    退出登录
      public function doLogout(){
          Session::forget('UserId');
          Session::forget('UserNickname');
          return redirect('/home/index');
      }


}
