<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //��������ҳ��
    public function setting(){
        return view('user.setting');
    }
    // ����������Ϊ
    public function settingStore(){

    }

    // ��������ҳ��
    public function show(Users $user){
        // �������Ϣ��������ע/��˿/������
        $user = Users::withCount(['stars','fans','posts'])->find($user->id);

        // ����˵������б�ȡ����ʱ�����µ�ǰ10��
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        // ����˹�ע���û���������ע�û��� ��ע/��˿/������
        $stars = $user->stars();
        $susers = Users::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //  ��ע����˵��û���������˿�û��� ��ע/��˿/������
        $fans = $user->fans();
        $fusers = Users::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user.show',compact('user','posts','susers','fusers'));
    }
    //��ע�û�
    public function fan(Users $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return [
            'error'=> 0,
            'msg'  => ''
        ];

    }

    //ȡ����ע
    public function unfan(Users $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return [
            'error'=> 0,
            'msg'  => ''
        ];
    }
}
