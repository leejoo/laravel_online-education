<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
	protected $table = 'user';//��ʵ����
	protected $primarykey = 'id';//�����ֶΣ�Ĭ��id
	protected $fillable = ['name','password'];//���Բ������ֶ�
	protected $tiemsamps = false;
}

