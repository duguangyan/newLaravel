<?php

namespace App\Http\Controllers;
use App\Topics;
use App\Posts;
class TopicController extends Controller
{
    //
    public function show(Topics $topic){
        // ר�������б�
        // dd($topic->toArray());
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
         //dd($posts);
        // ר��������
        $topics = Topics::withCount('postTopics')->find($topic->id);
         //dd($topics);

        $me = \Auth::user();
        // �����ҵ����£�����δͶ��
        // dd(\Auth::id());
        $myposts = Posts::AuthorBy(\Auth::id())->topicNotBy($topics->id)->get();

        // dd($myposts->toArray());


        return view('topic.show',compact('topic','posts','myposts'));

    }

    public function submit(Topics $topic){
        $this->validate(request(),[
            'post_ids' => 'array'
        ]);

        // ȷ����Щpost�������ڵ�ǰ�û���
        $posts = \App\Posts::find(request(['post_ids']));
        foreach ($posts as $post) {
            if ($post->user_id != \Auth::id()) {
                return back()->withErrors(array('message' => 'û��Ȩ��'));
            }
        }


        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id){
            \App\PostTopics::firstOrCreate(compact('topic_id', 'post_id'));
        }
        return back();
    }
}
