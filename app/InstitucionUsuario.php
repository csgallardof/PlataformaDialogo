<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitucionUsuario extends Model {

    protected $table = 'institucion_usuarios';
    protected $primaryKey = 'id';

    /* Relacion entre Institucion y Soluciones */

    public function institucion() {
        //return $this->hasMany('App\Intitucion');
        return $this->belongsTo('App\Institucion', 'institucion_id');
    }

    /* Relacion entre Institucion y Soluciones */

    public function usuario() {
        //return $this->hasMany('App\Sector');
        return $this->belongsTo('App\User', 'usuario_id');
    }

}
