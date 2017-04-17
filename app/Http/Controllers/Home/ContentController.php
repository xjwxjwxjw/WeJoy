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
      $data['mid'] = UUID::generate();
      $data['uid'] = Cookie::get('UserId');
      $data['content'] = $_POST['content'];
      $data['created_at'] = date('Y-m-d H:i:s');
      $data['updated_at'] = date('Y-m-d H:i:s');
      $ids = Content::insertGetId( $data );
      if ( !empty( $ids ) ) {
        $newcontent = Content::find($ids);
        $newcontent->hid = Hashids::encode($newcontent->id);
        return response()->json($newcontent);
      }
    }

  }

  public function contentFind(Request $request){
    $skip = $_GET['skip'];
    if ( $skip == 0 ) {
      $count = Content::count();
    }

    $news = Content::skip(0)->take(5)->orderBy('id', 'desc')->get();
    foreach ($news as $new ) {
      $new->username = DB::table('homeuser')->where('id','=','4')->value('name');
      $new->countcom = DB::table('comment')->where('mid','=',$new->id)->count();
      $new->uid = Hashids::encode($new->uid);
      $new->hid = Hashids::encode($new->id);
    }
    return response()->json($news);
  }

  public function publishComments(Request $request){
    $id = Hashids::decode($_GET['id'])[0];
    $pucoms = DB::table('comment')->where('mid','=',$id)->orderBy('created_at','desc')->get();
    foreach ($pucoms as $pucom){
      $pucom->uname = DB::table('homeuser')->where('id','=',$pucom->uid)->value('name');
      $pucom->hid = Hashids::encode($pucom->id);
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

}
