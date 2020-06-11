<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
	protected $table = 'role';//真实表名
	public $timestamps = false;//禁用时间
	//protected $primarykey = 'id';//主键字段，默认id

	protected function changeAuth($data) {
		$post["auth_ids"] = implode(",",$data["auth_ids"]);
		$auth_ac = \App\Admin\Auth::where("pid","!=",0)->whereIn('id',$data["auth_ids"])->get();
		$ac = '';
		if($auth_ac){
			foreach ($auth_ac as $k=>$v){
				$ac .=$v->controller."@".$v->action.",";
			}
		}
		$post["auth_ac"] =$ac;
		return self::where("id","=",$data["id"])->update($post);
	}
}