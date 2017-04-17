<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeuserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeuserinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('icon');
            $table->integer('sex')->default(3);
            $table->string('name');
            $table->string('qq');
            $table->string('address');
            $table->string('birthday');
            $table->string('signature');
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
