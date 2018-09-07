<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    //  可以注入的字段
    protected $fillable = [
        'name','email','password'
    ];

    // 获取用户文章列表
    public function posts(){
        return $this->hasMany(Posts::class,'user_id','id');
    }

    // 关注我的粉丝 fan模型
    public function fans(){
        return $this->hasMany(Fans::class,'star_id','id');
    }

    //我关注的fan 模型
    public function stars(){
        return $this->hasMany(Fans::class,'fan_id','id');
    }

    // 关注某人
    public function doFan($uid){

        $fan = new Fans();
        $fan->star_id = $uid;
        $this->stars()->save($fan);

    }

    // 取消关注
    public function doUnFan($uid){
        $fan = new Fans();
        $fan->star_id = $uid;
        $this->stars()->delete($fan);
    }

    // 当前用户是否被uid关注
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前是否关注了uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }


    //用户收到的通知
    public function notices(){
        return $this->belongsToMany(\App\Notices::class,'users_notices','users_id','notices_id');
    }

    //给用户增加通知
    public function addNotices($notices){
        return $this->notices()->save();
    }


}
