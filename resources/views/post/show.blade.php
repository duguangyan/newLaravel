@extends("layout.main")

@section("content")

        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{ $posts->title }}</h2>

                    @can('update',$posts)
                    <a style="margin: auto"  href="/posts/{{ $posts->id }}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endcan
                    @can('delete',$posts)
                    <a style="margin: auto"  href="/posts/{{ $posts->id }}/delete">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endcan
                </div>

                <p class="blog-post-meta">{{ $posts->created_at->toFormattedDateString() }} <a href="#">Kassandra Ankunding2</a></p>
                {!! $posts->content !!}
                {{--<p><p>你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好你好<img src="http://127.0.0.1:8000/storage/72c76b674ec8793fcfd6555ff371bfbd/nxC9ozLfkORmoY92q9lPsejXchVvdNO2cwHiR2Jf.jpeg" alt="63" style="max-width: 100%;">你好你好似懂非懂说</p><p><br></p></p>--}}
                <div>
                    @if($posts->zan($user_id)->exists())
                        <a href="/posts/{{$posts->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                    @else
                        <a href="/posts/{{$posts->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    @foreach($posts->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at}} by {{$comment->users->name}}</h5>
                        <div>
                            {{ $comment->content }}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/posts/{{ $posts->id }}/comment" method="post">
                        @csrf
                        {{--<input type="hidden" name="_token" value="4BfTBDF90Mjp8hdoie6QGDPJF2J5AgmpsC9ddFHD">--}}
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>

                            @include('layout.error')
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->

@endsection