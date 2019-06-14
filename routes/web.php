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
