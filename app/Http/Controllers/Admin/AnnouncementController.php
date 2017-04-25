<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Announcement;

class AnnouncementController extends Controller
{

  // 显示首页内容
  public function newsIndex()
  {
    if( empty($_GET['search']) ){
      $newlist = Announcement::paginate(5);
      return view('admin.index',['tasks'=>$newlist , 'content' => '/admin/announcement/content']);
    } else {
      $search = $_GET['search'];
      $newlist = Announcement::where('description','like','%'.$search.'%')->paginate(5);
      return view('admin.index',['tasks'=>$newlist ,'keepsearch'=>$search , 'content' => '/admin/announcement/content']);
    }
  }

  public function delete() {
    $id = $_GET['id'];
    $result = Announcement::where('id','=',$id)->delete();

  }

  public function advertAdd(Request $request)
  {
      if ($request->isMethod('post')) {
          $permission = Announcement::create($request->all());
          $permissions = Announcement::all();
      }

  }

  public function status(Request $request)
  {
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ( $status == 1 ) {
      Announcement::where('status',1)->update(['status'=>0]);
    }
      $result = Announcement::where('id','=',$id)->update(['status'=>$status]);


    return $status;

  }

  public function advertfind($id)
  {
      $newtype = Announcement::where('id','=',$id)->get();
      return response()->json($newtype);
  }

  //修改分类
  public function advertUpdate(Request $request, $id)
  {
      //修改用户信息
      if ($request->isMethod('post')) {
          $permission = Announcement::findOrFail($id);
          $permission->update($request->all());
      }
      // //查询出当前的权限信息
      $permissions = Announcement::where('id','=',$id)->get();
      return response()->json($permissions);
  }

}
