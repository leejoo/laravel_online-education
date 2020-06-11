<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';//真实表名
	protected $primarykey = 'id';//主键字段，默认id
}
