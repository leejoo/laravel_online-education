<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends Controller
{
    //��ҳ
	public function index() {
		return view('admin.index.index');
	}

	//��ӭҳ��
	public function welcome() {
		
		return view('admin.index.welcome');
	}
}
