<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id=Session::get('id');
        $result=DB::table('role_user')->where('user_id',$id)->value('role_id');

        $superid=DB::table('roles')->where('name','超级管理员')->value('id');
        $ordinaryid=DB::table('roles')->where('name','普通管理员')->value('id');

//        dd($result,$superid,$ordinaryid,$id);
        if($result == $ordinaryid){
            $route = Route::current()->uri();
            $user = User::find($id);
            if(!$user->can($route)){
                return back();
            }
            return $next($request);
        }elseif($result == $superid){
            return $next($request);
        }

    }
}
