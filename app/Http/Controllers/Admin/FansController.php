<?php

namespace App\Http\Controllers\Admin;

use App\UserFans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FansController extends Controller
{
    public function index(){
        if( empty($_GET['search']) ){
            $userFans = UserFans::select('*','uid as fuid','uid_ed as fuid_ed')
                ->join('homeuser',function ($join){
                    $join->on('userfans.uid','=','homeuser.id')->on('userfans.uid_ed','=','homeuser.id');
                })
//                ->leftJoin('homeuser','userfans.uid_ed','=','homeuser.id')
//                ->join('homeuser',function ($join){
//                    $join->on('userfans.uid_ed','=','homeuser.id');
//                })
//                ->paginate(5);
            ->get();
            dd($userFans);
            return view('admin.index',['tasks'=>$userFans,'content' => '/admin/fans/index']);
        } else {
            $search = $_GET['search'];
            $id = DB::table('homeuser')->where('name','like','%'.$search.'%')->get();
            $userFans = UserFans::select('*','uid as fuid','uid_ed as fuid_ed')
                ->join('homeuser','userfans.fuid','=','homeuser.id')
                ->join('homeuser','userfans.fuid_ed','=','homeuser.id')
                ->Where('homeuser.name','like','%'.$search.'%')
                ->paginate(5);
            var_dump($id);
//            return view('admin.index',['tasks'=>$userFans ,'keepsearch'=>$search , 'content' => '/admin/fans/index']);
        }
    }
}
