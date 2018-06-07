<?php

/* * *****************************************************************************
 * * Dialogo Nacional 2018                                                      **
 * * Módulo de Adminsitración de Consejos sectoriales                           **
 * * Funcionalidad: Modelo Consejo Sectorial                              **
 * * Desarrollado por: Fabian Quinatoa                                          **
 * * Modificado por:                                                            **
 * ***************************************************************************** */

namespace App;

use Illuminate\Database\Eloquent\Model;

/* modelo Consejo Sectorial */

class ConsejoSectorial extends Model {

	public function mesaDialogo() {
        return $this->hasMany('App\MesaDialogo');
    }
    
    /* Relacion de una a muchas Solucion */
    public function solucion() {
        return $this->hasMany('App\Solucion');
    }

    /* Relacion entre Institucion y Soluciones */
    public function institucion() {
        return $this->hasMany('App\Institucion');
    }

}
