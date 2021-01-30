@extends('layout.main')
@section('title')个人设置@endsection
@section('content')
    <style>
        .img-rounded{border-radius: 100px;margin-top: 10px;max-width: 100px}
    </style>
    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="/user/me/settingStore" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{$user->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class=" file-loading preview_input" type="file" value=""  name="avatar">
                    <img class="preview_img img-rounded" src="{{$user->avatar}}" alt="" >
                </div>
            </div>
            @include('layout.error')
            <button type="submit" class="btn btn-default">修改</button>
        </form>
        <br>

    </div>
@endsection
