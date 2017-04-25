<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class HomeUserController extends Controller
{
    public function index() {
        if( empty($_GET['search']) ){
            $returnuser = DB::table('homeuser')->select('*','homeuser.name as nickname','homeuserinfo.name as truename')
                ->join('homeuserinfo','homeuser.id','=','homeuserinfo.uid')->paginate(5);
            return view('admin.index',['tasks'=>$returnuser , 'content' => '/admin/user/index']);
        } else {
            $search = $_GET['search'];
            $returnuser = DB::table('homeuser')->select('*','homeuser.name as nickname','homeuserinfo.name as truename')
                ->join('homeuserinfo','homeuser.id','=','homeuserinfo.uid')
                ->Where('homeuser.name','like','%'.$search.'%')
                ->orWhere('homeuserinfo.name','like','%'.$search.'%')
                ->orWhere('homeuser.phone','like','%'.$search.'%')
                ->orWhere('homeuser.email','like','%'.$search.'%')
                ->paginate(5);
            $announcement = Announcement::where('status',1)->value('description');
            return view('admin.index',['tasks'=>$returnuser ,'keepsearch'=>$search , 'content' => '/admin/user/index','announcement'=>$announcement]);
        }
    }
    //    添加用户
    public function add(Request $request)
    {
//       判断上传图片且不出错 则上传
        if ($request->hasFile('icon') && $request->file('icon')->isValid()){
            $iconname = $request->file('icon')->store('image');
        }
        $_POST['icon'] = empty($iconname)?'':$iconname;
//        两个空数组 用于存放添加到user表和userinfo的数据
        $toUser = array();
        $toUserinfo = array();
//        遍历将两个表的数据分开   存到上面两个数组中
        foreach ($_POST as $k=>$v){
            if ($k == '_token' || $k == 'password_confirmation' || $v == ''){
                continue;
            }
            if ($k == 'password'){
                $toUser['password'] = md5($v);
                continue;
            }
            if ($k == 'name' || $k == 'phone' || $k == 'email' ){
                    $toUser[$k] = $v ;
            }else{
                if ($k == 'truename'){
                    $toUserinfo['name'] = $v ;
                }else{
                    $toUserinfo[$k] = $v ;
                }
            }
        }
//        添加is_confirmed和create_time字段  即是否验证和创建时间
        $toUser['is_confirmed']=0;
        $toUser['create_time'] = time();
        $result1 = DB::table('homeuser')->insert($toUser);
//        判断user是否添加成功  失败则跳转  不执行
        if (!$result1){
            return back()->withErrors('添加失败');
        }
        $id = DB::table('homeuser')->select(DB::Raw('max(id) as id'))->get()[0]->id;
        $toUserinfo['uid'] = $id;
        $result2 = DB::table('homeuserinfo')->insert($toUserinfo);
        if ($result2){
            return redirect('admin/user');
        }else{
            return back()->withErrors('添加失败');
        }
    }
    //    删除用户
    public function del($id)
    {
        $result1 = DB::delete('delete from homeuser where id=?',[$id]);
        $result2 = DB::delete('delete from homeuserinfo where uid=?',[$id]);
        if ($result1 && $result2){
            return $this->index();
            exit;
        }else{
            return back();
        }
    }
    //    查找被修改的用户信息
    public function find($id)
    {
        $result1 = DB::select('select * from homeuser where id='.$id);
        $result2 = DB::select('select * from homeuserinfo where uid='.$id);
        $result = [$result1,$result2];
        $data = json_encode($result);
        echo $data;
    }
    //    确认修改
    public function edit(Request $request,$id)
    {
//       判断上传图片且不出错 则上传
        if ($request->hasFile('icon') && $request->file('icon')->isValid()){
            $iconname = $request->file('icon')->store('image');
        }
        $_POST['icon'] = empty($iconname)?'':$iconname;
//        两个空数组 用于存放添加到user表和userinfo的数据
        $toUser = array();
        $toUserinfo = array();
//        遍历将两个表的数据分开   存到上面两个数组中
        foreach ($_POST as $k=>$v){
            if ($k == '_token' || $k == 'password_confirmation' || $v == ''){
                continue;
            }
            if ($k == 'password'){
                $toUser['password'] = md5($v);
                continue;
            }
            if ($k == 'name' || $k == 'phone' || $k == 'email' ){
                $toUser[$k] = $v ;
            }else{
                if ($k == 'truename'){
                    $toUserinfo['name'] = $v ;
                }else{
                    $toUserinfo[$k] = $v ;
                }
            }
        }
//        添加is_confirmed和create_time字段  即是否验证和创建时间
        $toUser['update_time'] = time();
        $result1 = DB::table('homeuser')->where('id',$id)->update($toUser);
//        判断user是否添加成功  失败则跳转  不执行
        if (!$result1){
            return back()->withErrors('更新失败');
        }
        $result2 = DB::table('homeuserinfo')->where('uid',$id)->update($toUserinfo);
        if ($result2){
            return redirect('admin/user');
        }else{
            return back()->withErrors('更新失败');
        }
    }
//    修改状态
    public function changeStatus(Request $request){
        if ($request->all()['status'] == 1){
            DB::table('homeuser')->where('id',$request->all()['id'])->update(['is_confirmed'=>0]);
        }else{
            DB::table('homeuser')->where('id',$request->all()['id'])->update(['is_confirmed'=>1]);
        }
        echo 1;
    }
}
