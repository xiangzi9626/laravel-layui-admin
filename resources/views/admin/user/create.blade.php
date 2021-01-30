
@include('admin.layout.style')
<div class="x-body">
    <form class="layui-form" action="">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label class="layui-form-label">管理员账号</label>
            <div class="layui-input-block">
                <input type="text" name="username" lay-verify="required" lay-reqtext="管理员账号不能为空" placeholder="管理员账号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="checkbox" checked="" name="is_show" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
            </div>
        </div>
        <!--<div class="layui-form-item layui-form-text">
          <label class="layui-form-label">编辑器</label>
          <div class="layui-input-block">
            <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"></textarea>
          </div>
        </div>-->
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script src="/admin-layui/common/js/jquery.min.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form'], function(){
        var form = layui.form
            ,layer = layui.layer,layedit = layui.layedit;
        //自定义验证规则
/*        form.verify({
            title: function(value){
                if(value.length < 5){
                    return '标题至少得5个字符啊';
                }
            }
            ,pass: [
                /^[\S]{5,12}$/
                ,'密码必须5到12位，且不能出现空格'
            ]
            ,content: function(value){
                layedit.sync(editIndex);
            }
        });*/
        //监听提交
        form.on('submit(submit)', function(data){
            $.ajax({
                url: "/admin/users/createSubmit",
                method : 'POST',
                data:data.field,
                dataType: "json",
                success: function(data) {
                    if(res.code > 0){
                        layer.msg(res.msg,{icon:5});
                    }else{
                        layer.msg(res.msg, {icon: 6,time: 2000},function () {
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.location.reload();//刷新父页面，注意一定要在关闭当前iframe层之前执行刷新
                            parent.layer.close(index); //再执行关闭
                        })
                    }
                },
                error:function (e) {
                    var error = JSON.stringify(e.responseJSON.errors);
                    /*console.log(JSON.stringify(error),error.username);return;*/
                    layer.msg(error,{icon:5});
                }
            });
            return false;
        });

    });
</script>

