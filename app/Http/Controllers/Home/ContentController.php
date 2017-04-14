<?php

namespace App\Http\Controllers\Home;

use App\Model\Content;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Session;


class ContentController extends Controller
{
  public function contentAdd(Request $request){

    if ($request->isMethod('post') ) {
      $data['mid'] = UUID::generate();
      $data['uid'] = Session::get('UserId');
      $data['content'] = $_POST['content'];
      $ids = Content::insertGetId( $data );
      if ( !empty( $ids ) ) {
        $newcontent = Content::find($ids);
        return response()->json($newcontent);
      }
        // context.Response.StatusCode = 500;
    }

  }

  public function contentFind(Request $request){

    $news = Content::all();
    foreach ($news as $new ) {
       $new->username = DB::table('homeuser')->where('id','=','4')->value('name');
    }
    // return response()->json($news);
  }

}
