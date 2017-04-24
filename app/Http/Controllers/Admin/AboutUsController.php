<?php

namespace App\Http\Controllers\Admin;

use App\Aboutus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    //进入关于我们的管理页面
     public function index()
     {
         if( empty($_GET['search']) ){
             $result = DB::table('aboutus')->get()->first();
             return view('admin.index',['tasks'=>$result , 'content' => '/admin/aboutUs/AboutUs']);
         } else {
             $search = $_GET['search'];
             $result = DB::table('aboutus')->where('infor','like','%'.$search.'%')
                 ->orWhere('service','like','%'.$search.'%')
                 ->orWhere('advantage','like','%'.$search.'%')
                 ->orWhere('contact','like','%'.$search.'%')
                 ->get()->first();
             return view('admin.index',['tasks'=>$result ,'keepsearch'=>$search , 'content' => '/admin/aboutUs/AboutUs']);
         }
     }

     //添加信息
     public function add(Request $request)
     {
         $backString = 0;
         $arr = array();
         foreach ($request->all() as $k => $v){
            if ($k == '_token'){
                continue;
            }
            if ($v == '' || empty($v)){
                continue;
            }
            $arr[$k] = $v;
         }
         if(DB::table('aboutus')->insert($arr)){
             $backString = 1;
         }
         echo $backString;
     }

     //删除信息
     public function delete(Request $request)
     {
         $backString = 0;
         if(DB::table('aboutus')->update([$request->all()['name']=>''])){
             $backString = 1;
         }
         echo $backString;
     }
    //更新操作
    public function update(Request $request)
    {
        $backString = 0;
        $arr = array();
        foreach ($request->all() as $k => $v){
            if ($k == '_token'){
                continue;
            }
            if ($v == '' || empty($v)){
                continue;
            }
            $arr[$k] = $v;
        }
        if(DB::table('aboutus')->update($arr)){
            $backString = 1;
        }
        echo $backString;
    }
}
