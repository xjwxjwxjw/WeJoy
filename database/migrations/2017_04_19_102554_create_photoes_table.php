<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Aid');
            $table->string('PhotosName');
            $table->string('PhotosDescription')->nullable();
            $table->string('PhotosUrl');
            $table->integer('isFace')->default(2)->comment('1-封面 2-非封面');
            $table->dateTime('CreateTime ');
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
