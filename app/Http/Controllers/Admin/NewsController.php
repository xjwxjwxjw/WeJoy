<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

  // 显示首页内容
  public function newsIndex()
  {
    if( empty($_GET['search']) ){
      $newlist = DB::table('news')->paginate(5);
      return view('admin.index',['tasks'=>$newlist , 'content' => '/admin/news/content']);
    } else {
      $search = $_GET['search'];
      $newlist = DB::table('news')->where('content','like','%'.$search.'%')->paginate(5);
      return view('admin.index',['tasks'=>$newlist ,'keepsearch'=>$search , 'content' => '/admin/news/content']);
    }
  }

  public function delete() {
    $id = $_GET['id'];
  	$result = DB::table('news')->where('id','=',$id)->delete();
    if ( $result == 0 ) {
      DB::table('comment')->where('mid','=',$id)->delete();
      DB::table('user_collect')->where('collect_id','=',$id)->delete();
    }else{
      return '删除失败';
    }
  }

  public function edit() {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $result = DB::table('news')->where('id','=',$id)->update(['status'=>$status]);
    return $status;
  }

}
