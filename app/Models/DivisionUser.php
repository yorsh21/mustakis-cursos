<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'division_users';

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
    protected $fillable = ['aptitude_score', 'average_notes', 'grade_id', 'user_id', 'approve', 'attendance_percentage', 'binnacle', 'rol'];



    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function block_grade_users(){
        return $this->hasMany('App\Models\BlockGradeUser');
    }


    public function grade(){
        return $this->belongsTo('App\Models\Grade');
    }

    public function getResultAttribute()
    {
        if($this->approve) {
            return "Aprueba";
        }
        else {
            return "Reprueba";
        }
    }

    public function getPostResultAttribute()
    {
        if($this->approve) {
            return "Aprobó";
        }
        else {
            return "Reprobó";
        }
    }

}
