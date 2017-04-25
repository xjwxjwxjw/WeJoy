<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    //
    protected $table = 'aboutus';
    public $fillable = ['infor','service','advantage','contact'];
    public $timestamps = false;
}
