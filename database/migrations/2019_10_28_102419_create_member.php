<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
			
            $table->increments('id');//自增主键
			$table->string('username',20)->notNull();//
			$table->string('password')->notNull();
			$table->enum('gender',[1,2,3])->notNull()->default(1);
			$table->string('mobile',11);
			$table->string('email',50);
			$table->string('avatar',255);
            $table->timestamps();//created_at updated_at系统自己创建
			$table->rememberToken();//实现记住登录状态的字段
			$table->enum('type',[1,2])->notNull()->default(1);//账号类型
			$table->enum('status',[1,2])->notNull()->default(1);//账号状态

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表
        Schema::dropIfExists('member');
    }
}
