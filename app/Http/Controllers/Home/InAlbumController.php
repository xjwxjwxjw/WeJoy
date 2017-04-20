<?php

namespace App\Http\Controllers\Home;

use App\Album;
use App\Photoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Vinkla\Hashids\Facades\Hashids;

class InAlbumController extends Controller
{
    private $num = 3;//每页数量（manage方法）、修改时图片信息时循环次数（editPhotoes方法）

    public function photo($id = 'my',$Aid){
        if($id == 'my'|| Hashids::decode($id)[0] == Cookie::get('UserId')){
//            访问自己的
            $photoes = Photoes::all()->where('Aid',Hashids::decode($Aid)[0])->toArray();
            return view('home.user.selfInAlbum',compact('photoes','Aid'));
        }else{
            dd(2);
//            访问别人的
            $id = Hashids::decode($id)[0];
            $album = Album::all()->where('uid',$id)->toArray();
            return view('home.user.photo',compact('id','album'));
        }
    }
    public function addPhoto(Request $request,$Aid){
        $arr = array();
        $basename = 'image/photos/'.Hashids::decode($Aid)[0];
        $tosqlfilename = date("Ymd-His-",time()).uniqid();
        $filename = $tosqlfilename.(empty($request->all()['facetype'])?'.jpg':$request->all()['facetype']);
        $FaceUrl = $basename.'/'.$filename;
        $request->file('PhotosUrl')->move($basename,$filename);
        $arr['PhotosUrl'] = $FaceUrl;
//        修改数据用于添加到数据库
        foreach ($request->all() as $k => $v){
            if ($k == '_token' || $k == 'facetype' || $k == 'PhotosUrl'){
                continue;
            }
            if ($k == 'PhotosName' && ($v == '' || $v == null || empty($v))){
                $arr['PhotosName'] = $tosqlfilename;
                continue;
            }
            $arr[$k] = $v;
        }
        $arr['Aid'] = Hashids::decode($Aid)[0];
        $arr['CreateTime'] = time();
        Photoes::insertGetId($arr);
        return back();
    }
    public function manage($Aid){
//        判断Aid是否正确
        if (!count(Hashids::decode($Aid))){
            return view('home.index');
        }
//        判断是否存在该相册
        $hasAlbum = Album::all()->where('id',Hashids::decode($Aid)[0])->toArray();
        if (!count($hasAlbum)){
            return view('home.index');
        }
        $byUser = $hasAlbum[0]['uid'];
//        判断是否对应自己的相册
        if ($byUser != Cookie::get('UserId')){
            return view('home.index');
        }
        $photoes = Photoes::where('Aid',Hashids::decode($Aid)[0])->paginate($this->num);
        return view('home.user.manageAlbum',compact('photoes','Aid'));
    }
    public function delPhoto(Request $request){
        $photoes = Photoes::find(Hashids::decode($request->all()['id']))[0];
        unlink(public_path().'/'.$photoes->PhotosUrl);
        if($photoes->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function editPhotoes(Request $request){
        $arr[0] = array();
        $arr[1] = array();
        $arr[2] = array();
//        分割修改数据
        foreach ($request->all() as $k => $v){
            if ($k == '_token'){
                continue;
            }
            if (strrchr($k,'_') == '_0'){
                $arr[0][strtok($k,'_')] = $v;
            }
            if (strrchr($k,'_') == '_1'){
                $arr[1][strtok($k,'_')] = $v;
            }
            if (strrchr($k,'_') == '_2'){
                $arr[2][strtok($k,'_')] = $v;
            }
        }
        for ($i=0; $i < $this->num; $i++) {
            $oldPhoto = Photoes::find(Hashids::decode($arr[$i]['id']))->toArray()[0];
            if ($oldPhoto['PhotosName'] == $arr[$i]['PhotosName'] && $oldPhoto['PhotosDescription'] == $arr[$i]['PhotosDescription']){
                continue;
            }else{
                Photoes::where('id',Hashids::decode($arr[$i]['id']))->update(array_splice($arr[$i],1));
            }
        }
        echo 1;
    }
    public function setFace(Request $request){
        $inAlbumImg = Photoes::all()->where('Aid',Hashids::decode($request->all()['aid'])[0])->toArray();
        foreach ($inAlbumImg as $value){
            if ($value['isFace'] != 1){
                continue;
            }
            Photoes::where('id',$value['id'])->update(['isFace'=>2]);
        }
        Photoes::where('id',Hashids::decode($request->all()['id'])[0])->update(['isFace'=>1]);
        $FacePhoto = Photoes::all()->where('id',Hashids::decode($request->all()['id'])[0])->toArray();
        foreach ($FacePhoto as $vFace ){
            $FaceUrl = $vFace['PhotosUrl'];
            $Aid = $vFace['Aid'];
        }
        Album::where('id',$Aid)->update(['FaceUrl'=>$FaceUrl]);
        echo 1;
    }
}
