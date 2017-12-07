<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_role','role_id','user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission','role_permission','role_id','permission_id');
    }

    //角色是否有权限
    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }
        // intersect:移除任何给定数组或集合内所没有的数值：
        return !!$permission->intersect($this->permissions)->count();
    }

}
