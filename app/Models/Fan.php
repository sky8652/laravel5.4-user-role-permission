<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $guarded=['language','unionid','tagid_list'];
}
