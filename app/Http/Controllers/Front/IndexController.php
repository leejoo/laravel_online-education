<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\News;
use Input;

class IndexController extends Controller
{
    //Ê×Ò³
	public function index() {
		$data = News::get();
		return view('front.index.index',compact('data'));
	}

	public function view() {
		$id = Input::get("id");
		$info = News::where("id","=",$id)->first();
		return view('front.index.view',compact("info"));
	}
}
