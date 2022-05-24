<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'periods';

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
    protected $fillable = ['name', 'description', 'start_date', 'end_date'];

    public function grades(){
        return $this->hasMany('App\Models\Grade');
    }

    public function postulations(){
        return $this->hasMany('App\Models\Postulation');
    }

    public function coordination_hours(){
        return $this->hasMany('App\Models\CoordinationHour');
    }

    public function getStartAttribute()
    {
        $date = date_create($this->start_date);
        return date_format($date, 'd/m/Y');
    }

    public function getEndAttribute()
    {
        $date = date_create($this->end_date);
        return date_format($date, 'd/m/Y');
    }

}
