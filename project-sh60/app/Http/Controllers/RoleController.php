<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //显示权限
    public function roleList()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            $perms = array();
            foreach ($role->perms as $perm) {
                $perms[] = $perm->display_name;
            }
            $role->perms= implode(',', $perms);
        }
        return view('admin.roleList', compact('roles'));
    }

    //添加角色
    public function roleAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $role = Role::create($request->all());
            return redirect('/role-list');
        }
        return view('admin.roleAdd');
    }

    //修改角色
    public function roleUpdate(Request $request, $role_id)
    {
        if($request->isMethod('post')){
            $role = Role::findOrFail($role_id);
            $role->update($request->all());
            return redirect('/role-list');
        }
        $role = Role::findOrFail($role_id);
        return view('admin.roleUpdate', compact('role'));
    }

    //给角色分配权限
    public function attachPermission(Request $request, $role_id)
    {
        if ($request->isMethod('post')) {
            //获取当前用户的角色
            $role = Role::find($role_id);
            //先将所以的权限删除
            DB::table('permission_role')->where('role_id', $role_id)->delete();
            //重新分配权限
            foreach ($request->input('permission_id') as $permission_id){
                $role->attachPermission(Permission::find($permission_id));
            }
            return redirect('/role-list');
        }
        //查询所有的权限
        $permissions = Permission::all();
        return view('admin.attachPermission', compact('permissions'));
    }
}
