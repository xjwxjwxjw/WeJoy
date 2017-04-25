<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'Announcement';
    protected $primaryKey = 'id';
    protected $fillable = ['description'];
}
