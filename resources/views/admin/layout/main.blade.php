<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <title>layout 后台大布局 - Layui</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layout.style')
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
<!-- 顶部开始 -->
    @include('admin.layout.header')
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
@include('admin.layout.left')
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
{{--                <iframe src="{fun U('Index/welcome')}" name="x-iframe" frameborder="0" scrolling="yes" class="x-iframe"></iframe>--}}
            </div>
        </div>
    </div>
</div>
<ul class="rightmenu">
    <li data-type="closethis">关闭当前</li>
    <li data-type="closeother">关闭其他</li>
    <li data-type="closeall">关闭所有</li>
</ul>
<div class="page-content-bg"></div>
@include('admin.layout.footer')
</div>
</body>
</html>
