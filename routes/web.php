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
//管理员注册
//Route::get('register', 'Register\RegistersController@create')->name('register');//注册
//Route::post('register', 'Register\RegistersController@store')->name('register');

Route::get('/',function (){
    return view('Login.create');
});
//分类
Route::resource('category','Main\CategoryController');
//登录和注销
Route::get('login', 'Login\LoginsController@create')->name('login');//登录表单
Route::post('login', 'Login\LoginsController@store')->name('login');//登录验证
Route::delete('logout', 'Login\LoginsController@destroy')->name('logout');//注销
//管理员的crud
Route::resource('admin','Main\AdminsController');
//修改密码
Route::get('modify','Main\AdminsController@modify')->name('modify');
Route::post('modify','Main\AdminsController@modify')->name('set_modify');
//后台首页
Route::resource('home','Main\HomesController');
//查看
Route::get('review/{review}','Main\ReviewsController@review')->name('review');
//禁用
Route::get('disabled/{disabled}','Main\DisabledsController@disabled')->name('disabled');
//启用
Route::get('enable/{enable}','Main\DisabledsController@enable')->name('enable');
//图片上传
Route::post('/upload','Main\UploaderController@upload');
//活动管理
Route::resource('activity','Main\ActivityController');