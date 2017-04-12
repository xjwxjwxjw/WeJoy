<?php

namespace App\Http\Controllers\Home;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //存储注册信息
    public function store(UserRegisterRequest $request)
    {
        $confirmed_code = str_random(10);
        $data = [
            'icon'=>'home/image/default.jpg',
            'confirmed_code' =>$confirmed_code,
        ];

        $user = User::create(array_merge($request->all(), $data));

        $view = 'home.emailConfirmed';
        $subject = '请验证邮箱';
        $this->sendEmail($user,$view, $subject, $data);
        return redirect('/home/index');
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
        $user = User::where('confirmed_code', $code)->first();
        if (is_null($user)) {
            return redirect('/admin/index');
        }
        $user->confirmed_code = str_random(10);
        $user->is_confirmed = 1;
        $user->save();
        return redirect('/home/login');
    }

    //登录界面
    public function login()
    {
        return view("home.login");
    }
    public function register()
    {
        return redirect('/home/login#toregister');
    }
    //登录验证
    public function singin(UserLoginRequest $request)
    {
     $a=Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'is_confirmed'=>1]);
        if($a){
        return redirect('/home/index');
        }else{
        return redirect('/home/login');
        }

    }
    //退出登录
    public function logout(){
        Auth::logout();
        return redirect('/home/index');
    }

}
