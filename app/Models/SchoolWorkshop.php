<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolWorkshop extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'school_workshops';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'code', 'requirement_id', 'requirement2_id', 'requirement3_id'];


    public function parent() {
        return $this->hasOne('App\Models\SchoolWorkshop', 'id', 'requirement_id');
    }

    public function parent2() {
        return $this->hasOne('App\Models\SchoolWorkshop', 'id', 'requirement2_id');
    }

    public function parent3() {
        return $this->hasOne('App\Models\SchoolWorkshop', 'id', 'requirement3_id');
    }

    public function child() {
        return $this->belongsTo('App\Models\SchoolWorkshop', 'requirement_id', 'id');
    }

    public function child2() {
        return $this->belongsTo('App\Models\SchoolWorkshop', 'requirement2_id', 'id');
    }

    public function child3() {
        return $this->belongsTo('App\Models\SchoolWorkshop', 'requirement3_id', 'id');
    }


    public function blocks() {
        return $this->hasMany('App\Models\Block');
    }

    public function postulations() {
        return $this->hasMany('App\Models\Postulation');
    }

    public function grades() {
        return $this->hasMany('App\Models\Grade');
    }

    public function school_workshop_campus() {
        return $this->hasMany('App\Models\SchoolWorkshopsCampus');
    }
    
}
