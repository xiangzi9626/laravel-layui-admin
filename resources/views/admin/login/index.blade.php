<html lang="en"><head>
    <meta charset="UTF-8">
    <title>laravel-dome后台管理</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="author" content="留恋风,2581047041@qq.com">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/admin-layui/common/css/font.css">
    <link rel="stylesheet" href="/admin-layui/common/css/xadmin.css">
    <script type="text/javascript" src="/admin-layui/common/js/jquery.min.js"></script>
    <script src="/admin-layui/layui/layui.js?v=123" charset="utf-8"></script>
    <script type="text/javascript" src="/admin-layui/common/js/xadmin.js"></script>

{{--    <script type="text/javascript" src="/A/t/tpl/style/js/target_page.js"></script>--}}


    <style>
        .active a{    background: #f00;
            color: #fff;}
        .layui-form-item .layui-input-inline {
            float: left;
            width: auto;
            margin-right: 10px;
        }
    </style>
    <style>
        #jizhitj{
            position: fixed;
            bottom: 0px;
            z-index: 9999;
            width: 100%;
            background:#cccccc;
        }
    </style>
    <link id="layuicss-layer" rel="stylesheet" href="http://ja-dome.com/A/t/tpl/style/lib/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head>
<body class="login-bg" style="">

<div class="login layui-anim layui-anim-up">
    <div class="message">laravel-dome后台管理</div>
    <div id="darkbannerwrap"></div>
    <form class="layui-form" method="POST" action="/admin/login">
        {{csrf_field()}}
        <input name="username" placeholder="用户名" type="text" lay-verify="required" class="layui-input">
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
        <hr class="hr15">
        {{--<input name="vercode" style="width:50%;float:left;" lay-verify="required" placeholder="验证码" type="text" class="layui-input">
        <img src="http://ja-dome.com/admin.php/Login/vercode.html" style="width:40%;float:right;" onclick="this.src=this.src+'?'+Math.random()">
        <hr class="hr15">--}}
        @include('admin.layout.error')
        <input value="登录" lay-submit="" lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>
</div>
<script>
/*    $(function  () {
        if (top.location != self.location){
            top.location = self.location;
        }
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(login)', function(data){
                $.post("/admin/login",data.field,function(res){
                    var res = JSON.parse(res);
                    if(res.code==1){
                        layer.msg(res.msg);
                    }else{
                        layer.msg(res.msg, {icon: 6,time: 2000},function(){
                            window.location.href="/admin/home";
                        });
                    }
                });
                return false;
            });
        });
    })*/
</script>
</body>
</html>
