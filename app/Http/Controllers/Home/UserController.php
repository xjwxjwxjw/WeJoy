<?php

namespace App\Http\Controllers\Home;

use App\UserFans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
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
}
