<?php

namespace App;

use App\Model;
use App\Posts;
use App\PostTopics;
class Topics extends Model
{
    // �������ר�����������
    public function posts(){
        return $this->belongsToMany(\App\Posts::class, 'post_topics', 'topics_id', 'posts_id');
    }

    // ר��������������withCount
    public function postTopics(){
        return $this->hasMany(\App\PostTopics::class,'topics_id','id');
    }
}
