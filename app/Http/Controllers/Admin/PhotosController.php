<?php

namespace App\Http\Controllers\Admin;

use App\Photoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PhotosController extends Controller
{
    public function photos(){
        if( empty($_GET['search']) ){
            $photos = DB::table('photoes')->select('*','photoes.id as pid')
                ->Leftjoin('photomanage','photomanage.id','=','photoes.Aid')->paginate(5);
            return view('admin.index',['tasks'=>$photos , 'content' => '/admin/photos/content']);
        } else {
            $search = $_GET['search'];
            $photos = DB::table('photoes')->select('*','photoes.id as pid','photoes.CreateTime as pCreateTime')
                ->Leftjoin('photomanage','photomanage.id','=','photoes.Aid')
                ->where('photoes.PhotosName','like','%'.$search.'%')
                ->orWhere('photoes.PhotosDescription','like','%'.$search.'%')
                ->orWhere('photomanage.AlbumName','like','%'.$search.'%')
                ->paginate(5);
            return view('admin.index',['tasks'=>$photos ,'keepsearch'=>$search , 'content' => '/admin/photos/content']);
        }
    }
    public function del(Request $request){
        $photoes = Photoes::where('id',$request->all()['id'])->first()->toArray();
        unlink(public_path().'/'.$photoes['PhotosUrl']);
        if(Photoes::where('id',$request->all()['id'])->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function edit(Request $request){
        $rearr = $request->all();
        $arr = array_shift($rearr);
        if (Photoes::where('id',$request->all()['id'])->update($rearr)){
            echo 1;
        }else{
            echo 0;
        }
    }
}
