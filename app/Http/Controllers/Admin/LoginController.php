<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Logincontroller extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    //登陆验证
    public function showlogin(Request $request)
    {

        $rules = array(
            'username'=>'required',
            'password'=>'required',
        );
        $message = array(
            'useername.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        );
        $this->validate($request,$rules,$message);

        $username=$request->input('username');
        $password=$request->input('password');
        $result=DB::table('VIP')->where('username',$username)
                                ->where('password',$password)
                                ->get();

        if(!empty($result->all())) {
            return redirect('/');

        }else{
            return redirect('admin/login');
        }

    }
}

