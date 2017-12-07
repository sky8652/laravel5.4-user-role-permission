@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">权限管理</div>
    <div class="layui-fluid">
        @can('permission')
        <a href="{{route('permission.create')}}" class="layui-btn layui-btn-small"><i class="fa fa-pencil"></i> 添 加</a>
        @endcan
        <a href="{{route('permission.index')}}" class="layui-btn layui-btn-small"></i> 返 回</a>
    </div>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>名称</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @forelse($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->sort}}</td>
                <td>{{$permission->created_at}}</td>
                <td>{{$permission->updated_at}}</td>
                <td>
                    @can('permission.index')
                    <a class="layui-btn layui-btn-sm" href="{{route('permission.index',['parent_id'=>$permission->id])}}" >子菜单</a>
                    @endcan

                    @can('permission.edit')
                    <a class="layui-btn layui-btn-sm" href="{{route('permission.edit',['permission'=>$permission])}}">编辑</a>
                    @endcan

                    @can('permission.destroy')
                    <a class="layui-btn layui-btn-danger layui-btn-sm" onclick="delConfirm('{{route('permission.destroy',['permission'=>$permission])}}')" >删除</a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr><td colspan="7" align="center">无数据</td></tr>
        @endforelse
        </tbody>
    </table>
    {{$permissions->links()}}
@endsection

