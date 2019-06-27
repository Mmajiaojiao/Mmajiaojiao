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

Route::get('/', function () {
    return view('welcome');
});
Route::any('productList','IndexController@productList');
Route::any('cart','IndexController@cart');
Route::get('shopSingle','IndexController@shopSingle');
Route::any('shop','IndexController@shop');
//结账
Route::get('checkout','IndexController@checkout');
//订单列表
Route::any('checkList','IndexController@checkList');
Route::any('checkDo','IndexController@checkDo');
Route::get('login','IndexController@login');
Route::any('login_do','IndexController@login_do');
Route::any('register','IndexController@register');
Route::post('register_do','IndexController@register_do');
Route::get('settings','IndexController@settings');
Route::get('aboutus','IndexController@aboutus');
Route::get('contact','IndexController@contact');
Route::get('wishlist','IndexController@wishlist');
Route::post('pay','AlipayController@pay');
//同
Route::get('return_url','AlipayController@aliReturn');
//异
Route::post('notify_url','AlipayController@aliNotify');
Route::get('quit','AlipayController@quit');

Route::get('/user','IndexController@index');
Route::get('/user','IndexController@admin');
Route::get('/','IndexController@index');
Route::any('/student/student_add','studentController@student_add');
Route::any('/student/add_do','studentController@add_do');
Route::group(['middleware' => 'student'], function(){
	Route::any('/student/student_lists','studentController@student_lists');
});
Route::any('/del','studentController@del');
Route::get('/update','studentController@update');
Route::post('/update_do/{id}','studentController@update_do');

//注册登录
Route::any('/reglog/register','LoginController@register');

Route::group(['middleware' => ['login']], function(){
    Route::any('/reglog/login','LoginController@login');
});
	
Route::any('/reglog/login_do','LoginController@login_do');

Route::any('/add','AdminController@add');
Route::post('/add_do','AdminController@add_do');

Route::get('/adds','studentController@adds');
Route::post('/adds_do','studentController@adds_do');
Route::get('/lists','studentController@lists');
Route::get('/index', function () {
    return view('index');
});
// Route::get('/admin_add',function(){
// 	return view('/admin/admin_add');
// });
Route::any('/admin_add','admin\AdminController@admin_add');
Route::post('/admin_do','admin\AdminController@admin_do');
Route::get('admin_lists','admin\AdminController@admin_lists');
Route::get('admin_del/{id}','admin\AdminController@admin_del');
Route::get('admin_upd/{id}','admin\AdminController@admin_upd');
Route::post('adminUpd_do','admin\AdminController@adminUpd_do');
Route::get('quit','LoginController@quit');
Route::get('stu_add','admin\AdminController@stu_add');
Route::any('stu_do','admin\AdminController@stu_do');
Route::get('stu_list','admin\AdminController@stu_list');
Route::get('stu_del','admin\AdminController@stu_del');
Route::get('stu_upd','admin\AdminController@stu_upd');
Route::post('upd_do','admin\AdminController@upd_do');
