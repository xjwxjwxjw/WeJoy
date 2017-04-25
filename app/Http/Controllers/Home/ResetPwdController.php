<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetPwdController extends Controller
{
    public function index(Request $request){
        $resetuser = DB::table('homeuser')->where('name',$request->all()['name'])->first();
        if(empty($resetuser->email) || $resetuser->email == '' || $resetuser->email == null){
//              无数据
            echo 0;//说明无邮箱，重置失败
            return;
        }
        $confirmed_code = 'resetpassword'.str_random(11);
        $data = [
            'confirmed_code' =>$confirmed_code,
        ];
        DB::table('homeuser')->where('name',$request->all()['name'])->update($data);
        $view = 'home.resetpwd';
        $subject = '请验证邮箱';
        $this->sendEmail($resetuser,$view, $subject, $data);
        echo 1;
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
        DB::table('homeuser')->where('confirmed_code',$code)
            ->update(['confirmed_code'=>'aa','is_confirmed'=>1,'password'=>md5('123456')]);
        return redirect('home/index');
    }


}
