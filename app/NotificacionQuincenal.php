<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionQuincenal extends Model
{
    //
    protected $table = 'notificacion_quincenal';


    public function usuario()
    {
        return $this->belongsTo('App\User', 'usuario_id', 'id');
    }

    public function solucion()
    {
        return $this->belongsTo('App\Solucion','solucion_id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Institucion','institucion_id');
    }





}
