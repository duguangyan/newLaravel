<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //个人设置页面
    public function setting(){
        return view('user.setting');
    }
    // 个人设置行为
    public function settingStore(){

    }

    // 个人中心页面
    public function show(Users $user){
        // 这个人信息，包含关注/粉丝/文章数
        $user = Users::withCount(['stars','fans','posts'])->find($user->id);

        // 这个人的文章列表，取创建时间最新的前10条
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        // 这个人关注的用户，包含关注用户的 关注/粉丝/文章数
        $stars = $user->stars();
        $susers = Users::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //  关注这个人的用户，包含粉丝用户的 关注/粉丝/文章数
        $fans = $user->fans();
        $fusers = Users::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user.show',compact('user','posts','susers','fusers'));
    }
    //关注用户
    public function fan(Users $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return [
            'error'=> 0,
            'msg'  => ''
        ];

    }

    //取消关注
    public function unfan(Users $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return [
            'error'=> 0,
            'msg'  => ''
        ];
    }
}
