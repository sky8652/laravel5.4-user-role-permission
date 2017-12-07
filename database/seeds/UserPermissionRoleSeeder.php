<?php

use Illuminate\Database\Seeder;

class UserPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //创建权限
        $permissions = [
            ['id'=>1,'display_name'=>'系统管理','name'=>'system.index','sort'=>1,'parent_id'=>0],
            ['id'=>2,'display_name'=>'用户管理','name'=>'user.index','sort'=>1,'parent_id'=>1],
            ['id'=>3,'display_name'=>'角色管理','name'=>'role.index','sort'=>1,'parent_id'=>1],
            ['id'=>4,'display_name'=>'权限管理','name'=>'permission.index','sort'=>1,'parent_id'=>1],

            ['id'=>5,'display_name'=>'添加权限','name'=>'permission.create','sort'=>1,'parent_id'=>4],
            ['id'=>6,'display_name'=>'编辑权限','name'=>'permission.edit','sort'=>1,'parent_id'=>4],
            ['id'=>7,'display_name'=>'删除权限','name'=>'permission.destroy','sort'=>1,'parent_id'=>4],

            ['id'=>8,'display_name'=>'添加角色','name'=>'role.create','sort'=>1,'parent_id'=>3],
            ['id'=>9,'display_name'=>'删除角色','name'=>'role.destroy','sort'=>1,'parent_id'=>3],
            ['id'=>10,'display_name'=>'编辑角色','name'=>'role.edit','sort'=>1,'parent_id'=>3],
            ['id'=>11,'display_name'=>'分配权限','name'=>'role.permission','sort'=>1,'parent_id'=>3],

            ['id'=>12,'display_name'=>'添加用户','name'=>'user.create','sort'=>1,'parent_id'=>2],
            ['id'=>13,'display_name'=>'编辑用户','name'=>'user.edit','sort'=>1,'parent_id'=>2],
            ['id'=>14,'display_name'=>'删除用户','name'=>'user.destroy','sort'=>1,'parent_id'=>2],
            ['id'=>15,'display_name'=>'分配角色','name'=>'user.role','sort'=>1,'parent_id'=>2],
        ];
        foreach ($permissions as $permission){
            \App\Models\Permission::create($permission);
        }

        //创建角色
        $roles = [
            ['id'=>1,'name'=>'admin','display_name'=>'管理员'],
        ];
        foreach ($roles as $role){
            $r = \App\Models\Role::create($role);
            $r->permissions()->attach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]);
        }

        //创建用户
        $users = [
            ['id'=>1,'name' =>'李龙','email'=>'lilong@dgg.net','tel'=>'18908221080','username'=>'6303158','password'=>bcrypt('123456')],
            ['id'=>2,'name' =>'管理员','email'=>'admin@dgg.net','tel'=>'13838389438','username'=>'admin','password'=>bcrypt('123456')],
        ];
        foreach ($users as $user){
            $u = \App\Models\User::create($user);
        }
        \App\Models\User::find(2)->roles()->attach(1);

    }
}
