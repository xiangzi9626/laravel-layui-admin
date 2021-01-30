
@include('admin.layout.style')
<div class="x-body">
    <form class="layui-form" action="">
        {{csrf_field()}}
        <input type="hidden" name="csrf-token" value="{{csrf_token()}}">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" value="{{$post->title}}" lay-verify="required" lay-reqtext="标题不能为空" placeholder="标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
            <textarea id="content"  style="height:400px;max-height:500px;" name="content"  class="form-control" placeholder="这里是内容">{!! $post->content !!}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">审核状态</label>
            <div class="layui-input-block">
                <input type="checkbox" {{$post->status == 1 ? 'checked' :''}} name="status" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
        }
    });
    var editor = new wangEditor('content');
    if(editor.config){
        editor.config.uploadImgUrl = '/posts/image/upload';
        editor.create();
// 设置 headers（举例）
        editor.config.uploadHeaders = {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
        };
    }
    layui.use(['form'], function(){
        var form = layui.form
            ,layer = layui.layer,layedit = layui.layedit;
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 5){
                    return '标题至少得5个字符啊';
                }
            }
            ,content: function(value){
                layedit.sync(editIndex);
            }
        });
        //监听提交
        form.on('submit(submit)', function(data){
            console.log(data.field);
            $.post('/admin/posts/editSubmit/{{$post->id}}',data.field,function (res) {
                if(res.code > 0){
                    layer.msg(res.msg,{icon:5});
                }else{
                    layer.msg(res.msg, {icon: 6,time: 2000},function () {
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.location.reload();//刷新父页面，注意一定要在关闭当前iframe层之前执行刷新
                        parent.layer.close(index); //再执行关闭
                    })
                }
            });
            return false;
        });

    });
</script>

