<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = ['mid','uid','content','topic','favtimes','favtimes','comments','transmits'];
}
