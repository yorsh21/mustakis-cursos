<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskPeriod extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_periods';

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
    protected $fillable = ['hours', 'user_id', 'task_id', 'coordination_hour_id'];



    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function task(){
        return $this->belongsTo('App\Models\Task');
    }

    public function coordination_hour(){
        return $this->belongsTo('App\Models\CoordinationHour');
    }
}
