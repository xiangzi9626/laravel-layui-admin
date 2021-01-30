<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin'],function (){
    Route::any('/image/upload','\App\Admin\Controllers\PostController@imageUpload');/**@see \App\Admin\Controllers\PostController::imageUpload() */
    Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');
    //登录页面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //登录行为
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    //登出行为
    Route::group(['middleware'=>'auth:admin'],function (){
        //登出行为
        Route::get('/logout','\App\Admin\Controllers\LoginController@logout');
        //主页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');
        //测试
        Route::get('/dome','\App\Admin\Controllers\HomeController@dome');
        Route::group(['middleware'=>'can:system'],function (){
            //管理员模块
            Route::get('/users','\App\Admin\Controllers\UserController@index');
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');
            Route::post('/users/createSubmit','\App\Admin\Controllers\UserController@createSubmit');
            Route::get('/users/{adminUser}/edit','\App\Admin\Controllers\UserController@edit');
            Route::post('/users/{adminUser}/editSubmit','\App\Admin\Controllers\UserController@editSubmit');
            Route::get('/users/{adminUser}/changeStatus','\App\Admin\Controllers\UserController@changeStatus');
            Route::get('/users/{adminUser}/delete','\App\Admin\Controllers\UserController@delete');
            //角色模块
            Route::get('/roles','\App\Admin\Controllers\RoleController@index');
            Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');
            Route::post('/roles/createSubmit','\App\Admin\Controllers\RoleController@createSubmit');
            Route::post('/roles/edit','\App\Admin\Controllers\RoleController@edit');
            Route::get('/roles/editPermission/{adminRole}','\App\Admin\Controllers\RoleController@editPermission');
            Route::post('/roles/editPermissionSubmit/{adminRole}','\App\Admin\Controllers\RoleController@editPermissionSubmit');
            Route::get('/roles/delete/{adminRole}','\App\Admin\Controllers\RoleController@delete');
            Route::post('/roles/deleteAll','\App\Admin\Controllers\RoleController@deleteAll');
            //权限模块
            Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');
            Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');
            Route::post('/permissions/createSubmit','\App\Admin\Controllers\PermissionController@createSubmit');
            Route::post('/permissions/edit','\App\Admin\Controllers\PermissionController@edit');
            Route::get('/permissions/delete/{adminPermission}','\App\Admin\Controllers\PermissionController@delete');
            Route::post('/permissions/deleteAll','\App\Admin\Controllers\PermissionController@deleteAll');
        });
        Route::group(['middleware'=>'can:posts'],function(){
            //文章审核模块
            Route::get('/posts','\App\Admin\Controllers\PostController@index');
            Route::get('/posts/details/{post}','\App\Admin\Controllers\PostController@details');
            Route::get('/posts/edit/{post}','\App\Admin\Controllers\PostController@edit');
            Route::get('/posts/create','\App\Admin\Controllers\PostController@create');
            Route::post('/posts/createSubmit','\App\Admin\Controllers\PostController@createSubmit');
            Route::post('/posts/editSubmit/{post}','\App\Admin\Controllers\PostController@editSubmit');
            Route::post('/posts/changeStatus/{post}','\App\Admin\Controllers\PostController@changeStatus');
            Route::get('/posts/delete/{post}','\App\Admin\Controllers\PostController@delete');
        });
        Route::group(['middleware'=>'can:topics'],function(){
            //专题模块
            Route::get('/topics','\App\Admin\Controllers\TopicController@index');
            Route::get('/topics/create','\App\Admin\Controllers\TopicController@create');
            Route::post('/topics/createSubmit','\App\Admin\Controllers\TopicController@createSubmit');
            Route::post('/topics/edit','\App\Admin\Controllers\TopicController@edit');
            Route::post('/topics/changeStatus/{topic}','\App\Admin\Controllers\TopicController@changeStatus');
            Route::get('/topics/delete/{topic}','\App\Admin\Controllers\TopicController@delete');
        });
    });

});
