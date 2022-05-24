<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Certificate extends MongoModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection = 'certificates';

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
    protected $fillable = ['_id', 'name', 'background', 'horizontal', 'properties', 'fields', 'updated_at', 'created_at'];

    /**
     * User Fields for generate certificates.
     *
     * @var array
     */
    const ROWS = [
        'name' => "Nombre",
        'email' => "Correo",
        'rut' => "RUT",
        'birth_date' => "Fecha de Nacimiento",
        'genere' => "Genero",
        'phone_number' => "Teléfono",
        'address' => "Dirección",
        'commune' => "Comuna",
        'region' => "Región",
        'course' => "Curso",
        'establishment' => "Colegio",
    ];

    public $incrementing = false;


    function getBackgroundUrlAttribute() {
        return "certificates/" . $this->background;
    }

}
