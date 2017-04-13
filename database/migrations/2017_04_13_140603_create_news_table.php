<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->nullable()->change();;
            $table->string('uid')->nullable()->change();;
            $table->string('content')->nullable()->change();;
            $table->string('topic')->nullable()->change();;
            $table->increments('favtimes')->nullable()->change();;
            $table->increments('comments')->nullable()->change();;
            $table->increments('transmits')->nullable()->change();;
            $table->timestamps();
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
