<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public function permissionrol(){
        return $this->hasMany('App\Models\PermissionRol');
    }


}
