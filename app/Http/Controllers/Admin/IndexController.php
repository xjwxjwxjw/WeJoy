<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

  // 显示首页内容
  public function index()
  {
    return view('admin.index',['content' => '/admin/public/content']);
    
  }
}
