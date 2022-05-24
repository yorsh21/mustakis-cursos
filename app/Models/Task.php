<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

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
    protected $fillable = ['name', 'description'];



    public function task_periods(){
        return $this->hasMany('App\Models\TaskPeriod');
    }
}
