<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

class LoginController extends Controller
{
    // 登录页
    public function index(){
        return view('admin.login.index');
    }
    // 登录操作
    public function login(){
        // 验证
        $this->validate(request(),[
           'name'=>'required|min:2',
           'password'=>'required|min:5|max:100'
        ]);
        // 逻辑
        $user = request(['name','password']);

        if(\Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }
        // 渲染
        return back()->withErrors('用户名或密码不匹配');

    }
    // 登出操作
    public function logout(){

        \Auth::guard('admin')->logout();
        return redirect('/admin/login');

    }
}