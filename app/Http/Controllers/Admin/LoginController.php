<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Logincontroller extends Controller
{
    public function login()
    {

        return view('admin.login');
    }

    public function logout()
    {
        Session::flush();
        return view('admin.login');
    }
    //登陆验证
    public function showlogin(Request $request)
    {

        $rules = array(
            'name'=>'required',
            'password'=>'required',
        );
        $message = array(
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        );
        $this->validate($request,$rules,$message);

        $name=$request->input('name');
        $password=$request->input('password');
        $result=DB::table('users')->where('name',$name)
                                ->where('password',$password)
                                ->get();
        $id=DB::table('users')->where('name',$name)
                                ->where('password',$password)
                                ->value('id');
        if(!empty($result->all())) {
            Session::put('id',$id);
            Session::put('name',$name);
            return redirect('admin/index');

        }else{
            return redirect('admin/login')->with('message', '用户名或密码错误');

        }

    }

}

