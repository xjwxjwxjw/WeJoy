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
    public function lookIndex()
    {
        return view('home.user.index');
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


}
