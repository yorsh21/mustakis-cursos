<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{

    protected $fillable = ['name','region_id'];


    public function region(){
        return $this->belongsTo('App\Models\Region');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function campus(){
        return $this->hasMany('App\Models\Campus');
    }

    public function courses(){
        return $this->hasMany('App\Models\Course');
    }

    public function getCommunes(){
        $comunas = Commune::get(['id','name']);
        return $comunas;
    }

}
