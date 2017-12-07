@extends('admin.login.base')

@section('content')
    <form class="layui-form" action="{{url('login')}}" method="post">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-user"></i> 用户名</label>
            <div class="layui-input-block">
                <input type="text" name="username" value="{{old('username')}}" lay-verify="required" placeholder="用户名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-key"></i> 密&nbsp;&nbsp;&nbsp;码</label>
            <div class="layui-input-block">
                <input type="password" name="password" lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-user"></i> 记住我</label>
            <div class="layui-input-block">
                <input type="checkbox" name="remember" lay-skin="switch" lay-text="ON|OFF" value="1" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确认登陆</button>
                <button type="reset" class="layui-btn" lay-submit="" lay-filter="formDemo">重 置</button>
            </div>
        </div>
    </form>
@endsection


