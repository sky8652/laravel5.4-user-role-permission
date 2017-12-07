{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">昵称</label>
    <div class="layui-input-inline">
        <input type="text" name="name" value="{{isset($user->name)?$user->name:old('name')}}" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">邮箱</label>
    <div class="layui-input-inline">
        <input type="email" name="email" value="{{isset($user->email)?$user->email:old('email')}}" lay-verify="email" placeholder="请输入Email" autocomplete="off" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">手机号</label>
    <div class="layui-input-inline">
        <input type="text" name="tel" value="{{isset($user->tel)?$user->tel:old('tel')}}" required="" lay-verify="phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
        <input type="text" name="username" value="{{isset($user->username)?$user->username:old('username')}}" lay-verify="number" placeholder="请输入用户名" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">密码</label>
    <div class="layui-input-inline">
        <input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">确认密码</label>
    <div class="layui-input-inline">
        <input type="password" name="password_confirmation" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a href="{{route('user.index')}}" class="layui-btn" >返 回</a>
    </div>
</div>