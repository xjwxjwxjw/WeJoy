<?php

namespace App\Http\Controllers\Home;

use App\UserFans;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class UserController extends Controller
{
    use DatabaseTransactions;
    public function index()
    {
        return view('home.user.index');
    }
    public function lookIndex($id)
    {
        $id = Hashids::decode($id)[0];
        return view('home.user.user',compact('id'));
    }
    public function addFans(Request $request)
    {
        $user_ed = DB::table('homeuser')->where('name',$request->name)->get()[0]->id;
        $userfans = UserFans::create(['uid'=>Cookie::get('UserId'),'uid_ed'=>$user_ed,'status'=> 1]);
        if($userfans){
            $fansstatu = '1';
        }else{
            $fansstatu = '0';
        }
        echo $fansstatu;
    }
    public function doFans(Request $request)
    {
        $fansstatu = '0';
        $uid = Hashids::decode($request->all()['uid'])[0];
        $uid_ed = Hashids::decode($request->all()['uid_ed'])[0];
        switch ($request->all()['doWork']){
            case 'addFans':
//                查找是否已拉黑
                $status = UserFans::all()->where('uid',$uid)->where('uid_ed',$uid_ed)->toArray();
//              统计数据  有则表示已拉黑  更新数据即可  否则未关注未拉黑 则添加数据
                if (count($status)){
                    UserFans::where('uid',$uid)->where('uid_ed',$uid_ed)->update(['status'=>1]);
                    $fansstatu = '1';
                }else{
                    UserFans::create(['uid'=>$uid,'uid_ed'=>$uid_ed,'status'=> 1]);
                    $fansstatu = '1';
                }
                break;
            case 'cancelFans':
                if(UserFans::where('uid',$uid)->where('uid_ed',$uid_ed)->where('status',1)->delete()){
                    $fansstatu = '1';
                }
                break;
            case 'addBlack':
//                查找是否已粉
                $status = UserFans::all()->where('uid',$uid)->where('uid_ed',$uid_ed)->toArray();
//              统计数据  有则表示已粉  更新数据即可  否则未关注未拉黑 则添加数据
                if (count($status)){
                    UserFans::where('uid',$uid)->where('uid_ed',$uid_ed)->update(['status'=>2]);
                    $fansstatu = '1';
                }else{
                    UserFans::create(['uid'=>$uid,'uid_ed'=>$uid_ed,'status'=> 2]);
                    $fansstatu = '1';
                }
                break;
            case 'cancelBlack':
                if(UserFans::where('uid',$uid)->where('uid_ed',$uid_ed)->where('status',2)->delete()){
                    $fansstatu = '1';
                }
                break;
            case 'addReport':
                DB::table('report')->insert(['uid'=>$uid,'re_uid'=>$uid_ed]);
//                修改等级开始
                $exp = DB::table('level')->where('uid',$uid)->get()[0];
                if (empty($exp)){
                    DB::table('level')->insert(['uid'=>Cookie::get('UserId'),'exp'=>-5,'level'=>1]);
                }else{
                    $changeexp = $exp->exp - 5;
                    $level = ceil($changeexp/50);
                    DB::table('level')->where('uid',$uid)->update(['exp'=>$changeexp,'level'=>$level]);
                }
//                修改等级结束
                $fansstatu = 1;
                break;
            case 'cancelReport':
                if(DB::table('report')->where('uid',$uid)->where('re_uid',$uid_ed)->delete()){
//                修改等级开始
                    $exp = DB::table('level')->where('uid',$uid)->get()[0];
                    if (empty($exp)){
                        DB::table('level')->insert(['uid'=>Cookie::get('UserId'),'exp'=>5,'level'=>1]);
                    }else{
                        $changeexp = $exp->exp + 5;
                        $level = ceil($changeexp/50);
                        DB::table('level')->where('uid',$uid)->update(['exp'=>$changeexp,'level'=>$level]);
                    }
//                修改等级结束
                    $fansstatu = '1';
                }
                break;
        }
        echo $fansstatu;
    }
    public function info()
    {
        return view('home.user.info');
    }
    public function edit(Request $request){
        DB::transaction(function()use($request)
        {
            $str_user = '';
            $str_info = '';
            foreach ($request->all() as $k => $v){
                if ($k == '_token'){
                    continue;
                }
                if ($k == 'oldnick'){
                    $nickname = $v;
                    continue;
                }
                if ($k == 'nickname' && $request->all()['oldnick'] != $request->all()['nickname']){
                    $str_user .= 'name="'.$v.'",';
                    continue;
                }
                if ($k == 'nickname' && $request->all()['oldnick'] == $request->all()['nickname']){
                    continue;
                }
                if ($k == 'email' || $k == 'phone'){
                    $str_user .= $k .'="'.$v .'",';
                    continue;
                }
                if ($k == 'sex'){
                    $str_info .= $k .'='.$v .',';
                    continue;
                }
                $str_info .= $k .'="'. $v .'",';
            }
            $str_user .= 'update_time='.time();
            $str_info .= 'update_time='.time();
            $str_user = trim($str_user,',');
            $str_info = trim($str_info,',');

            $success_user = DB::update('update homeuser set '.$str_user.' where name="'.$nickname.'"');
            $uid = DB::table('homeuser')->select('id')->where('name',$nickname)->get()[0]->id;
            $success_info = DB::update('update homeuserinfo set '.$str_info.' where uid='.$uid);
            if (!$success_user || !$success_info){
                DB::rollback();
                $error = '0';
            }else{
                DB::commit();
                $error =  '1';
            }
            echo $error;
        });
    }
    public function editIcon(Request $request){
        $uid = Hashids::decode($request->all()['name'])[0];
        $basename = 'image/'.date("Y/m/d",time());
        $filename = date("Ymd-His-",time()).uniqid().$request->all()['icontype'];
        // dd($request->file('icon'));
        if($request->file('icon')->move($basename,$filename)){
//            删除原图片
            $oldicon = DB::select('select icon from homeuserinfo where uid='.$uid)[0]->icon;
            if ($oldicon){
                unlink(public_path().'/'.$oldicon);
            }
//            更新数据
            DB::update('update homeuserinfo set icon="'.$basename.'/'.$filename.'" where uid='.$uid);
            return back();
        }else{
            return back();
        }
    }
    //    关注
    public function fans($id){
        $id = Hashids::decode($id)[0];
        $fansinfo = DB::table('userfans')->where('userfans.uid_ed',$id)->where('status',1)
            ->join('homeuser','userfans.uid','=','homeuser.id')
            ->join('homeuserinfo','userfans.uid','=','homeuserinfo.uid')
            ->select('homeuser.name as nickname','homeuserinfo.*')->paginate(8);
        return view('home.user.fansed',compact('fansinfo'));
    }
    //    粉丝
    public function fansed($id){
        $id = Hashids::decode($id)[0];
        $fansinfo = DB::table('userfans')->where('userfans.uid',$id)->where('status',1)
            ->join('homeuser','userfans.uid_ed','=','homeuser.id')
            ->join('homeuserinfo','userfans.uid_ed','=','homeuserinfo.uid')
            ->select('homeuser.name as nickname','homeuserinfo.*')->paginate(8);
        return view('home.user.fans',compact('fansinfo'));
    }
    //    黑名单
    public function black($id){
        $id = Hashids::decode($id)[0];
        $fansinfo = DB::table('userfans')->where('userfans.uid_ed',$id)->where('status',2)
            ->join('homeuser','userfans.uid','=','homeuser.id')
            ->join('homeuserinfo','userfans.uid','=','homeuserinfo.uid')
            ->select('homeuser.name as nickname','homeuserinfo.*')->paginate(8);
        return view('home.user.black',compact('fansinfo'));
    }
    //    Ta的关注
    public function fan($id){
        $id = Hashids::decode($id)[0];
        $fansinfo = DB::table('userfans')->where('userfans.uid_ed',$id)->where('status',1)
            ->join('homeuser','userfans.uid','=','homeuser.id')
            ->join('homeuserinfo','userfans.uid','=','homeuserinfo.uid')
            ->select('homeuser.name as nickname','homeuserinfo.*')->paginate(8);
        return view('home.user.otherfansed',compact('fansinfo','id'));
    }
    //    Ta的粉丝
    public function faned($id){
        $id = Hashids::decode($id)[0];
        $fansinfo = DB::table('userfans')->where('userfans.uid',$id)->where('status',1)
            ->join('homeuser','userfans.uid_ed','=','homeuser.id')
            ->join('homeuserinfo','userfans.uid_ed','=','homeuserinfo.uid')
            ->select('homeuser.name as nickname','homeuserinfo.*')->paginate(8);
        return view('home.user.otherfans',compact('fansinfo','id'));
    }

}
