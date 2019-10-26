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

	public function assign() {
		if(Input::method() == "POST"){
			
		}
		$data = Auth::array_to_object(Auth::toFormatTree(Auth::get(),'auth_name'));
		//dd($data);
		return view('admin.role.assign',compact('data'));
	}
}
