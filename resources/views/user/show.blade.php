@extends('layout.main')
@section('title')@endsection
@section('content')
    <div class="col-sm-8">
        <blockquote>
            <p><img src="{{$user->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
            </p>
            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            @include('user.like-button.like',['target_user'=>$user])
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @if(!empty($posts))
                        @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="/user/{{$post->user->id}}">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                        <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>
                        {!! Str::limit($post->content,100) !!}
                    </div>
                        @endforeach
                    @endif
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @if(!empty($susers))
                        @foreach($susers as $suser)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{$suser->name}}</p>
                        <p class="">关注：{{$suser->stars_count}} | 粉丝：{{$suser->fans_count}}｜ 文章：{{$suser->posts_count}}</p>
                        @include('user.like-button.like',['target_user'=>$suser])
                    </div>
                        @endforeach
                    @endif
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @if(!empty($fusers))
                        @foreach($fusers as $fuser)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$fuser->name}}</p>
                                <p class="">关注：{{$fuser->stars_count}} | 粉丝：{{$fuser->fans_count}}｜ 文章：{{$fuser->posts_count}}</p>
                                @include('user.like-button.like',['target_user'=>$fuser])
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div>
@endsection
