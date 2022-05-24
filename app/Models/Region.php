<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    public function communes(){
        return $this->hasMany('App\Models\Commune');
    }

    public function solicitude_regions(){
        return $this->hasMany('App\Models\SolicitudeRegion');
    }

}
