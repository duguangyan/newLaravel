<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    //  ����ע����ֶ�
    protected $fillable = [
        'name','email','password'
    ];

    // ��ȡ�û������б�
    public function posts(){
        return $this->hasMany(Posts::class,'user_id','id');
    }

    // ��ע�ҵķ�˿ fanģ��
    public function fans(){
        return $this->hasMany(Fans::class,'star_id','id');
    }

    //�ҹ�ע��fan ģ��
    public function stars(){
        return $this->hasMany(Fans::class,'fan_id','id');
    }

    // ��עĳ��
    public function doFan($uid){

        $fan = new Fans();
        $fan->star_id = $uid;
        $this->stars()->save($fan);

    }

    // ȡ����ע
    public function doUnFan($uid){
        $fan = new Fans();
        $fan->star_id = $uid;
        $this->stars()->delete($fan);
    }

    // ��ǰ�û��Ƿ�uid��ע
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //��ǰ�Ƿ��ע��uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }


    //�û��յ���֪ͨ
    public function notices(){
        return $this->belongsToMany(\App\Notices::class,'users_notices','users_id','notices_id');
    }

    //���û�����֪ͨ
    public function addNotices($notices){
        return $this->notices()->save();
    }


}
