<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Newtype extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'newtype';
    protected $primaryKey = 'id';
    protected $fillable = ['description'];
}
