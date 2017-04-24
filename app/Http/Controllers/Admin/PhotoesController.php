<?php

namespace App\Http\Controllers\Admin;

use App\Photoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoesController extends Controller
{
    public function index(){
        if( empty($_GET['search']) ){
            $photos = Photoes::all()->paginate(5);
            return view('admin.index',['tasks'=>$photos , 'content' => '/admin/photoes/index']);
        } else {
            $search = $_GET['search'];
            $returnuser = DB::table('homeuser')->select('*','homeuser.name as nickname','homeuserinfo.name as truename')
                ->join('homeuserinfo','homeuser.id','=','homeuserinfo.uid')
                ->Where('homeuser.name','like','%'.$search.'%')
                ->orWhere('homeuserinfo.name','like','%'.$search.'%')
                ->orWhere('homeuser.phone','like','%'.$search.'%')
                ->orWhere('homeuser.email','like','%'.$search.'%')
                ->paginate(5);
            return view('admin.index',['tasks'=>$returnuser ,'keepsearch'=>$search , 'content' => '/admin/user/index']);
        }
    }
}
