<div class="container">
    <div class="logo"><a href="/admin/home">laravel-dome后台管理</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="layui-icon layui-icon-home"></i>
    </div>
    <ul class="layui-nav left fast-add" lay-filter="">

        <li class="layui-nav-item">
            <a href="javascript:;"><i class="iconfont"></i><cite>栏目一</cite></a>
            {{--<dl class="layui-nav-child">
                <dd class="top-nav"><a x_href="{fun U($actions[$vv]['fc'])}" class="top_nav">{$actions[$vv]['name']}</a></dd>
            </dl>--}}
        </li>
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a class="top_nav_right"  x_href="{fun U('index/cleanCache')}"><i class="layui-icon layui-icon-delete jzicon"></i>清理缓存</a>

        </li>
        <li class="layui-nav-item">
            <a href="javascript:;"><i class="layui-icon layui-icon-username jzicon"></i>{{\Auth()->guard('admin')->user()->username}}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a x_href="{fun U('Index/details',['id'=>frencode($admin['id'])])}" class="top_nav_right"      >个人信息</a></dd>

                <dd><a href="/admin/logout">退出</a></dd>
            </dl>
        </li>

        <li class="layui-nav-item to-index"><a target="_blank" href="/"><i class="layui-icon layui-icon-home jzicon"></i>前台首页</a></li>
    </ul>

</div>
