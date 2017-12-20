<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','display_name','sort','parent_id'];

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
