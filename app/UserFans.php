<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFans extends Model
{
//    表名
    protected $table = 'userfans';
//  表黑名单
    protected $guarded = [];
//    取消添加create_at 和 update_at
    public $timestamps = false;
}
