<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'postulations';

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
	protected $fillable = ['start_date', 'end_date', 'documents', 'period_id', 'school_workshop_id', 'survey_id'];


    public function solicitudes() {
        return $this->hasMany('App\Models\Solicitude');
    }

    public function school_workshop() {
        return $this->belongsTo('App\Models\SchoolWorkshop');
    }

    public function period() {
        return $this->belongsTo('App\Models\Period');
    }

    public function getStartAttribute()
    {
        return date_format(date_create($this->start_date), 'd/m/Y');
    }

    public function getEndAttribute()
    {
        return date_format(date_create($this->end_date), 'd/m/Y');
    }

    public function getValidationAttribute()
    {
    	if(is_null($this->school_workshop->parent)) { //Verifica que el taller al que se postula tenga prerrequisitos
    		return true;
    	}
    	else {
	        $division_user = DivisionUser::where('user_id', \Auth::user()->id)->get();
	        if($division_user->count() == 0) { //Si el alumno no tiene cursos previos
	            return true;
	        }
	        else {
	            foreach ($division_user as $division) { //Busco en los cursos que ha realizado el alumno
	                //Si taller del curso que tomo el alumno es igual al prerrequisito del taller al cual se esta postulando
	                if($division->grade->school_workshop_id == $this->school_workshop->parent->id) {  
	                	if(!is_null($division->average_notes) || $division->average_notes > 4.0) {
	                		return true;
						}
	                	else {
	                		return false;
						}
	                }
	            }//No se encontraron cursos del alumno cuyo prerrequisito coincida con el taller al cual se esta postulando
	            return false;
	        }
    	}
    }

}
