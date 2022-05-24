<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videos';

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
    protected $fillable = ['title', 'description', 'url', 'user_id'];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function video_comments(){
        return $this->hasMany('App\Models\VideoComment');
    }


    public function getDateAttribute() {
        return date_format(date_create($this->created_at), 'd-m-Y H:i');
    }

    public function getEmbedAttribute() {
        $embed1 = explode("watch?v=", $this->url);

        if(count($embed1) > 1) {
            $embed2 = explode("&", $embed1[1]);
            return $embed2[0];
        }
        else {
            return $this->url;
        }
    }
}