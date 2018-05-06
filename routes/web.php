<?php

/*
 * 在控制器使用权限:
 * if(!Auth::user()->can('admin.create')){
 *      reture 403;
 * }
 *
 * 视图按钮是否显示:
    @role('admin')
        <a href="">删除</a>   //只有admin角色能操作
    @endrole

    @permission('manage-admins')
        <a href="">删除</a>   //只有有manage-admins权限能操作
    @endpermission
 *
 * 使用角色设置权限:
 * Route::resource('admin','Main\AdminsController')->middleware('role:root');
 *
 * 使用权限设置权限
Route::get('user/{user}','Main\UsersController@down')->name('down')->middleware('permission:down');
 */

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
Route::resource('admin','Main\AdminsController')->middleware('role:root');
//修改密码
Route::get('modify','Main\AdminsController@modify')->name('modify');
Route::post('modify','Main\AdminsController@modify')->name('set_modify');
//后台首页
Route::resource('home','Main\HomesController');
//查看
Route::get('review/{review}','Main\ReviewsController@review')->name('review')->middleware('permission:review');
//禁用
Route::get('disabled/{disabled}','Main\DisabledsController@disabled')->name('disabled')->middleware('permission:disabled');
//启用
Route::get('enable/{enable}','Main\DisabledsController@enable')->name('enable')->middleware('permission:enable');
//图片上传
Route::post('/upload','Main\UploaderController@upload');
//活动管理
Route::resource('activity','Main\ActivityController');
//统计
Route::get('/order_count','Main\CountController@order_count')->name('order_count')->middleware('permission:order_count');
Route::get('/goods_count','Main\CountController@goods_count')->name('goods_count')->middleware('permission:goods_count');
//会员管理
Route::get('/users','Main\UsersController@index')->name('users.index')->middleware('permission:users.index');
//权限管理
Route::resource('permit','Main\PermitController')->middleware('role:root');
//添加角色
Route::resource('role','Main\RoleController')->middleware('role:root');
//会员管理
Route::get('user/{user}','Main\UsersController@down')->name('down')->middleware('permission:down');
//菜单管理
Route::resource('menu','Main\MenusController')->middleware('role:root');

//抽奖活动
Route::resource('event','Main\EventController');
//活动奖品
Route::resource('event_prize','Main\Event_prizeController');
//开始抽奖
Route::get('/start_prize/{start_prize}','Main\EventController@start_prize')->name('start_prize');
//查看中奖名单
Route::get('/show_members/{show_members}','Main\EventController@show_members')->name('show_members');