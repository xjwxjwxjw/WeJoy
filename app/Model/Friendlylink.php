<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Friendlylink extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'friendlylink';
    protected $primaryKey = 'id';
    protected $fillable = ['name','url'];
}
