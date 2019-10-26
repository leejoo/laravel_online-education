<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\Admin\Auth;

class AuthController extends Controller
{
    //
	public function index() {
		$data = Auth::array_to_object(Auth::toFormatTree(Auth::get(),'auth_name'));
		
		//dd($data);
		return view('admin.auth.index',compact('data'));
	}

	public function add() {
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$res = Auth::insert($data);
			return $res?"1":"0";
		}
		$pid = Input::get('pid');

		$menus = Auth::toFormatTree(Auth::get(),'auth_name');
		if (!empty($menus)) {
			$menus = array_merge(array(0 => array('id' => 0, 'title_show' => '顶级菜单')), $menus);
		} else {
			$menus = array(0 => array('id' => 0, 'title_show' => '顶级菜单'));
		}
		$menus = Auth::array_to_object($menus);

		$list = Auth::where("pid","=","0")->get();
		
		if($pid){
			$info = Auth::where("id","=",$pid)->first();
		}else{
			$info =[];
		}
		

		return view('admin.auth.add',compact(['list','menus','info']));
	}

	public function edit() {
		$id = Input::get('id');
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			
			$res = Auth::where("id","=",$id)->update($data);
			return $res?"1":"0";
		}
		$list = Auth::where("id","=",$id)->first();
		$channel = Auth::where("pid","=","0")->get();
		return view('admin.auth.edit',compact(['list','channel']));
	}


	public function del() {
		$id = Input::get('id');
		$res = Auth::where('id', '=',$id)->forceDelete();
		return $res?"1":"0";
	}
}
