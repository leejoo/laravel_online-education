<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
	protected $table = 'role';//真实表名
	public $timestamps = false;//禁用时间
	//protected $primarykey = 'id';//主键字段，默认id
}
