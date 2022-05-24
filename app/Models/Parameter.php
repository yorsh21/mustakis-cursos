<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parameters';

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
    protected $fillable = ['type', 'key', 'value'];

    

    public function getNameAttribute()
    {
        $document = "";

        switch ($this->key) {
            case 'auth_doc':
                $document = 'Carta Autorización Apoderados';
                break;
            case 'school_doc':
                $document = 'Carta de Compromiso Colegios';
                break;
            case 'cession_doc':
                $document = 'Cesión de Imagen';
                break;
            case 'license_student':
                $document = 'Cédula de identidad digitalizada estudiante';
                break;
            case 'license_tutor':
                $document = 'Cédula de identidad digitalizada tutor';
                break;
            case 'recomendation_doc':
                $document = 'Carta de Recomendación';
                break;
            default:
                break;
        }
        return $document;
    }
}
