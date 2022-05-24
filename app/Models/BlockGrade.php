<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BlockGrade extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'block_grades';

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
    protected $fillable = ['comment', 'start_date', 'end_date', 'block_id', 'grade_id', 'room_id'];

    
    public function block(){
        return $this->belongsTo('App\Models\Block');
    }

    public function grade(){
        return $this->belongsTo('App\Models\Grade');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room');
    }

    public function block_grade_users(){
        return $this->hasMany('App\Models\BlockGradeUser');
    }

    public function getStartAttribute()
    {
        return date_format(date_create($this->start_date), 'Y-m-d\TH:i');
    }

    public function getEndAttribute()
    {
        return date_format(date_create($this->end_date), 'Y-m-d\TH:i');
    }

    public function getActiveAttribute()
    {
        $date = Carbon::now('Chile/Continental');
        if($this->start_date < $date->addHours(2))
            return true;
        else
            return false;
    }

    public function getDateAttribute()
    {
        $init = date_format(date_create($this->start_date), 'd/m/Y');
        $end = date_format(date_create($this->end_date), 'd/m/Y');
        if($init == $end) {
            return $init;
        }
        else {
            return $init . " - " . $end;
        }
    }

    public function getHourAttribute()
    {
        $init = date_format(date_create($this->start_date), 'H:i');
        $end = date_format(date_create($this->end_date), 'H:i');
        
        return $init . " - " . $end;
    }

}
