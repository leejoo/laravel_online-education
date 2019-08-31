<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;


class TestController extends Controller{

	public function index() {
		return view('index',["name"=>"hah"]);
	}

	public function login() {
		return "ok";
	}


	public function add(Request $request) {

		if($request->isMethod('post')){
			dd($request->all());
		}else{
			return view('add');
		}
		
	}
	
}