<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Role;
use App\Admin\Auth;
use Input;

class RoleController extends Controller
{
    public function index() {
		
		$data = Role::get();
		return view('admin.role.index',compact('data')); 
    }

	public function add() {
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$res = Role::insert($data);
			return $res?"1":"0";
		}
		return view('admin.role.add');
	}


	public function edit() {
		$id = Input::get("id");
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$res = Role::where("id","=",$id)->update($data);
			return $res?"1":"0";
		}
		
		$info = Role::where("id","=",$id)->first();
		
		return view('admin.role.edit',compact("info"));
	}

	public function del() {
		$id = Input::get('id');
		$res = Role::where('id', '=',$id)->forceDelete();
		return $res?"1":"0";
	}

	public function assign() {
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$res = Role::changeAuth($data);
			return $res?"1":"0";
		}
		$id = Input::get('id');
		$data = Auth::array_to_object(Auth::toFormatTree(Auth::get(),'auth_name'));
		//dd($data);

		$auth_ids = Role::where("id","=",$id)->value('auth_ids');
		$auth_ids = explode(",",$auth_ids);
		return view('admin.role.assign',compact(['data','auth_ids']));
	}
}
