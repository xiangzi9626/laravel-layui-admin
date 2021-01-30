<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/',function (){return redirect('/login');});
//注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//提交注册
Route::post('/register','\App\Http\Controllers\RegisterController@register');

//登录页面
Route::get('/login','\App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login','\App\Http\Controllers\LoginController@login');
Route::group(['middleware'=>'auth:web'],function (){
    Route::get('/logout','\App\Http\Controllers\LoginController@logout');
//个人中心设置
    Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
    Route::post('/user/me/settingStore','\App\Http\Controllers\UserController@settingStore');
//文字列表页
    Route::get('/posts','\App\Http\Controllers\PostController@index');
//文章详情页
    Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');
//创建文章页
    Route::get('/post/create','\App\Http\Controllers\PostController@create');
    Route::any('/posts/create','\App\Http\Controllers\PostController@create');
    Route::post('/posts/store','\App\Http\Controllers\PostController@store');
//编辑文章
    Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
    Route::put('/posts/update/{post}','\App\Http\Controllers\PostController@update');
//删除文章页面
    Route::get('/posts/{post}/del','\App\Http\Controllers\PostController@del');
//上传图片
    Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');
//提交评论
    Route::post('/posts/{post}/comment','\App\Http\Controllers\PostController@commentStore');
//赞
    Route::get('/posts/{post}/zan','\App\Http\Controllers\PostController@zan');
    Route::get('/posts/{post}/unzan','\App\Http\Controllers\PostController@unzan');
    //专题详情
    Route::get('/topic/{topic}','\App\Http\Controllers\TopicController@show');
    //专题投稿
    Route::get('/topic/{topic}/submit','\App\Http\Controllers\TopicController@submit');
    //个人中心
    Route::get('/user/{user}','\App\Http\Controllers\UserController@show');
    //关注
    Route::post('/user/{user}/fan','\App\Http\Controllers\UserController@fan');
    //取消关注
    Route::post('/user/{user}/unfan','\App\Http\Controllers\UserController@unfan');
});
include_once ('admin.php');




