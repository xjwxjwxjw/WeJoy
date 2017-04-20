<?php

namespace App\Http\Controllers\Home;

use App\Album;
use App\Photoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class AlbumController extends Controller
{
    public function photo($id = 'my'){
        if($id == 'my'){
//            访问自己的
            $album = Album::all()->where('uid',Cookie::get('UserId'))->toArray();
            return view('home.user.selfphoto',compact('album'));
        }else{
//            访问别人的
            $id = Hashids::decode($id)[0];
            $album = Album::all()->where('uid',$id)->toArray();
            return view('home.user.photo',compact('id','album'));
        }
    }
    public function addAlbum(Request $request){
        $arr = array();
        var_dump($request->all());
//        如果有图片就上传  添加
        if(array_key_exists('face',$request->all())){
            $basename = 'image/album/'.Cookie::get('UserId');
            $filename = date("Ymd-His-",time()).uniqid().(empty($request->all()['facetype'])?'.jpg':$request->all()['facetype']);
            $FaceUrl = $basename.'/'.$filename;
            $request->file('face')->move($basename,$filename);
            $arr['FaceUrl'] = $FaceUrl;
        }
//        修改数据用于添加到数据库
        foreach ($request->all() as $k => $v){
            if ($k == '_token' || $k == 'facetype' || $k == 'face'){
                continue;
            }
            $arr[$k] = $v;
        }
        $arr['uid'] = Cookie::get('UserId');
        $arr['CreateTime'] = time();
        $id = Album::insertGetId($arr);
        if(array_key_exists('face',$request->all())){
//            封面添加到图片表
            Photoes::create(array(
                'Aid'=>$id,
                'PhotosName'=>empty($filename)?'':$filename,
                'PhotosDescription'=>'',
                'PhotosUrl'=>empty($FaceUrl)?'':$FaceUrl,
                'isFace'=>'1',
                'CreateTime'=>time()
            ));
        }
        return redirect('/home/user/photo');
    }
    public function editDescription(Request $request){
        $album = Album::find($request->all()['id']);
        $album->AlbumDescription = $request->all()['AlbumDescription'];
        $album->UpdateTime = time();
        if($album->save()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function editName(Request $request){
        $album = Album::find($request->all()['id']);
        $album->AlbumName = $request->all()['AlbumName'];
        $album->UpdateTime = time();
        if($album->save()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function delAlbum(Request $request){
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
}
