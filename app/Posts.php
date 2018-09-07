<?php

namespace App;

use App\Model;
use App\Zans;
use Illuminate\Database\Eloquent\Builder;

class Posts extends Model
{
    // 关联操作

    //关联用户
    public function user(){
        return $this->belongsTo('\App\Users','users_id','id');
    }

    // 评论模型
    public function comments(){
        return $this->hasMany('\App\Comments')->orderBy('created_at','desc');
    }


    // 赞 关联
    /*
     * 判断一个用户是否已经给这篇文章点赞了
     */
    public function zan($users_id)
    {
        return $this->hasOne(\App\Zans::class)->where('users_id', $users_id);
    }
    // 文章所有者赞
    public function zans(){
        return $this->hasMany(\App\Zans::class);
    }

    // 属于某个作者的文章
    public function scopeAuthBy(Builder $query,$user_id){
        return $query->where('user_id',$user_id);
    }

    public function postTopics(){
        return $this->hasMany(\App\PostTopics::class,'posts_id','id');
    }

    // 不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query,$topics_id){
        return $query->doesntHave('postTopics','and',function ($q) use($topics_id){
            $q->where('topics_id',$topics_id);
        });
    }


    public function scopeAuthorBy($query, $users_id)
    {
        return $query->where('users_id', $users_id);
    }

    /*
     * 可以显示的文章
     */
    public function scopeAviable($query)
    {
        return $query->whereIn('status', [0, 1]);
    }


    // 全局scope的方式
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('avaiable',function (Builder $builder){
            $builder->whereIn('status',[0,1]);
        });
    }
}
