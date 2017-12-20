<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::where(['parent_id'=>$request->get('parent_id',0)])->orderBy('sort','asc')->paginate();
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPermissions = Permission::where(['parent_id'=>0])->orderBy('sort','asc')->with('allChilds')->get();
        return view('admin.permission.create',compact('allPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        Permission::create($request->all());
        return redirect('admin/permission')->with('alert-msg','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::with(['roles','childs'])->find($id);
        $allPermissions = Permission::where(['parent_id'=>0])->orderBy('sort','asc')->with('allChilds')->get();
        return view('admin.permission.edit',compact('permission','allPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $permission = Permission::find($id);
        $permission->update($request->all());
        return redirect('admin/permission')->with('alert-msg','更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $permission = Permission::with(['roles'])->find($id);

        //是否有子菜单
        if (Permission::where('parent_id',$id)->first()){
            return response()->json(['code'=>1,'msg'=>'请先删除子菜单']);
        }

        // TODO 必需先删除权限
        //如果有关联角色，则移除关联
        if (!empty($permission->roles)){
            $permission->roles()->detach();
        }
        //删除权限
        if ( $permission->delete() ){
            return response()->json(['code'=>0,'msg'=>'已删除']);
        }
        return response()->json(['code'=>1,'msg'=>'系统错误']);
    }
}
