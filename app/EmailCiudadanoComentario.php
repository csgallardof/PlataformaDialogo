<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCiudadanoComentario extends Model
{
    //



    protected $table = 'email_ciudadano_comentario';



    public function solucion()
    {
        return $this->belongsTo('App\Solucion','solicitud_id');
    }

}
