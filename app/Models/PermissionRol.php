<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRol extends Model
{
    protected $table = 'permission_roles';

    public function rol(){
        return $this->belongsTo('App\Models\Rol');
    }

    public function permission(){
        return $this->belongsTo('App\Models\Permission');
    }

}
