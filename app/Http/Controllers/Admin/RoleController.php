<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('created_at','desc')->paginate();
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        Role::create([
            'name'  => $request->get('name'),
            'display_name'   => $request->get('display_name') ? $request->get('display_name') : $request->get('name')
        ]);
        return redirect('admin/role')->with('alert-msg','添加成功');
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
        $role = Role::find($id);
        if (!$role) return redirect()->back()->withErrors('该角色不存在');
        return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->all());
        return redirect('admin/role')->with('alert-msg','更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::with(['users','permissions'])->find($id);

        // TODO 必需先删除关联表，再删除角色
        //如果有关联的用户，则移除
        if (!empty($role->users)){
            $role->users()->detach();
        }
        //如果有关联的权限，则移除
        if (!empty($role->permissions)){
            $role->permissions()->detach();
        }

        //删除角色
        if ( $role->delete() ){
            return response()->json(['code'=>0,'msg'=>'已删除']);
        }

        return response()->json(['code'=>1,'msg'=>'系统错误']);
    }

    public function assignPermission(Request $request,$id)
    {
        $role = Role::with('permissions')->find($id);
        
        if (!$role){
            return back()->withErrors('该角色不存在');
        }
        $permissions = Permission::where(['parent_id'=>0])->orderBy('sort','asc')->with('allChilds')->get();
        foreach ($permissions as $perm){
            if ($role->hasPermission($perm->name)){
                $perm->checked = true;
            }
            if (!empty($perm->allChilds)){
                foreach ($perm->allChilds as $childs){
                    if ($role->hasPermission($childs->name)){
                        $childs->checked = true;
                    }
                    if (!empty($childs->allChilds)){
                        foreach ($childs->allChilds as $lastChilds){
                            if ($role->hasPermission($lastChilds->name)){
                                $lastChilds->checked = true;
                            }
                        }
                    }
                }
            }
        }
        return view('admin.role.permission',compact(['role','permissions']));
    }

    public function savePermission(Request $request,$id)
    {
        $role = Role::find($id);
        $permissions = $request->get('permissions');
        $role->permissions()->sync($permissions);
        return redirect('admin/role')->with('alert-msg','授权成功');
    }
    
}
