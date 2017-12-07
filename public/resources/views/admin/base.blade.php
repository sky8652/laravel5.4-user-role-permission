<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理 - Layui</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/font-awesome-4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">Laravel后台管理</div>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="/admin">系统管理</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">{{auth()->user()->name}}</a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="/logout">退出</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">系统管理</a>
                    <dl class="layui-nav-child">
                        @can('role.index')
                        <dd><a href="{{route('role.index')}}">角色管理</a></dd>
                        @endcan

                        @can('user.index')
                        <dd><a href="{{route('user.index')}}">用户管理</a></dd>
                        @endcan

                        @can('permission.index')
                        <dd><a href="{{route('permission.index')}}">权限管理</a></dd>
                        @endcan
                    </dl>
                </li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <div style="padding:15px;">
            <!-- 内容主体区域 -->
            @yield('content')
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © layui.com - 底部固定区域
    </div>
</div>

<script src="/static/js/jquery.min.js"  type="text/javascript"></script>
<script src="/static/layui/layui.js"  type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    layui.use(['element','layer','form','table'],function () {
        var element = layui.element;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;

        //统一错误提示信息
        @if(count($errors)>0)
        var errorStr = '';
        @foreach($errors->all() as $error)
            errorStr += "{{$error}}<br />";
        @endforeach
        layer.msg(errorStr);
        @endif

    });

    //删除确认
    function delConfirm(url) {
        layer.confirm('真的删除行么', function(index){
            layer.close(index);
            $.post(url,{_method:"delete"},function (data) {
                layer.msg(data.msg,{time:1000},function () {
                    if (data.code==0){
                        location.reload()
                    }
                });
            })
        });
    }

</script>
@yield('script')
</body>
</html>