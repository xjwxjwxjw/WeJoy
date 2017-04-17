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
      $data['uid'] = Cookie::has('UserId');
      $data['content'] = $_POST['content'];
      $data['created_at'] =date('Y-m-d H:i:s');
      $data['updated_at'] =date('Y-m-d H:i:s');
      $ids = Content::insertGetId( $data );
      if ( !empty( $ids ) ) {
        $newcontent = Content::find($ids);
        return response()->json($newcontent);
      }
        // context.Response.StatusCode = 500;
    }

  }

  public function contentFind(Request $request){
    // $skip = $_GET['skip'];
    // if ( $skip == 0 ) {
    //   $count = Content::count();
    // }
    // $news = Content::skip($skip)->take(5)->get();
    // foreach ($news as $new ) {
    //   $new->username = DB::table('homeuser')->where('id','=','4')->value('name');
    // }
    // $news->count = $count;
    // dd($news->count);
    // return response()->json($news);
    // return response()->json($news);
    return true;

  }

}
