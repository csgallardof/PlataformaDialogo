<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $table = 'actividades';

    protected $primaryKey = 'id';

    public function institucion()
    {
        return $this->belongsTo('App\Institucion','ejecutor_id');
    }

    public function archivo()
    {
    	return $this->hasMany('App\Archivo', 'actividad_id', 'id');
    }

}