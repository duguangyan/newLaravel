<?php

namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{

    // 登录页面
    public function index(){
        return view('login.index');
    }
    // 用户登录Ϊ
    public function login(){
        // 验证
        $this->validate(request(),[
            'email'       =>'required|email',
            'password'    => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);
        // 逻辑
        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        session()->put('user',request('email'));
        if($is_remember){
            session()->put('user_email',request('email'));
            session()->put('user_password',request('password'));
        }else{
            session()->put('user_email','');
            session()->put('user_password','');
        }
        if(Auth::attempt($user,$is_remember)) return redirect('/posts');
        // 渲染
        return back()->withErrors("邮箱或密码不正确");
    }
    // 页面登出
    public function logout(){
        // Auth::logout();
        session()->put('user',null);
        return redirect('login');
    }
}
