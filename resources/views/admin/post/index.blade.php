<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @include('admin.layout.style')
    <script !src="">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div class="x-nav">
      <span class="layui-breadcrumb" style="visibility: visible;">
        <a>首页</a><span lay-separator="">/</span>
        <a>栏目管理</a><span lay-separator="">/</span>
        <a><cite>栏目列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="iconfont" style="line-height:30px"></i></a>
</div>

<div class="x-body">
    <div class="layui-collapse">
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">搜索</h2>
            <div class="layui-colla-content layui-show">
                <div class="layui-row">
                    <form class="layui-form layui-col-md12 x-so" method="get" id="myform">
                        <div class="layui-input-inline">
                            <select name="status" class="layui-inline autosubmit">
                                <option value="">状态</option>
                                <option value="1">审核</option>
                                <option value="-1">未审</option>
                            </select>
                        </div>
                        <input type="text" name="keywords" value="" placeholder="请输入文章名称" autocomplete="off" class="layui-input">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="submit"><i class="layui-icon">&#xe615;</i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>


<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="addUser">添加文章</button>
    </div>
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

<script>
    layui.use(['table','form'], function(){
        var table = layui.table,form = layui.form;
        table.render({
            elem: '#test'
            ,url:'/admin/posts'
            ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: false
            ,title: '用户数据表'
            ,cols: [[
                {type: 'checkbox', fixed: 'left'}
                ,{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
                ,{field:'name', title:'作者', width:120}
                ,{field:'title', title:'标题'},
                {field:'is_show', title:'审核状态', width:120,align:'center', templet: function(res){
                        if(res.status >=0){
                            return '<input type="checkbox"  data-id="'+res.id+'" data-type="1" checked="" name="status" lay-skin="switch" lay-filter="isShow" lay-text="正常|禁止">'
                        }else{
                            return '<input type="checkbox"  data-id="'+res.id+'" data-type="-1" name="status" lay-skin="switch" lay-filter="isShow" lay-text="正常|禁止">'
                        }
                    }}
                ,{field:'created_at', title:'加入时间', width:180}
                ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
            ]]
            ,page: true
        });
        form.on('submit(submit)', function(data){
            //data.field
            table.reload('test', {
                url:"/admin/posts"
                ,where: data.field //设定异步数据接口的额外参数

            });
            return false;
        });
        //头工具栏事件
        table.on('toolbar(test)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
                case 'addUser':
                    x_all_show('添加','/admin/posts/create');
                    break;
                case 'getCheckLength':
                    var data = checkStatus.data;
                    layer.msg('选中了：'+ data.length + ' 个');
                    break;
                case 'isAll':
                    layer.msg(checkStatus.isAll ? '全选': '未全选');
                    break;

                //自定义头工具栏右侧图标 - 提示
                case 'LAYTABLE_TIPS':
                    layer.alert('这是工具栏右侧自定义的一个图标按钮');
                    break;
            };
        });
        //监听行工具事件
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('确认删除该文章？', function(index){
                    var url = '/admin/posts/delete/'+data.id;
                    $.get(url,function (res) {
                        if(res.code > 0){
                            layer.msg(res.msg,{icon:5});
                        }else{
                            layer.msg(res.msg, {icon: 6,time: 1000},function () {
                                $(obj.tr).remove();
                                table.reload('test');
                                // location.reload();//刷新父页面，注意一定要在关闭当前iframe层之前执行刷新
                            })
                        }
                    })
                });
            } else if(obj.event === 'edit'){
                var url = '/admin/posts/edit/'+data.id;
                x_all_show('添加',url);
            }else if(obj.event === 'isShow'){
                var url = '/admin/users/'+data.id+'/edit';
                console.log(url);
                x_all_show('添加',url);
            }
        });
        form.on('switch(isShow)', function (data) {
            console.log($(this).data('type'));
            var id = $(this).data('id');
            var url = '/admin/posts/changeStatus/'+id;
            $.ajax({
                url:url,
                method:"post",
                dataType:'json',
                data:{
                    id:id,
                    status:$(this).data('type')
                },
                success:function (res) {
                    if(res.code > 0){
                        layer.msg(res.msg,{icon:5});
                    }else{
                        layer.msg(res.msg, {icon: 6,time: 1000});
                        table.reload('test');
                    }
                }
            });
        });

    });
</script>

</body>
</html>
