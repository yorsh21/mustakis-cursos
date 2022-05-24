<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Answer extends MongoModel  
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mongodb';
    

    /**
     * The Collection table used by the model.
     *
     * @var string
     */
    protected $collection = 'answer';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = '_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['_id', 'answers', 'questionary', 'user_id', 'postulation_id', 'grade_id', 'block_grade_id', 'block_grade_user_id', 'updated_at', 'created_at'];


    public $incrementing = false;

}