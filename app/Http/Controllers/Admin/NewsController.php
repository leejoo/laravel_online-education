<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\News;
use App\Admin\Auth;
use Input;

class NewsController extends Controller
{
    public function index() {
		
		$data = News::get();
		return view('admin.news.index',compact('data')); 
    }

	public function add() {
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$data["content"] = $data["editorValue"];
			unset($data["editorValue"]);
			$res = News::insert($data);
			return $res?"1":"0";
		}
		return view('admin.news.add');
	}


	public function edit() {
		$id = Input::get("id");
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$data["content"] = $data["editorValue"];
			unset($data["editorValue"]);
			$res = News::where("id","=",$id)->update($data);
			return $res?"1":"0";
		}
		
		$info = News::where("id","=",$id)->first();
		
		return view('admin.news.edit',compact("info"));
	}

	public function del() {
		$id = Input::get('id');
		$res = News::where('id','=',$id)->forceDelete();
		return $res?"1":"0";
	}

	public function assign() {
		if(Input::method() == "POST"){
			$data = Input::except("_token");
			$res = News::changeAuth($data);
			return $res?"1":"0";
		}
		$id = Input::get('id');
		$data = Auth::array_to_object(Auth::toFormatTree(Auth::get(),'auth_name'));
		//dd($data);

		$auth_ids = News::where("id","=",$id)->value('auth_ids');
		$auth_ids = explode(",",$auth_ids);
		return view('admin.news.assign',compact(['data','auth_ids']));
	}
}
