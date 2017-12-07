<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_permission','permission_id','role_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Permission','parent_id','id');
    }

    public function allChilds()
    {
        return $this->childs()->with('allChilds');
    }

}
