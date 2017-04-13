<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetController extends Controller
{
    public function set()
    {
        return view('home/set');
    }
}
