<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class adminNews extends Model
{

    protected $newsable = ['mid','uid','content','postedtime'];
}
