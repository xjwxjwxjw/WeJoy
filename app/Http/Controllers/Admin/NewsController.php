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
    $newlist = DB::table('news')->paginate(5);
    return view('admin.index',['tasks'=>$newlist , 'content' => '/admin/news/content']);

  }

  public function delete($id) {
  	$result = DB::table('news')->where('nid','=',$id)->delete();
    if ( $result == 0 ) {
      return response()->json(['error']);
    }else{
      return response()->json(['success']);
    }
  }

  public function edit($id) {
    $result = DB::table('news')->where('nid','=',$id)->get();
    return response()->json($result);
  }

}
