<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'advert';
    protected $primaryKey = 'id';
    protected $fillable = ['name','url','src'];
}
