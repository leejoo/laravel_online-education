<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//后台路由

Route::group(['prefix'=>'admin'], function () {
	//后台登录页面
	Route::get('public/login','Admin\PublicController@login')->name('login');

	//后台登录处理
    Route::post('public/login','Admin\PublicController@login');
});

//需要登录验证的
Route::group(['prefix'=>'admin','middleware' => 'auth:admin'], function () {
	//后台首页
	Route::get('index/index','Admin\IndexController@index');
	Route::get('index/welcome','Admin\IndexController@welcome');

});
