@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">角色管理</div>
    <div class="layui-fluid">
        @can('role.create')
        <a href="{{route('role.create')}}" class="layui-btn layui-btn-small"><i class="fa fa-pencil"></i> 添 加</a>
        @endcan
    </div>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>名称</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->created_at}}</td>
                <td>{{$role->updated_at}}</td>
                <td>
                    @can('role.permission')
                    <a class="layui-btn layui-btn-sm" href="{{route('role.permission',['role'=>$role])}}" >权限</a>
                    @endcan
                    @can('role.edit')
                    <a class="layui-btn layui-btn-sm" href="{{route('role.edit',['role'=>$role])}}" >编辑</a>
                    @endcan
                    @can('role.destroy')
                    <a class="layui-btn layui-btn-danger layui-btn-sm" onclick="delConfirm('{{route('role.destroy',['role'=>$role])}}')">删除</a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr><td colspan="6" align="center">无数据</td></tr>
        @endforelse
        </tbody>
    </table>
    {{$roles->links()}}
@endsection

