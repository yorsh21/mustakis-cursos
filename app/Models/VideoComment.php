<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video_comments';

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
    protected $fillable = ['comments', 'user_id', 'video_id'];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function video(){
        return $this->belongsTo('App\Models\User');
    }

    public function getDateAttribute() {
        return date_format(date_create($this->created_at), 'd-m-Y H:i');
    }
}