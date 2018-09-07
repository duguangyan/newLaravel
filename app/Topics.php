<?php

namespace App;

use App\Model;
use App\Posts;
use App\PostTopics;
class Topics extends Model
{
    // 属于这个专题的所有文章
    public function posts(){
        return $this->belongsToMany(\App\Posts::class, 'post_topics', 'topics_id', 'posts_id');
    }

    // 专题文章数，用于withCount
    public function postTopics(){
        return $this->hasMany(\App\PostTopics::class,'topics_id','id');
    }
}
