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
// Route::get('/','[������]@[��Ϊ]');
//
// Route::group(['prefix'=>'posts'],function(){
//     Route::get('/','PostController@index');
// });




// �û�ģ��
// ��ҳҳ��
Route::get('/register','RegisterController@index')->name('register');
// ע����Ϊ
Route::post('/register','RegisterController@register');
// ��¼ҳ��
Route::get('/login','LoginController@index')->name('login');
// ��½��Ϊ
Route::post('/login','LoginController@login');
// �ǳ���Ϊ
Route::get('/logout','LoginController@logout');


Route::group(['middleware' => 'login'], function() {

// ��������ҳ��
    Route::get('/user/setting','UserController@setting');
// �������ò���

// �����б�ҳ
    Route::get('/posts','PostController@index');

// ��������
    Route::get('/posts/create','PostController@create');
    Route::post('/posts','PostController@store');

// ͼƬ�ϴ�
    Route::post('/posts/img/upload','PostController@imageUplode');

// ��������ҳ
    Route::get('/posts/{posts}','PostController@show');

// �༭ҳ��
    Route::get('/posts/{posts}/edit','PostController@edit');

// ������������ҳ��
    Route::put('/posts/{posts}','PostController@update');

// ɾ������
    Route::get('/posts/{posts}/delete','PostController@delete');

// �ύ����
    Route::post('/posts/{posts}/comment','PostController@comment');

// ����
    Route::get('/posts/{posts}/zan','PostController@zan');

    Route::get('/posts/{posts}/unzan','PostController@unzan');

// ����
    Route::post('/posts/search','PostController@search');

// ��������
    Route::get('/user/{user}','UserController@show');

    Route::post('/user/{user}/fan','UserController@fan');

    Route::post('/user/{user}/unfan','UserController@unfan');


// ר������ҳ
    Route::get('/topic/{topic}','TopicController@show');
// Ͷ��
    Route::get('/topic/{topic}/submit','TopicController@submit');

    // ֪ͨ
    Route::get('/notices','NoticeController@index');
});

include_once('admin.php');


