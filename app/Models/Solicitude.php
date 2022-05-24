<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    const PENDING = 'pendiente';
    const APPROVED = 'aprobada';
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'solicitudes';

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
    protected $fillable = ['status', 'user_id', 'postulation_id', 'postulation_id', 'created_at',
        'updated_at'
    ];


    public function postulation()
    {
        return $this->belongsTo('App\Models\Postulation');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function solicitude_regions()
    {
        return $this->hasMany('App\Models\SolicitudeRegion');
    }

}
