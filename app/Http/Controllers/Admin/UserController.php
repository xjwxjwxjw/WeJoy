<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $result = DB::select('select * from user');
        return view('admin.user.index', compact('result'));
    }
    //    添加用户
    public function add(Request $request)
    {
//        判断上传图片且不出错 则上传
        if ($request->hasFile('icon') && $request->file('icon')->isValid()){
            $iconname = $request->file('icon')->store('image');
        }
        $_POST['icon'] = empty($iconname)?'':$iconname;
        $_POST['status'] = 1;
        $arr = array();
        foreach ($_POST as $k=>$v){
            if ($k == '_token' || $k == 'password_confirmation' || $v == ''){
                continue;
            }
            if ($k == 'password'){
                $arr['pwd'] = md5($v);
                continue;
            }
            $arr[$k] = $v;
        }
        $arr['regtime'] = time();
        $result = DB::table('user')->insert($arr);
        if ($result){
            return redirect('admin/user');
        }else{
            return back()->withErrors('添加失败');
        }
    }
    //    删除用户
    public function del($id)
    {
        $result = DB::delete('delete from user where id=?',[$id]);
        if ($result){
            return $this->index();
            exit;
        }else{
            return back();
        }
    }
    //    查找被修改的用户信息
    public function find($id)
    {
        $result = DB::select('select * from user where id='.$id);
        $data = json_encode($result);
        echo $data;
    }
    //    确认修改
    public function edit(Request $request,$id)
    {
        // 判断上传图片且不出错 则上传
        if ($request->hasFile('icon') && $request->file('icon')->isValid()){
            $iconname = $request->file('icon')->store('image');
        }
        $_POST['icon'] = empty($iconname)?'':$iconname;
        $_POST['status'] = 1;
        $arr = array();
        foreach ($_POST as $k=>$v){
            if ($k == '_token' || $v == ''){
                continue;
            }
            $arr[$k] = $v;
        }
        $arr['regtime'] = time();
        $result = DB::table('user')->where('id',$id)->update($arr);
        if ($result){
            return redirect('admin/user');
        }else{
            return back()->withErrors('修改失败');
        }
    }
}
