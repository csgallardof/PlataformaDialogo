<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInstitucion extends Model
{
    //
    protected $table = 'user_institucions';
    protected $primaryKey = 'id';

    /* Relacion entre Institucion y usuario */

    public function institucion() {
        //return $this->hasMany('App\Intitucion');
        return $this->hasMany('App\Institucion', 'institucion_id');
    }

    /* Relacion entre Institucion y Soluciones */

    public function usuario() {
        //return $this->hasMany('App\Sector');
        return $this->hasMany('App\User', 'user_id');
    }

  

}


