<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

  // 显示首页内容
  public function index()
  {
    return view('admin.index');
  }
    public function myIndex()
    {
        $result = DB::select('select * from user');
        return view('admin.myIndex',compact('result'));
    }
    public function myDel($id)
    {
        $result = DB::delete('delete from user where id=?',[$id]);
        if ($result){
            return $this->myIndex();
            exit;
        }else{
            return back();
        }
    }
}
