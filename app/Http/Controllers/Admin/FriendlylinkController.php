<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Friendlylink;

class FriendlylinkController extends Controller
{

  // 显示首页内容
  public function newsIndex()
  {
    if( empty($_GET['search']) ){
      $newlist = Friendlylink::paginate(5);
      return view('admin.index',['tasks'=>$newlist , 'content' => '/admin/friendlylink/content']);
    } else {
      $search = $_GET['search'];
      $newlist = Friendlylink::where('name','like','%'.$search.'%')->paginate(5);
      return view('admin.index',['tasks'=>$newlist ,'keepsearch'=>$search , 'content' => '/admin/friendlylink/content']);
    }
  }

  public function delete() {
    $id = $_GET['id'];
    $result = Friendlylink::where('id','=',$id)->delete();

  }

  public function friendlylinkAdd(Request $request)
  {
      if ($request->isMethod('post')) {
          $permission = Friendlylink::create($request->all());
          $permissions = Friendlylink::all();
      }

  }

  public function friendlylinkfind($id)
  {
      $newtype = Friendlylink::where('id','=',$id)->get();
      return response()->json($newtype);
  }

  //修改分类
  public function friendlylinkUpdate(Request $request, $id)
  {
      //修改用户信息
      if ($request->isMethod('post')) {
          $permission = Friendlylink::findOrFail($id);
          $permission->update($request->all());
      }
      // //查询出当前的权限信息
      $permissions = Friendlylink::where('id','=',$id)->get();
      return response()->json($permissions);
  }

}
