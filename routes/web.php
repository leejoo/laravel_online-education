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

//ǰ̨��ҳ
	Route::get('/','Front\IndexController@index');
	Route::get('/view','Front\IndexController@view');

//��̨·��

Route::group(['prefix'=>'admin'], function () {
	//��̨��¼ҳ��
	Route::get('public/login','Admin\PublicController@login')->name('login');

	//��̨��¼����
    Route::post('public/login','Admin\PublicController@login');

	Route::get('public/logout','Admin\PublicController@logout');
	
});

//��Ҫ��¼��֤��
Route::group(['prefix'=>'admin','middleware' => ['auth:admin','checkrbac']], function () {
	//��̨��ҳ
	Route::get('index/index','Admin\IndexController@index');
	Route::get('index/welcome','Admin\IndexController@welcome');

	//�û�����
	Route::any('manager/index','Admin\ManagerController@index');
	Route::any('manager/add','Admin\ManagerController@add');
	Route::any('manager/edit','Admin\ManagerController@edit');
	Route::post('manager/del','Admin\ManagerController@del');
	Route::post('manager/status','Admin\ManagerController@status');//״̬


	//Ȩ�޹���
	Route::get('auth/index','Admin\AuthController@index');
	Route::any('auth/add','Admin\AuthController@add');
	Route::any('auth/edit','Admin\AuthController@edit');
	Route::post('auth/del','Admin\AuthController@del');

	//��ɫ����
	Route::get('role/index','Admin\RoleController@index');
	Route::any('role/add','Admin\RoleController@add');
	Route::any('role/edit','Admin\RoleController@edit');
	Route::post('role/del','Admin\RoleController@del');
	Route::any('role/assign','Admin\RoleController@assign');//��ɫ��Ȩ
	

	//���Ź���
	Route::get('news/index','Admin\NewsController@index');
	Route::any('news/add','Admin\NewsController@add');
	Route::any('news/edit','Admin\NewsController@edit');
	Route::post('news/del','Admin\NewsController@del');
});
