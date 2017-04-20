<?php

namespace App\Http\Controllers\Home;

use App\Model\Content;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;


class ContentController extends Controller
{
  public function contentAdd(Request $request){
    if ($request->isMethod('post') ) {
      $data['uid'] = Cookie::get('UserId');
      $data['content'] = $_POST['content'];
      $data['created_at'] = date('Y-m-d H:i:s');
      $data['updated_at'] = date('Y-m-d H:i:s');
      $ids = Content::insertGetId( $data );

      if ( !empty( $ids ) ) {
        // 微博和图片关联
        $photoes = DB::table('news_photo')->where('uid',$data['uid'])->pluck('photo_id');
        if ( !empty($photoes) ) {
          DB::table('photoes')->whereIn('id',$photoes)->update(['mid'=>$ids]);
          DB::table('news_photo')->where('uid',$data['uid'])->delete();
        }

        $newcontent = Content::find($ids);
        $newcontent->usericon = DB::table('homeuserinfo')->where('id','=',$data['uid'])->value('icon');
        $newcontent->images = DB::table('photoes')->where('mid',$ids)->pluck('PhotosUrl');
        $newcontent->hid = Hashids::encode($newcontent->id);
        return response()->json($newcontent);
      }else{
        return false;
      }
    }

  }

  public function contentFind(){
    $search = $_GET['search'];
    $skip = $_GET['skip'];
    switch ( $search ) {
      case 'index':
        $id = Cookie::get('UserId');
        $news = Content::where('status','=','1')->skip($skip)->take(10)->orderBy('id', 'desc')->get();
        foreach ($news as $new ) {
          $new->username = DB::table('homeuser')->where('id','=',$new->uid)->value('name');
          $new->usericon = DB::table('homeuserinfo')->where('uid','=',$new->uid)->value('icon');
          $new->countcom = DB::table('comment')->where('mid','=',$new->id)->count();
          $new->images = DB::table('photoes')->where('mid',$new->id)->pluck('PhotosUrl');
          $new->uid = Hashids::encode($new->uid);
          $new->hid = Hashids::encode($new->id);
          $new->bid = Hashids::encode($id);
        }
        break;
      case 'mycollect':
        $id = Cookie::get('UserId');
        $results = DB::table('user_collect')->where('user_id',$id)->pluck('collect_id');
        $news = Content::where('status','=','1')->whereIn('id', $results)->skip($skip)->take(10)->orderBy('id', 'desc')->get();
        foreach ($news as $new ) {
          $new->username = DB::table('homeuser')->where('id','=',$new->uid)->value('name');
          $new->usericon = DB::table('homeuserinfo')->where('uid','=',$new->uid)->value('icon');
          $new->images = DB::table('photoes')->where('mid',$new->id)->pluck('PhotosUrl');
          $new->countcom = DB::table('comment')->where('mid','=',$new->id)->count();
          $new->uid = Hashids::encode($new->uid);
          $new->hid = Hashids::encode($new->id);
          $new->bid = Hashids::encode($id);
        }
        break;
        case 'myfavtimes':
          $id = Cookie::get('UserId');
          $results = DB::table('user_favtimes')->where('user_id',$id)->pluck('favtimes_id');
          $news = Content::where('status','=','1')->whereIn('id', $results)->skip($skip)->take(10)->orderBy('id', 'desc')->get();
          foreach ($news as $new ) {
            $new->username = DB::table('homeuser')->where('id','=',$new->uid)->value('name');
            $new->usericon = DB::table('homeuserinfo')->where('uid','=',$new->uid)->value('icon');
            $new->images = DB::table('photoes')->where('mid',$new->id)->pluck('PhotosUrl');
            $new->countcom = DB::table('comment')->where('mid','=',$new->id)->count();
            $new->uid = Hashids::encode($new->uid);
            $new->hid = Hashids::encode($new->id);
            $new->bid = Hashids::encode($id);
          }
          break;
    }
    return response()->json($news);
  }
// 返回news,用户收藏统计,用户点赞统计,统计数据
  public function contentCount(){
    $search = $_GET['search'];
    switch ($search) {
      case 'index':
        $count = Content::count();
        break;
      case 'mycollect':
        $id = Cookie::get('UserId');
        $count = DB::table('user_collect')->where('user_id',$id)->pluck('collect_id')->count();
        break;
      case 'myfavtimes':
        $id = Cookie::get('UserId');
        $count = DB::table('user_favtimes')->where('user_id',$id)->pluck('favtimes_id')->count();
        break;
    }
    return $count;
  }

  public function publishComments(){
    $id = Hashids::decode($_GET['id'])[0];
    $pucoms = DB::table('comment')->where('mid','=',$id)->orderBy('created_at','desc')->get();
    foreach ($pucoms as $pucom){
        $pucom->uname = DB::table('homeuser')->where('id','=',$pucom->uid)->value('name');
        $pucom->usericon = DB::table('homeuserinfo')->where('uid','=',$pucom->uid)->value('icon');
        $muid = Content::where('id',$pucom->mid)->value('uid');
        $guid = Cookie::get('UserId');
        $pucom->hid = Hashids::encode($pucom->id);
        $pucom->nuid = Hashids::encode($pucom->uid);
        if ( $muid == $guid || $pucom->uid == $guid ) {
          $pucom->del = 1;
        }else{
          $pucom->del = 0;
        }

        $pucom->two = DB::table('comments')->where('cid',$pucom->id)->get();
        foreach($pucom->two as $v ){
          $v->uname = DB::table('homeuser')->where('id','=',$v->uid)->value('name');
          $v->hid = Hashids::encode($v->id);
          $v->nuid = Hashids::encode($v->uid);
        }
    }
    return response()->json($pucoms);
  }

