@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加权限</div>
    <form class="layui-form" action="{{route('permission.store')}}" method="post">
        @include('admin.permission._from')
    </form>
@endsection