<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	const ADMIN = 1;
    const COORDINADOR = 2;
    const PROFESOR = 3;
    const ALUMNO = 4;
    const VOLUNTARIO = 5;
	const ASESOR = 6;  
	
    protected $table = 'roles';

    public function permissionrol(){
        return $this->hasMany('App\Models\PermissionRol');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function getPluralNameAttribute()
    {
    	switch ($this->id) {
    		case '1':
    			$name = $this->name . 'es';
    			break;
    		case '2':
    			$name = $this->name . 'es';
    			break;
    		case '3':
    			$name = $this->name . 'es';
    			break;
    		case '4':
    			$name = $this->name . 's';
    			break;
    		case '5':
    			$name = $this->name . 's';
    			break;
    		
    		default:
    			$name = $this->name;
    			break;
    	}
        return $name;
    }
}