  public function publishIssue(Request $request){
    $id = Cookie::get('UserId');
    $data = $request->all();
    $data['uid'] = $id;
    $data['mid'] = Hashids::decode($data['mid'])[0];
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $newid = DB::table('comment')->insertGetId($data);
    $result = DB::table('comment')->where('id','=',$newid)->get();
    $result[0]->uuid = Hashids::encode($result[0]->uid);
    $result[0]->hid = Hashids::encode($newid);
    return response()->json($result);
  }

  public function twopublishIssue(Request $request){
    $id = Cookie::get('UserId');
    $data = $request->all();
    $data['uid'] = $id;
    $data['cid'] = Hashids::decode($data['cid'])[0];
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $newid = DB::table('comments')->insertGetId($data);
    $result = DB::table('comments')->where('id','=',$newid)->get();
    $result[0]->uuid = Hashids::encode($result[0]->uid);
    $result[0]->hid = Hashids::encode($newid);
    return response()->json($result);
  }

  public function contentPos(Request $request){
    if (!empty($_GET['pos'])) {
      $id = Hashids::decode($_GET['pos'])[0];
      $news = DB::table('news');
      $favtimes = $news->where('id','=',$id)->value('collect');
      $favtimes++;
      $news->where('id','=',$id)->update(['collect'=>$favtimes]);
      DB::table('user_collect')->insert(
        ['user_id'=>Cookie::get('UserId'),'collect_id'=>$id]
      );
    }else if(!empty($_GET['posdie'])){
      $id = Hashids::decode($_GET['posdie'])[0];
      $news = DB::table('news');
      $favtimes = $news->where('id','=',$id)->value('collect');
      $favtimes--;
      $news->where('id','=',$id)->update(['collect'=>$favtimes]);
      DB::table('user_collect')->where('user_id','=',Cookie::get('UserId'))->where('collect_id','=',$id)->delete();
    }else{
      return false;
    }
  }

  public function contentGood(Request $request){
    if (!empty($_GET['good'])) {
      $id = Hashids::decode($_GET['good'])[0];
      $news = DB::table('news');
      $favtimes = $news->where('id','=',$id)->value('favtimes');
      $favtimes++;
      $news->where('id','=',$id)->update(['favtimes'=>$favtimes]);
      DB::table('user_favtimes')->insert(
        ['user_id'=>Cookie::get('UserId'),'favtimes_id'=>$id]
      );
    }else if(!empty($_GET['gooddie'])){
      $id = Hashids::decode($_GET['gooddie'])[0];
      $news = DB::table('news');
      $favtimes = $news->where('id','=',$id)->value('favtimes');
      $favtimes--;
      $news->where('id','=',$id)->update(['favtimes'=>$favtimes]);
      DB::table('user_favtimes')->where('user_id','=',Cookie::get('UserId'))->where('favtimes_id','=',$id)->delete();
    }else{
      return false;
    }
  }

  public function contentFindcollect(Request $request){
    $uid = Cookie::get('UserId');
    $collectdb = DB::table('user_collect');
    $favtimesdb = DB::table('user_favtimes');

    $results['collect'] = $collectdb->where('user_id','=',$uid)->pluck('collect_id');
    $results['favtimes'] = $favtimesdb->where('user_id','=',$uid)->pluck('favtimes_id');

    foreach($results as $result){
      for ($i=0; $i < count($result); $i++) {
        $result[$i] = Hashids::encode($result[$i]);
      }
    }
    return response()->json($results);
  }

  public function contentDel(){
    $mid = Hashids::decode( $_GET['mid'] )[0];
    $result = Content::where('id',$mid)->delete();
    if($result == 0){

    }else{
      DB::table('comment')->where('mid',$mid)->delete();
      DB::table('photoes')->where('mid',$mid)->delete();

    }
  }

  public function oneglyDel(){
    $id = Hashids::decode( $_GET['onegly'] )[0];
    DB::table('comment')->where('id',$id)->delete();
  }

  public function contentImg(Request $request){
    $basename = 'image/'.date("Y/m/d/",time());
    $filename = date("Ymd-His-",time()).uniqid().$_FILES['file']['name'];
    if ( is_dir($basename) ) {
    }else{
      mkdir($basename);
    }
    if( move_uploaded_file($_FILES['file']['tmp_name'], $basename . $filename) ){
      $uid = Cookie::get('UserId');
      $aid = DB::table('photomanage')->where('uid',$uid)->where('AlbumName','默认')->value('id');
      $url = $basename . $filename;
      $CreateTime = date("Y-m-d H:i:s-",time());
      $id = DB::table('photoes')->insertGetId(
          ['Aid'=>$aid,'PhotosName'=>$filename,'PhotosUrl'=>$url,'CreateTime'=>$CreateTime]
      );
      DB::table('news_photo')->insert(
        ['uid'=>$uid,'photo_id'=>$id]
      );
    }
  }

}
