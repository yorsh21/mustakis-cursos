<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CoordinationHour extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coordination_hours';

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
    protected $fillable = ['hours', 'period_id', 'campus_id'];



    public function period(){
        return $this->belongsTo('App\Models\Period');
    }

    public function campus(){
        return $this->belongsTo('App\Models\Campus');
    }

    public function task_periods(){
        return $this->hasMany('App\Models\TaskPeriod');
    }


}
