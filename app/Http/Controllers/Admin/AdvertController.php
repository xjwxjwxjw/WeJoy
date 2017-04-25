<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Advert;
use Intervention\Image\Facades\Image;

class AdvertController extends Controller
{

  // 显示首页内容
  public function newsIndex()
  {
    if( empty($_GET['search']) ){
      $newlist = Advert::paginate(5);
      return view('admin.index',['tasks'=>$newlist , 'content' => '/admin/advert/content']);
    } else {
      $search = $_GET['search'];
      $newlist = Advert::where('name','like','%'.$search.'%')->paginate(5);
      return view('admin.index',['tasks'=>$newlist ,'keepsearch'=>$search , 'content' => '/admin/advert/content']);
    }
  }

  public function delete() {
    $id = $_GET['id'];
    $result = Advert::where('id','=',$id)->delete();

  }

  public function advertAdd(Request $request)
  {
      if ($request->isMethod('post')) {
          $request = $request->toArray();
          $basename = 'image/advert/';
          $filename = date("Ymd-His-",time()).uniqid().$_FILES['src']['name'];
          $data['name'] = $request['name'];
          $data['url'] = $request['url'];
          $data['src'] = $filename;
          if( move_uploaded_file($_FILES['src']['tmp_name'], $basename . $filename) ){
            $permission = Advert::create($data);
            return redirect('admin/advert');
          }
      }

  }

  public function advertfind($id)
  {
      $newtype = Advert::where('id','=',$id)->get();
      return response()->json($newtype);
  }

  //修改分类
  public function advertUpdate(Request $request, $id)
  {
      //修改用户信息
      if ($request->isMethod('post')) {
          $request = $request->toArray();
          $basename = 'image/advert/';
          $filename = date("Ymd-His-",time()).uniqid().$_FILES['src']['name'];
          $data['name'] = $request['name'];
          $data['url'] = $request['url'];
          $data['src'] = $filename;
          if( move_uploaded_file($_FILES['src']['tmp_name'], $basename . $filename) ){
            Image::make($basename.$filename)->fit(167)->save($basename.'167_'.$filename);
            $src = Advert::findOrFail($id)->value('src');
            if ( file_exists( $basename.$src ) ) {
              unlink($basename .$src);
            }
          }
          Advert::where('id',$id)->update( $data );
      }
      return redirect('admin/advert');
  }

}
