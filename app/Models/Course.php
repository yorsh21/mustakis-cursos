<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //protected $table = 'courses';
    //

    protected $fillable = ['name','score','commune_id'];

    public function Commune(){
        return $this->belongsTo('App\Models\Commune');
    }
}
