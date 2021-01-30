@extends('layout.main')
@section('title'){{$post->title}}@endsection
@section('content')
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>
                @can('update',$post)
                <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                @endcan
                @can('delete',$post)
                <a style="margin: auto" href="/posts/{{$post->id}}/del" >
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
                @endcan
            </div>
            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} <a href="#">{{$post->user->name}}</a></p>
            <p>{!! $post->content !!}</p>
            <div>
                @if($post->zan(\Auth()->id())->exists() == true)
                <a href="/posts/{{$post->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                @else
                <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>
            <!-- List group -->
            <ul class="list-group">
                @if(count($posts)>0)
                @foreach($posts as $comment)
                <li class="list-group-item">
                    <h5>{{$comment->created_at}} by {{$comment->name}}</h5>
                    <div>
                        {{$comment->content}}
                    </div>
                </li>
                @endforeach
                @else
                <li class="list-group-item">
                    <h5> 暂时还没有评论，快发表下自己的看法吧~</h5>
                </li>
                @endif
            </ul>
        </div>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>
            <!-- List group -->
            <ul class="list-group">
                <form action="/posts/{{$post->id}}/comment" method="post">
                    {{csrf_field()}}
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>

                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                    @include('layout.error')
                </form>
            </ul>
        </div>
    </div>
@endsection
