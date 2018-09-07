<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/8/28
 * Time: 10:33
 */

namespace App\Http\Controllers;
use \App\Comments;
use \App\Posts;
use \App\Users;
use \App\Zans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // �б�ҳ��
    public function index()
    {
        $user = \Auth::user();
        $posts = Posts::orderBy('created_at', 'desc')->withCount(["zans", "comments"])->with(['user'])->paginate(6);
        //  dd($posts->toarray());
        return view('post/index', compact('posts'));
    }

    // ����ҳ
    public function show(Posts $posts){
        $posts->load('comments');
        $user_id = Auth::id();
        return view('post/show',compact('posts','user_id'));
    }

    // ��������
    public function create(){
        return view('post/create');
    }

    // ���������߼�
    public function store(){


// ��һ��
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();
// �ڶ���
        // $params = ['title'=>request('title'),'content'=>request('content')];
        // ������
        // $params = request(['title','content']);
        // ��֤
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);
        // �߼�
        $user_id = Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
        Posts::create($params);
        // ��Ⱦ
        return redirect('/posts');
        // dd(request());
    }

    // �༭ҳ��
    public function edit(Posts $posts){
        return view('post/edit',compact('posts'));
    }

    // �����߼�ҳ��
    public function update(Posts $posts){
        // ��֤
        $this->validate(request(),[
           'title'   => 'required|string|max:100|min:5',
           'content' => 'required|string|min:10'
        ]);
        // �߼�
        // TODO: �޸�Ȩ����֤
        $this->authorize('update',$posts);


        $posts->title = request('title');
        $posts->content = request('content');
        $posts->save();
        // Posts::updated(request(['title','content']));
        // ��Ⱦ
        return redirect('/posts/'.$posts->id);
    }

    // ɾ��ҳ��
    public function delete(Posts $posts){
        // TODO: �û�Ȩ����֤
        $this->authorize('delete',$posts);

        $posts->delete();
        return redirect('/posts');
    }

    // ͼƬ�ϴ�
    public function imageUplode(Request $request){
        // dd(request()->all());
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));

        return asset('storage/'.$path);
    }

    // �ύ����
    public function comment(Posts $posts){
        //sdd(request()->toArray());
        // ��֤
       $this->validate(request(),[
            'content' => 'required|min:1'
       ]);
       // �߼�
        $comments = new Comments();
        $comments->users_id = Auth::id();
        $comments->content = request("content");
        $posts->comments()->save($comments);
       //��Ⱦ
       return back();
    }

    // ��
    public function zan(Posts $posts){

        // dd($posts);

        $param = [
          'users_id' => Auth::id(),
          'posts_id' => $posts->id
        ];
        Zans::firstOrCreate($param);
        return back();
    }

    // ȡ����
    public function unzan(Posts $posts){

        $posts->zan(Auth::id())->delete();
        return back();
    }

    // ��ѯ
    public function search(){
//        $this->validate(request(),[
//            'content' => 'required'
//        ]);

        $query = request('query');
        $posts  = Posts::where('content','like','%'.$query.'%')->orderBy('created_at','desc')->withCount(["comments",'zans'])->paginate(6);
        // dd($posts);
        // return view('post/index',compact('posts','query'));
        return view('post/index',compact(['posts','query']));
    }

}