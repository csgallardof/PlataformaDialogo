<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionCiudadano extends Model
{
    //

    protected $table = 'evaluacion_ciudadano';



    public function solucion()
    {
        return $this->belongsTo('App\Solucion','ev_solicitud_id');
    }



}
