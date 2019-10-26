<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Manager;
use Input;

class ManagerController extends BaseController
{
    //

	public function index() {
		$data = Manager::orderBy('id','desc')->get();
		return view('admin.manager.index',compact('data'));
	}


	public function add() {
		if(Input::method() == "POST"){
			$res = Manager::insert([
				"username"=>Input::get("username"),
				"password"=>bcrypt(Input::get("password")),
				"gender"=>Input::get("gender"),
				"mobile"=>Input::get("mobile"),
				"email"=>Input::get("email"),
				"role_id"=>Input::get("role_id"),
				"created_at"=>date("Y-m-d H:i:s")
			]);
			return $res?"1":"0";
		}
		return view('admin.manager.add');
	}

	public function del() {
		$id=Input::get("id");
		$res = Manager::where('id', '=',$id)->forceDelete();
		return $res?"1":"0";
	}

	public function status() {
		
		$id=Input::get("id");
		$status=Input::get("status");
		$res = Manager::where('id', '=',$id)->update(['status' => $status]);
		if($res){
			return $this->response(200,[],"ok");
		}else{
			return $this->response(0,[],"ok");
		}
	}
}
