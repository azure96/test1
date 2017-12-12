<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//显示登录页面
Route::get('/login', function () {
    return view('book.login');
});

//普通用户注册
Route::get('/add','PeopleController@add');
Route::post('/add','PeopleController@doadd');

//显示普通用户图书列表
Route::get('/','PeopleController@index');

//用户登录
Route::post('/admin','PeopleController@login');

//登录才能操作
Route::group(['middleware'=>'login'],function(){
	//后台首页
	Route::get('admin',function(){
		return view('book.muban.admin');
	});
	//用户的管理
	Route::resource('/user','UserController');

	//分类的管理
	Route::resource('/cate','CateController');

	//图书的管理
	Route::resource('/book','BookController');

	//用户注销
	Route::get('/logout','LogoutController@logout');

	//普通用户查看自己的资料
	Route::get('/myprofile','PeopleController@myprofile');

	//普通用户修改自己的资料
	Route::get('/edit','PeopleController@edit');
	Route::post('/update','PeopleController@update');

	//修改密码
	Route::get('/repassword','PeopleController@repassword');
	Route::post('/updatepassword','PeopleController@updatepassword');

	//借书管理
	Route::get('/borrow/{id}','PeopleController@borrow');
	Route::post('/borrow/{id}','PeopleController@borrowbook');

	//还书管理
	Route::get('/return/{id}','PeopleController@returnbook');
	Route::post('/return/{id}','PeopleController@returnback');

	//我的图书
	Route::get('/mybook','PeopleController@mybook');

	//所有借出的书
	Route::get('/allborrow','PeopleController@allborrow');
});