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
			
            $table->increments('id');//��������
			$table->string('username',20)->notNull();//
			$table->string('password')->notNull();
			$table->enum('gender',[1,2,3])->notNull()->default(1);
			$table->string('mobile',11);
			$table->string('email',50);
			$table->string('avatar',255);
            $table->timestamps();//created_at updated_atϵͳ�Լ�����
			$table->rememberToken();//ʵ�ּ�ס��¼״̬���ֶ�
			$table->enum('type',[1,2])->notNull()->default(1);//�˺�����
			$table->enum('status',[1,2])->notNull()->default(1);//�˺�״̬

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //ɾ��
        Schema::dropIfExists('member');
    }
}
