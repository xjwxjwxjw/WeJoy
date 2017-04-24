<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Newtype;

class NewtypeController extends Controller
{

  // 显示首页内容
  public function newsIndex()
  {
    if( empty($_GET['search']) ){
      $newlist = DB::table('newtype')->paginate(5);
      return view('admin.index',['tasks'=>$newlist , 'content' => '/admin/newtype/content']);
    } else {
      $search = $_GET['search'];
      $newlist = Newtype::where('description','like','%'.$search.'%')->paginate(5);
      return view('admin.index',['tasks'=>$newlist ,'keepsearch'=>$search , 'content' => '/admin/newtype/content']);
    }
  }

  public function delete() {
    $id = $_GET['id'];
    $isdel = DB::table('news')->where('topic', Newtype::where('id',$id)->value('description') )->count();
    if ( $isdel == 0 ) {
      $result = Newtype::where('id','=',$id)->delete();
    } else {
      return 1;
    }

  }

  public function typeAdd(Request $request)
  {
      if ($request->isMethod('post')) {
          $permission = Newtype::create($request->all());
          $permissions = Newtype::all();
      }

  }

  public function newtypefind($id)
  {
      $newtype = Newtype::where('id','=',$id)->value('description');
      return response()->json($newtype);
  }

  //修改分类
  public function newtypeUpdate(Request $request, $id)
  {
      //修改用户信息
      if ($request->isMethod('post')) {
          $permission = Newtype::findOrFail($id);
          $oldtype = Newtype::where('id',$id)->value('description');
          $permission->update($request->all());
          DB::table('news')->where( 'topic',$oldtype)->update(['topic'=>$request->description]);
      }
      // //查询出当前的权限信息
      $permissions = Newtype::where('id','=',$id)->get();
      return response()->json($permissions);
      // $permission = Permission::findOrFail($id);
      // return view('admin/permission.permissionUpdate', compact('permission'));
  }

}
