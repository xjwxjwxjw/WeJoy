<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // 创建一个角色表
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');   //自增id
            $table->string('name')->unique();   //角色名称
            $table->string('display_name')->nullable(); //描述名称
            $table->string('description')->nullable();  //对当前角色描述
            $table->timestamps();
        });

        // 创建中间表用户角色表
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned(); //用户id关联到用户表
            $table->integer('role_id')->unsigned(); //角色id关联到角色表

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // 创建权限表
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // 创建一个角色权限表
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();   //权限id
            $table->integer('role_id')->unsigned(); //角色id

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
