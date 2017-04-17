<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminroleRequset;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //显示权限列表
    public function roleList()
    {

        //查询所有的权限
        $roles = Role::paginate(5);
        foreach ($roles as $role) {
            $perms = array();
            foreach ($role->perms as $perm) {
                $perms[] = $perm->display_name;
            }
            $role->perms= implode(',', $perms);
        }
        return view('admin.index',compact('roles'),['content' => '/admin/permission/role/content'] );
    }
    //添加权限表单

    public function roleAdd(Request $request)
    {
        $rules = array(
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        );
        $message = array(

            'name.required'=>'角色名不能为空',
            'display_name.required'=>'权限不能为空',
            'description.required'=>'描述不能为空',

        );
        $this->validate($request,$rules,$message);
        if ($request->isMethod('post')) {
           //添加权限操作
            $roles = Role::create($request->all());
            // return redirect('/permission-list');
        }

    }
    public function rolefind($id)
    {
            // return redirect('/permission-list');
            $roles = Role::where('id','=',$id)->get();
            return response()->json($roles);

    }

    //修改权限
    public function roleUpdate(Request $request, $id)
    {
        //修改用户信息
        if ($request->isMethod('post')) {
            $roles = Role::findOrFail($id);
            $roles->update($request->all());
        }
        // //查询出当前的权限信息
        $roles = Role::where('id','=',$id)->get();
        return response()->json($roles);
        // $roles = Role::findOrFail($id);
        // return view('admin/permission.permissionUpdate', compact('permission'));
    }

    //删除角色
    public function roleDelete($id)
    {
        //删除信息
        DB::table('roles')->where('id', $id)->delete();
        DB::table('role_user')->where('role_id', $id)->delete();
        DB::table('permission_role')->where('role_id', $id)->delete();

    }

    //分配权限
    public function attachPermission(Request $request,$id)
    {
        if ($request->isMethod('post')) {
            //获取当前用户的角色
            $user = Role::find($id);
            DB::table('permission_role')->where('role_id', $id)->delete();
            foreach ($request->input('permission_id') as $permission_id){
                $user->attachPermission(Permission::find($permission_id));
            }
            // 返回当条数据
            $roles =  Role::find($id);
            $perms = array();
            foreach ($roles->perms as $perm) {
                $perms[] = $perm->display_name;
            }
            $roles['perm'] = $user->perms = implode(',', $perms);
            return response()->json($roles);
        }else{
        //   //查询所有的权限
          $roles = Permission::all();
          return response()->json($roles);
        }

    }

}
