<div class="left-nav layui-side layui-bg-black">
    <div id="side-nav" class="layui-side-scroll">
        <ul id="nav" class="layui-nav-tree">
            @can('topics')
            <li>
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>专题管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/topics">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>专题列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            @endcan
            @can('posts')
            <li>
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>文章管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/posts">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>文章列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            @endcan
            @can('system')
            <li>
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>系统管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/users">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/roles">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/permissions">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
                @endcan
        </ul>
    </div>
</div>
