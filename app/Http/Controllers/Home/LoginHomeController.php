<?php

namespace App\Http\Controllers\Home;

use App\UserFans;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\User;
use Illuminate\Support\Facades\Cookie;
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
//        $fans = count(UserFans::where('uid',$loginUser[0]->id)->where('status',1)->get());
//        $fansed = count(UserFans::where('uid_ed',$loginUser[0]->id)->where('status',1)->get());
//    $hei = count(UserFans::where('uid',$loginUser[0]->id)->where('status',2)->get());
        Cookie::queue('UserId',$loginUser[0]->id,0);
        Cookie::queue('UserNickname', $loginUser[0]->name,0);
//        Cookie::queue('fans', $fans,0);
//        Cookie::queue('fansed', $fansed,0);
      $loginUser = json_encode($loginUser);
      echo $loginUser;
  }



//    退出登录
      public function doLogout(){
          Cookie::queue('UserId','',-1);
          Cookie::queue('UserNickname','',-1);
          return redirect('/home/index');
      }

      //存储注册信息
      public function store(Request $request)
      {
          $userem = DB::table('homeuser')->where('email',$request->input('email'))->get();
          $userna = DB::table('homeuser')->where('name',$request->input('nickname'))->get();
          if(sizeof($userna)){
//              有数据
              $errors = '用户名已存在';
              return view('/home/index',compact('errors'));
          }
          if(sizeof($userem)){
//              有数据
              $errors = '邮箱已存在';
              return view('/home/index',compact('errors'));
          }

          $arr = array();
          $confirmed_code = str_random(24);
          $data = [
              'confirmed_code' =>$confirmed_code,
              'create_time' => time()
          ];
          foreach ($request->all() as $k => $v){
              if ($k == '_token' || $k == 'password_confirmation'){
                  continue;
              }
              if ($k == 'nickname'){
                  $arr['name'] = $v;
                  continue;
              }
              if ($k == 'password'){
                  $arr[$k] = md5($v);
                  continue;
              }
              $arr[$k] = $v;
          }
          DB::table('homeuser')->insert(array_merge($arr,$data));
          $user = DB::table('homeuser')->orderBy('id','desc')->limit(1)->get()[0];
          DB::table('homeuserinfo')->insert(['uid'=>$user->id]);
          $view = 'home.emailConfirmed';
          $subject = '请验证邮箱';
          $this->sendEmail($user,$view, $subject, $data);
          return redirect('/home/register');
      }
      //发送邮件
      public function sendEmail($user, $view, $subject, $data)
      {
          Mail::send($view, $data, function ($m) use ($subject,$user) {
              $m->to($user->email)->subject($subject);
          });
      }
      //查询与之匹配的这个用户
      public function emailConfirm($code)
      {
          $user = DB::table('homeuser')->where('confirmed_code', $code);
          if (is_null($user)) {
              return redirect('home/index');
          }
          DB::update('update homeuser set confirmed_code="aa",is_confirmed=1 where confirmed_code=?',[$code]);
          return redirect('/home/registersuccess');
      }
















}
