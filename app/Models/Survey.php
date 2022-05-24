<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Survey extends MongoModel  
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
    protected $collection = 'survey';

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
    protected $fillable = ['_id', 'name', 'description', 'questionnaires', 'updated_at', 'created_at'];


    public $incrementing = false;

}