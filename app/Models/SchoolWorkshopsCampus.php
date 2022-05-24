<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolWorkshopsCampus extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'school_workshop_campus';

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
    protected $fillable = ['campus_id', 'school_workshop_id'];


    public function school_workshop(){
        return $this->belongsTo('App\Models\SchoolWorkshop');
    }

    public function campus(){
        return $this->belongsTo('App\Models\Campus');
    }
}
