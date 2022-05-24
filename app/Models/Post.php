<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

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
    protected $fillable = ['title', 'body', 'forum', 'division_user_id', 'parent_id', 'grade_id', 'name', 'file'];

    public function parent()
    {
        return $this->hasOne('App\Models\Post', 'id', 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Post', 'parent_id', 'id');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function division_user()
    {
        return $this->belongsTo('App\Models\DivisionUser');
    }

    public function getFullDateAttribute()
    {
        return date_format(date_create($this->end_date), 'd/m/Y H:i');
    }

    public function getFullCreatedDateAttribute()
    {
        setlocale(LC_TIME, 'Spanish');
        $date = Carbon::parse($this->created_at)->formatLocalized('%A %d de %B del %Y');
        $time = Carbon::parse($this->created_at)->format(', h:i');
        return $date . $time;
    }

    public function getCanDeleteAttribute() {
        $date = Carbon::now('Chile/Continental');
        $date->addMinutes(-15);

        if($this->created_at > $date) {
            return true;
        }
        else
            return false;
    }
}
