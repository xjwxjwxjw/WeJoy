<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class InAlbumController extends Controller
{
    public function photo($id = 'my',$Aid){
        if($id == 'my'){
            dd(1);
//            访问自己的
            $album = Album::all()->where('uid',Cookie::get('UserId'))->toArray();
            return view('home.user.selfphoto',compact('album'));
        }else{
            dd(2);
//            访问别人的
            $id = Hashids::decode($id)[0];
            $album = Album::all()->where('uid',$id)->toArray();
            return view('home.user.photo',compact('id','album'));
        }
    }
}
