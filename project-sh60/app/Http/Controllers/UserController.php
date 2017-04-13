<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Permission;
use App\Role;
use App\Tool\Result;
use App\Tool\SMS\SendTemplateSMS;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    //显示注册表单
    public function register()
    {
        return view('home.register');
    }

    //保存用户的信息
    public function store(UserRegisterRequest $request)
    {
        //dd($request->all());
        $confirmed_code = str_random(10);
        $data = [
            'avatar'=>'image/default.jpg',
            'confirmed_code' =>$confirmed_code,
        ];
        $user = User::create(array_merge($request->all(), $data));
        //dd($user);
        //发送邮件
        $view = 'home.emailConfirmed';
        $subject = '请验证邮箱';
        $this->sendEmail($user,$view, $subject, $data);
        return redirect('/');
    }

    public function sendEmail($user, $view, $subject, $data)
    {
        Mail::send($view, $data, function ($m) use ($subject,$user) {
            $m->to($user->email)->subject($subject);
        });
    }

    public function emailConfirm($code)
    {
        //dd($code);
        //查询与之匹配的这个用户
        $user = User::where('confirmed_code', $code)->first();
        //dd($user);
        if (is_null($user)) {
            return redirect('/');
        }
        $user->confirmed_code = str_random(10);
        $user->is_confirmed = 1;
        $user->save();
        return redirect('/login');
    }

    //显示登录表单
    public function login()
    {
        return view('home.login');
    }

    //处理登录
    public function singin(UserLoginRequest $request)
    {
        //dd($request->all());
        Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
        //dd($flag);
        return redirect('/');
    }

    //用户注销
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //发送手机验证码
    public function sendSMS()
    {
        $sms = new SendTemplateSMS();
        $result = $sms->sendSMS('15801986376', array('1234', 5), 1);
        //dd($result);

        return $result->toJosn();
    }

    //用户列表
    public function userList()
    {
        $users = User::all();
        foreach ($users as $user) {
            $roles = array();
            foreach ($user->roles as $role) {
                $roles[] = $role->display_name;
            }
            $user->roles= implode(',', $roles);
        }
        return view('admin.userList', compact('users'));
    }
    //添加用户
    public function userAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            User::create(array_merge($request->all(),['avatar'=>'image/default.jpg']));
            return redirect('/user-list');
        }
        return view('admin.userAdd');
    }

    //分配角色
    public function attachRole(Request $request,$user_id)
    {
        if ($request->isMethod('post')) {
            //获取当前用户的角色
            $user = User::find($user_id);
            DB::table('role_user')->where('user_id', $user_id)->delete();
            foreach ($request->input('role_id') as $role_id){
                $user->attachRole(Role::find($role_id));
            }
            return redirect('/user-list');
        }
        //查询所有的权限
        $roles = Role::all();
        return view('admin.attachRole', compact('roles'));
    }
}
