<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(){
        if( empty($_GET['search']) ){
            $level = DB::table('level')->select('*','level.id as Lid')
                ->join('homeuser','homeuser.id','=','level.uid')->paginate(5);
            return view('admin.index',['tasks'=>$level , 'content' => '/admin/level/content']);
        } else {
            $search = $_GET['search'];
            $level = DB::table('level')->select('*','level.id as Lid')
                ->join('homeuser','homeuser.id','=','level.uid')
                ->where('homeuser.name','like','%'.$search.'%')
                ->paginate(5);
            return view('admin.index',['tasks'=>$level ,'keepsearch'=>$search , 'content' => '/admin/level/content']);
        }
    }
    public function add(Request $request){
        $oldexp = DB::table('level')->where('id',$request->all()['id'])->first()->exp;
        $newexp = $oldexp + $request->all()['exp'];
        $newlevel = ceil($newexp / 50);
        if(DB::table('level')->where('id',$request->all()['id'])->update(['exp'=>$newexp,'level'=>$newlevel])){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function minus(Request $request){
        $oldexp = DB::table('level')->where('id',$request->all()['id'])->first()->exp;
        $newexp = $oldexp - $request->all()['exp'];
        $newlevel = ceil($newexp / 50);
        if(DB::table('level')->where('id',$request->all()['id'])->update(['exp'=>$newexp,'level'=>$newlevel])){
            echo 1;
        }else{
            echo 0;
        }
    }
}
