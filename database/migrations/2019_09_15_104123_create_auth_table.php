<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth', function (Blueprint $table) {
            $table->increments('id');
			$table->string('auth_name',20)->notNull();//权限名称
			$table->string('controller',40)->nullable();//控制器文件名
			$table->string('action',30)->nullable();//权限对应的方法名称
			$table->tinyInteger('pid');//父级权限ID
            $table->enum('is_nav',[1,2])->notNull()->default(2);//菜单显示
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth');
    }
}
