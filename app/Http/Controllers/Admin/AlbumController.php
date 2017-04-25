<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function album(){
        $album = DB::table('photomanage')->select('*','photomanage.id as Aid')
            ->Leftjoin('homeuser','photomanage.uid','=','homeuser.id')->paginate(5);
        return view('admin.index',['tasks'=>$album , 'content' => '/admin/album/content']);
    }
    public function del(Request $request){
        $album = Album::find($request->all()['id']);
        $photoes = DB::table('photoes')->where('Aid',$request->all()['id'])->get();
        foreach ($photoes as $v){
            unlink(public_path().'/'.$v->PhotosUrl);
        }
        if($album->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function edit(Request $request){
        $rearr = $request->all();
        $arr = array_shift($rearr);
        if (Album::where('id',$request->all()['id'])->update($rearr)){
            echo 1;
        }else{
            echo 0;
        }
    }
}
