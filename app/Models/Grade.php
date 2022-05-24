<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grade extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grades';

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
    protected $fillable = ['capacity', 'type', 'start_date', 'end_date', 'school_workshop_id', 'period_id', 'campus_id', 'archived'];

    
    public function school_workshop(){
        return $this->belongsTo('App\Models\SchoolWorkshop');
    }

    public function campus(){
        return $this->belongsTo('App\Models\Campus');
    }

    public function period(){
        return $this->belongsTo('App\Models\Period');
    }

    public function division_users(){
        return $this->hasMany('App\Models\DivisionUser');
    }

    public function block_grades(){
        return $this->hasMany('App\Models\BlockGrade');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function getStartAttribute()
    {
        return date_format(date_create($this->start_date), 'd/m/Y');
    }

    public function getEndAttribute()
    {
        return date_format(date_create($this->end_date), 'd/m/Y');
    }

    public function getStatusAttribute()
    {
        $date = Carbon::now('Chile/Continental');
        if($this->start_date < $date && $this->end_date > $date)
            return true;
        else
            return false;
    }

    public function update_open_courses() {
        if(!$this->archived) {
            $date = Carbon::now('Chile/Continental');
            $blocks = $this->block_grades->where('end_date', '<=', $date)->count();

            foreach($this->division_users as $division_user) {
                $division_user->average_notes = 0;
                $division_user->attendance_percentage = 0;
                $division_user->approve = false;
                $weighing_counter = 0;

                foreach($this->block_grades as $block){
                    foreach($block->block_grade_users as $block_grade_user) {
                        if ($block_grade_user->division_user_id == $division_user->id) {
                            $division_user->average_notes += $block_grade_user->score*$block->block->weighing; //Nota por Ponderación de dicha Sesión
                            $division_user->attendance_percentage += $block_grade_user->presence;
                        }
                    }
                    $weighing_counter += $block->block->weighing;
                }

                if($weighing_counter != 0)
                    $division_user->average_notes = floor($division_user->average_notes/$weighing_counter);
                if($blocks != 0)
                    $division_user->attendance_percentage = floor($division_user->attendance_percentage/$blocks*100);

                if($division_user->average_notes >= 59 && $division_user->attendance_percentage >= 62) {
                    $division_user->approve = true;
                }
            }
        }
        return $this;
    }
}
