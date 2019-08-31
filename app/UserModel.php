<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
	protected $table = 'user';//真实表名
	protected $primarykey = 'id';//主键字段，默认id
	protected $fillable = ['name','password'];//可以操作的字段
	protected $tiemsamps = false;
}

