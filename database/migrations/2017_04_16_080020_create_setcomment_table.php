<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetcommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('uid');
            $table->string('mid');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('uid');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('comment_comments', function (Blueprint $table) {
            $table->integer('comment_id')->unsigned();
            $table->integer('comments_id')->unsigned();

            $table->foreign('comment_id')->references('id')->on('comment')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comments_id')->references('id')->on('comments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['comment_id', 'comments_id']);
        });

        //
        Schema::create('news_comment', function (Blueprint $table) {
            $table->increments('mid')->unsigned();
            $table->increments('comment_id')->unsigned();

            $table->foreign('news')->references('id')->on('news')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comment')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['mid', 'comment_id']);

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
