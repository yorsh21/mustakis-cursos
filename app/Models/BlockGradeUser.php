<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockGradeUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'block_grade_users';

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
    protected $fillable = ['presence', 'score', 'specific_date', 'block_grade_id', 'division_user_id'];

    public function division_user(){
        return $this->belongsTo('App\Models\DivisionUser');
    }

    public function block_grade(){
        return $this->belongsTo('App\Models\BlockGrade');
    }

    public function getAsistenciaAttribute()
    {
        if(is_null($this->presence)) {
            return "";
        }
        elseif($this->presence == 0) {
            return "Ausente";
        }
        elseif($this->presence == 1) {
            return "Presente";
        }
        else {
            return "";
        }
    }
    
}
