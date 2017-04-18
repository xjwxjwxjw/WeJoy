<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //显示权限列表
    public function permissionList()
    {
      //查询所有的权限
        if( empty($_GET['search']) ){
          $permissions = Permission::paginate(5);
          return view('admin.index',compact('permissions'),['content' => '/admin/permission/permission/content'] );
        } else {
          $search = $_GET['search'];
          $permissions = Permission::where('name','like','%'.$search.'%')->paginate(5);
          return view('admin.index',compact('permissions'),['keepsearch'=>$search ,'content' => '/admin/permission/permission/content'] );
        }
    }
    //添加权限表单
    public function permissionAdd(Request $request)
    {
        if ($request->isMethod('post')) {
           //添加权限操作
            $permission = Permission::create($request->all());
            $permissions = Permission::all();
        }

    }
    public function permissionfind($id)
    {
        $permissions = Permission::where('id','=',$id)->get();
        return response()->json($permissions);
    }

    //修改权限
    public function permissionUpdate(Request $request, $id)
    {
        //修改用户信息
        if ($request->isMethod('post')) {
            $permission = Permission::findOrFail($id);
            $permission->update($request->all());
        }
        // //查询出当前的权限信息
        $permissions = Permission::where('id','=',$id)->get();
        return response()->json($permissions);
        // $permission = Permission::findOrFail($id);
        // return view('admin/permission.permissionUpdate', compact('permission'));
    }

    //删除权限
    public function permissionDelete($id)
    {
      Permission::destroy([$id]);
      DB::table('permission_role')->where('permission_id', $id)->delete();
    }
}
