<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materials';

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
    protected $fillable = ['name', 'general', 'block_id', 'file'];

    public function block()
    {
        return $this->belongsTo('App\Models\Block');
    }
    
    public function schoolWorkshop(){
        return $this->belongsTo('App\Models\SchoolWorkshop');
    }

    public function getFileNameAttribute()
    {
        $extension = explode( '.', $this->file)[1];
        return $this->name . '.' . $extension;
    }

    public function getExtensionAttribute()
    {
        return explode( '.', $this->file)[1];
    }

    public function getIconAttribute()
    {
        $extension =  explode( '.', $this->file)[1];
        $icon = '';
        switch ($extension) {
            case 'zip':
                $icon = 'fa-file-archive-o';
                break;
            case 'rar':
                $icon = 'fa-file-archive-o';
                break;
            case 'pdf':
                $icon = 'fa-file-pdf-o';
                break;
            case 'jpg':
                $icon = 'fa-file-image-o';
                break;
            case 'jpeg':
                $icon = 'fa-file-image-o';
                break;
            case 'png':
                $icon = 'fa-file-image-o';
                break;
            case 'docx':
                $icon = 'fa-file-word-o';
                break;
            case 'doc':
                $icon = 'fa-file-word-o';
                break;
            case 'xlsx':
                $icon = 'fa-file-excel-o';
                break;
            case 'xls':
                $icon = 'fa-file-excel-o';
                break;
            case 'pptx':
                $icon = 'fa-file-powerpoint-o';
                break;
            case 'ppt':
                $icon = 'fa-file-powerpoint-o';
                break;
            case 'mp3':
                $icon = 'fa-file-audio-o';
                break;
            case 'mp4':
                $icon = 'fa-file-video-o';
                break;
            case 'txt':
                $icon = 'fa-file-code-o';
                break;
            
            default:
                $icon = 'fa-file-picture-o';
                break;
        }

        return $icon;
    }

}
