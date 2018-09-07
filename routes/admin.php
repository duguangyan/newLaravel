<?php
/**
 * Created by PhpStorm.
 * User: duguangyan
 * Date: 2018/9/4
 * Time: 11:45
 */

// �����̨
Route::group(['prefix' => 'admin'], function() {
    // ��¼չʾҳ��
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //��¼��Ϊ
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    // �ǳ���Ϊ
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware' => 'auth:admin'], function() {
        //��ҳ
        Route::get('/home','\App\Admin\Controllers\HomeController@index');


        Route::group(['middleware' => 'can:system'],function(){
            // ������Աģ��
            Route::get('/users','\App\Admin\Controllers\UserController@index');
            // �����û�
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');
            Route::post('/users/store','\App\Admin\Controllers\UserController@store');
            Route::get('/users/{users}/role','\App\Admin\Controllers\UserController@role');
            Route::post('/users/{users}/role','\App\Admin\Controllers\UserController@storeRole');


            // ��ɫ
            Route::get('/roles','\App\Admin\Controllers\RoleController@index');
            Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');
            Route::post('/roles/store','\App\Admin\Controllers\RoleController@store');
            Route::get('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');
            Route::post('/roles/{role}/permission','\App\Admin\Controllers\RoleController@storePermission');


            // Ȩ��
            Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');
            Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');
            Route::post('/permissions/store','\App\Admin\Controllers\PermissionController@store');

        });
        Route::group(['middleware' => 'can:post'],function(){
            // ���ģ��
            Route::get('/posts','\App\Admin\Controllers\PostsController@index');
            Route::post('/posts/{posts}/status','\App\Admin\Controllers\PostsController@status');
        });


        Route::group(['middleware' => 'can:topic'],function(){
            // ���ģ��
            Route::resource('topics','\App\Admin\Controllers\TopicController',['only'=>['index','create','store','destroy']]);
        });

        Route::get('/deltopics/{topics}','\App\Admin\Controllers\TopicController@delete');



        Route::group(['middleware' => 'can:notice'],function(){
            // ���ģ��
            Route::resource('notices','\App\Admin\Controllers\NoticeController',['only'=>['index','create','store']]);
        });




    });


});