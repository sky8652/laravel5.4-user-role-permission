@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">用户管理</div>
    <div class="layui-fluid">
        @can('user.create')
        <a href="{{route('user.create')}}" class="layui-btn layui-btn-small"><i class="fa fa-pencil"></i> 添 加</a>
        @endcan
    </div>
    <div class="layui-fluid">
        <table class="layui-table" >
            <thead>
            <tr>
                <th>ID</th>
                <th>昵称</th>
                <th>帐号</th>
                <th>邮箱</th>
                <th>手机</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->tel}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        @can('user.edit')
                        <a class="layui-btn layui-btn-sm" href="{{route('user.edit',['user'=>$user])}}" >编辑</a>
                        @endcan

                        @can('user.destroy')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" onclick="delConfirm('{{route('user.destroy',['user'=>$user])}}')" >删除</a>
                        @endcan

                        @can('user.role')
                        <a class="layui-btn layui-btn-sm" href="{{route('user.role',['user'=>$user])}}" >角色</a>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" align="center">无数据</td></tr>
            @endforelse
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection




