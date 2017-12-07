@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">角色 【{{$role->name}}】分配权限</div>
    <form action="{{route('role.savePermission',['role'=>$role])}}" method="post" class="layui-form">
        {{csrf_field()}}
        {{method_field('put')}}
        <table class="layui-table" lay-size="sm" lay-skin="" style="width: 50%">
            <tr>
                <td><h2>一级菜单</h2></td>
                <td>
                    <table class="layui-table" lay-size="sm" lay-skin="">
                        <tr>
                            <td><h2>二级菜单</h2></td>
                            <td>
                                <table class="layui-table" lay-size="sm" lay-skin="">
                                    <tr><td><h2>三级菜单</h2></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @foreach($permissions as $permission)
            <tr>
                <td><input id="menu{{$permission->id}}-" type="checkbox" name="permissions[]" value="{{$permission->id}}" title="{{$permission->display_name}}" lay-skin="primary" {{$permission->checked ? 'checked' : ''}} ></td>
                @if(!empty($permission->allChilds))
                <td>
                    <table class="layui-table" lay-size="sm" lay-skin="">
                        @foreach($permission->allChilds as $child)
                        <tr>
                            <td><input id="menu{{$permission->id}}-{{$child->id}}" type="checkbox" name="permissions[]" value="{{$child->id}}" title="{{$child->display_name}}" lay-skin="primary" {{$child->checked ? 'checked' : ''}} ></td>
                            @if(!empty($child->allChilds))
                            <td>
                                <table class="layui-table" lay-size="sm" lay-skin="">
                                    @foreach($child->allChilds as $lastChild)
                                    <tr><td><input id="menu{{$permission->id}}-{{$child->id}}-{{$lastChild->id}}" type="checkbox" name="permissions[]" value="{{$lastChild->id}}" title="{{$lastChild->display_name}}" lay-skin="primary" {{$lastChild->checked ? 'checked' : ''}} ></td></tr>
                                    @endforeach
                                </table>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </td>
                @endif
            </tr>
            @endforeach
        </table>
        <div class="layui-form-item">
            <button type="submit" class="layui-btn" lay-submit="" >确 认</button>
            <a href="{{route('role.index')}}"  class="layui-btn" >返 回</a>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        layui.use(['form'],function () {
            var form = layui.form;
            form.on('checkbox', function (data) {
                var check = $(data.elem).prop("checked");//是否选中
                var checkId = data.elem.id;//当前操作的选项框
                if (check) {
                    //选中
                    var ids = checkId.split("-");
                    if (ids.length == 3) {
                        //第三极菜单
                        //第三极菜单选中,则他的上级选中
                        $("#" + (ids[0] + '-' + ids[1])).prop("checked", true);
                        $("#" + (ids[0])).prop("checked", true);
                    } else if (ids.length == 2) {
                        //第二季菜单
                        $("#" + (ids[0])).prop("checked", true);
                        $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                            $(ele).prop("checked", true);
                        });
                    } else {
                        //第一季菜单不需要做处理
                        $("input[id*=" + ids[0] + "]").each(function (i, ele) {
                            $(ele).prop("checked", true);
                        });
                    }
                } else {
                    //取消选中
                    var ids = checkId.split("-");
                    if (ids.length == 2) {
                        //第二极菜单
                        $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                            $(ele).prop("checked", false);
                        });
                    } else if (ids.length == 1) {
                        $("input[id*=" + ids[0] + "]").each(function (i, ele) {
                            $(ele).prop("checked", false);
                        });
                    }
                }
                form.render();
            });
        });
    </script>
@endsection

