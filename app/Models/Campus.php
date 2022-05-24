<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campus';

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
    protected $fillable = ['name', 'address', 'user_id', 'commune_id'];


    public function commune() {
        return $this->belongsTo('App\Models\Commune');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    public function rooms() {
        return $this->hasMany('App\Models\Room');
    }

    public function school_workshop_campus() {
        return $this->hasMany('App\Models\SchoolWorkshopsCampus');
    }

    public function grades() {
        return $this->hasMany('App\Models\Grade');
    }

    public function coordination_hours(){
        return $this->hasMany('App\Models\CoordinationHour');
    }

}
