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
        return response()->json($newcontent);
      }
        // context.Response.StatusCode = 500;
    }

  }

  public function contentFind(Request $request){
    $skip = $_GET['skip'];
    // if ( $skip == 0 ) {
    //   $count = Content::count();
    // }
    $news = Content::skip($skip)->take(5)->orderBy('id', 'desc')->get();
    foreach ($news as $new ) {
      $new->username = DB::table('homeuser')->where('id','=','4')->value('name');
    }
    // $news->count = $count;
    // dd($news->count);
    return response()->json($news);

  }

  public function publishComments(Request $request){
    $id = $_GET['id'];

    $pucoms = DB::table('comment')->where('mid','=',$id)->orderBy('created_at','desc')->get();
    foreach ($pucoms as $pucom){
      $pucom->uname = DB::table('homeuser')->where('id','=',$pucom->uid)->value('name');
    }
    return response()->json($pucoms);
  }

  public function publishIssue(Request $request){
    $id = Cookie::get('UserId');
    $data = $request->all();
    $data['uid'] = $id;
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $newid = DB::table('comment')->insertGetId($data);
    $result = DB::table('comment')->where('id','=',$newid)->get();
    return response()->json($result);
  }

}
