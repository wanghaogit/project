<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//前台登录路由

//登录表单
Route::get("/login","LoginController@login");
//执行登陆
Route::post("/dologin","LoginController@dologin");
//执行退出
Route::get("/logout",function(){
	session()->forget('user');
	return redirect('/');
});
//注册表单
Route::get("/enroll","EnrollController@enroll");
//执行注册
Route::resource("/doenroll","EnrollController");

Route::get('/', function () {
    return view('index');
});
// 前台手机遍历
Route::resource("/phone","PhoneController");
//前台电脑遍历
Route::resource("/computer","ComputerController");









//后台登录
Route::get('/admin',function(){
	return view('admin.login');
});

//查看验证码
// Route::get("code/{tttttmp}","DemoController@captcha");

//后台界面 需要登录才能访问的内容 
	Route::group(["prefix"=>"admin","middleware"=>"myauth"],function(){

		Route::get("index","Admin\IndexController@index");//网站后台首页

		Route::get("logout","Admin\LoginController@logout");//执行退出 
		Route::resource("stu","Admin\StuController");//用户信息增删改查
		Route::resource("goods","Admin\GoodsController"); //商品管理
		// Route::get("zhuan","Admin\GoodsController@zhuan");	//成功后指向
		Route::get("zhuan","Admin\StuController@zhuan");//执行成功的跳转

	});


//1 登录表单 
	Route::get("admin/login","Admin\LoginController@login");
//2 执行登录 
	Route::post("admin/dologin","Admin\LoginController@dologin");
//3 验证码
	Route::get("admin/captcha/{tmp}","Admin\LoginController@captcha");



