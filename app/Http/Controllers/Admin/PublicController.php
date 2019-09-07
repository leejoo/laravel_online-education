<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PublicController extends Controller
{
    //登录
	public function login(Request $request) {
		
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'username' => 'required|min:2|max:20',
				'password' => 'required|min:6',
				'captcha' => 'required|size:5|captcha',
			]);

			$result = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password,'status'=>1],$request->online);
			if($result){
				//认证成功
				return redirect()->intended('/admin/index/index');
			}else{
				return redirect()->intended('/admin/public/login');
				//return $validator->errors()->all();
			}
		}
		return view('admin.public.login');
	}
}
