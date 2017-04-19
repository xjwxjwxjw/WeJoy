<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotomanageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photomanage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('AlbumName');
            $table->string('AlbumDescription')->nullable();
            $table->integer('AlbumPermissions')->default(1)->comment('1-公开 2-非公开 3-私密');
            $table->string('FaceUrl')->nullable();
            $table->dateTime('CreateTime');
            $table->dateTime('UpdateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
