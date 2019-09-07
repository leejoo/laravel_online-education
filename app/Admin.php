<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//引入trait
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
	protected $table = 'manager';//真实表名
	protected $primarykey = 'id';//主键字段，默认id

	//使用trait  相当于复制代码
	use Authenticatable;
}
