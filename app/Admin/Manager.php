<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
//引入trait
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
	protected $table = 'manager';//真实表名
	protected $primarykey = 'id';//主键字段，默认id

	//使用trait  相当于复制代码
	use Authenticatable;

	//定义与角色模型的关联模型

	public function role() {
		return $this->hasOne('App\Admin\Role',"id","role_id");
	}
}
