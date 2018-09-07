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
// Route::get('/','[控制器]@[行为]');
//
// Route::group(['prefix'=>'posts'],function(){
//     Route::get('/','PostController@index');
// });




// 用户模块
// 主页页面
Route::get('/register','RegisterController@index')->name('register');
// 注册行为
Route::post('/register','RegisterController@register');
// 登录页面
Route::get('/login','LoginController@index')->name('login');
// 登陆行为
Route::post('/login','LoginController@login');
// 登出行为
Route::get('/logout','LoginController@logout');


Route::group(['middleware' => 'login'], function() {

// 个人设置页面
    Route::get('/user/setting','UserController@setting');
// 个人设置操作

// 文章列表页
    Route::get('/posts','PostController@index');

// 创建文章
    Route::get('/posts/create','PostController@create');
    Route::post('/posts','PostController@store');

// 图片上传
    Route::post('/posts/img/upload','PostController@imageUplode');

// 文章详情页
    Route::get('/posts/{posts}','PostController@show');

// 编辑页面
    Route::get('/posts/{posts}/edit','PostController@edit');

// 更新文章详情页面
    Route::put('/posts/{posts}','PostController@update');

// 删除文章
    Route::get('/posts/{posts}/delete','PostController@delete');

// 提交评论
    Route::post('/posts/{posts}/comment','PostController@comment');

// 点赞
    Route::get('/posts/{posts}/zan','PostController@zan');

    Route::get('/posts/{posts}/unzan','PostController@unzan');

// 搜索
    Route::post('/posts/search','PostController@search');

// 个人中心
    Route::get('/user/{user}','UserController@show');

    Route::post('/user/{user}/fan','UserController@fan');

    Route::post('/user/{user}/unfan','UserController@unfan');


// 专题详情页
    Route::get('/topic/{topic}','TopicController@show');
// 投稿
    Route::get('/topic/{topic}/submit','TopicController@submit');

    // 通知
    Route::get('/notices','NoticeController@index');
});

include_once('admin.php');


