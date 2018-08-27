<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionCiudadano extends Model
{
    //


    //
    protected $table = 'notificacion_ciudadano';


    public function solucion()
    {
        return $this->belongsTo('App\Solucion','not_cd_solucion_id');
    }

}
