<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',env('ROOT_ID'))->orderBy('created_at','desc')->paginate();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name'  => $request->get('name'),
            'email'     => $request->get('email'),
            'tel'       => $request->get('tel'),
            'username'      => $request->get('username'),
            'password'  => bcrypt($request->get('password')),
        ]);
        return redirect('admin/user')->with('alert-msg','添加成功');
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
        $user = User::find($id);
        if (!$user) return redirect()->back()->withErrors('该用户不存在');
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $data = [
            'name'  => $request->get('name'),
            'email'     => $request->get('email'),
            'tel'       => $request->get('tel'),
            'username'      => $request->get('username'),
        ];
        //是否修改密码
        if ( $request->get('password') && $request->get('password_confirmation') ){
            $data['password'] = bcrypt($request->get('password'));
        }
        $user->update($data);
        return redirect('admin/user')->with('alert-msg','更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('roles')->find($id);

        // TODO 先删除关联表里的角色
        //如果有关联的角色，则移除
        if (!$user->roles->isEmpty()){
            $user->roles()->detach();
        }
        //删除用户
        if ( $user->delete() ){
            return response()->json(['code'=>0,'msg'=>'已删除']);
        }
        return response()->json(['code'=>1,'msg'=>'系统错误']);
    }

    public function assignRole($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::get();
        foreach ($roles as $role){
            if ($user->hasRole($role->name)){
                $role->checked = true;
            }
        }
        return view('admin.user.role',compact('user','roles'));
    }

    public function saveRole(Request $request,$id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->get('roles'));
        return redirect('admin/user')->with('alert-msg','更新成功');
    }

}
