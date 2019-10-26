<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends Controller
{
    //สืาณ
	public function index() {
		return view('admin.index.index');
	}

	//ปถำญาณรๆ
	public function welcome() {
		
		return view('admin.index.welcome');
	}
}
