<?php

namespace App\Http\Controllers\Home;

use App\Aboutus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{

    //进入关于我们的信息页面
    public function index()
    {
        $result = Aboutus::all()->first();
        return view('home.aboutUs',compact('result'));
    }


    //进行数据更新切换操作
    public function update()
    {
       $result[]=Aboutus::first()->$_GET['a'];

       return json_encode($result);
    }

}
