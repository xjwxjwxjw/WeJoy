<?php

namespace App\Http\Controllers\Home;

use App\Model\Content;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContentController extends Controller
{
  public function contentAdd(Request $request){
    $data['mid'] = UUID::generate();
    $data['uid'] = '4';
    Content::create( array_merge($request->all(), $data) );
  }

  public function contentFind(Request $request){

    $news = Content::all();
    return response()->json($news);
  }

}
