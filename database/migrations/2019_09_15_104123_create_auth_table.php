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
			$table->string('auth_name',20)->notNull();//Ȩ������
			$table->string('controller',40)->nullable();//�������ļ���
			$table->string('action',30)->nullable();//Ȩ�޶�Ӧ�ķ�������
			$table->tinyInteger('pid');//����Ȩ��ID
            $table->enum('is_nav',[1,2])->notNull()->default(2);//�˵���ʾ
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
