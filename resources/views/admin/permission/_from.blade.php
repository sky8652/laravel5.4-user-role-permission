{{csrf_field()}}

<div class="layui-form-item">
    <label for="" class="layui-form-label">父级</label>
    <div class="layui-input-block">
        <select name="parent_id" lay-search>
            <option value="0">无上级</option>
            @forelse($allPermissions as $perm)
                <option value="{{$perm->id}}" {{ isset($permission->id) && $perm->id == $permission->parent_id ? 'selected' : '' }} >{{$perm->display_name}}</option>
                @if(!empty($perm->allChilds))
                    @foreach($perm->allChilds as $childs)
                        <option value="{{$childs->id}}" {{ isset($permission->id) && $childs->id == $permission->parent_id ? 'selected' : '' }} >&nbsp;&nbsp;┗━━{{$childs->display_name}}</option>
                        @if(!empty($childs->allChilds))
                            @foreach($childs->allChilds as $lastChilds)
                                <option value="{{$lastChilds->id}}" {{ isset($permission->id) && $lastChilds->id == $permission->parent_id ? 'selected' : '' }} >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┗━━{{$lastChilds->display_name}}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @empty
            @endforelse
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">Name</label>
    <div class="layui-input-block">
        <input type="text" name="name" value="{{isset($permission->name)?$permission->name:''}}" lay-verify="required" class="layui-input" placeholder="如：system.index">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">名称</label>
    <div class="layui-input-block">
        <input type="text" name="display_name" value="{{isset($permission->display_name)?$permission->display_name:old('display_name')}}" lay-verify="required" class="layui-input" placeholder="如：系统管理">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-block">
        <input type="number" name="sort" value="{{isset($permission->sort)?$permission->sort:1}}" lay-verify="number" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" >确 认</button>
        <a href="{{route('permission.index')}}" class="layui-btn"  >返 回</a>
    </div>
</div>

