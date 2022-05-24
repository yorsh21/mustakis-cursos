<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blocks';

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
	protected $fillable = ['description', 'evaluation_name', 'evaluation_type', 'weighing', 'school_workshop_id', 'questionnaire_id'];


	public function materials()
	{
	    return $this->hasMany('App\Models\Material');
	}

    public function block_grades(){
        return $this->hasMany('App\Models\BlockGrade');
    }

	public function school_workshop()
	{
	    return $this->belongsTo('App\Models\SchoolWorkshop');
	}
}
