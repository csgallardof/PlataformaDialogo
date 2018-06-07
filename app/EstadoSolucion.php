<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoSolucion extends Model
{
    protected $table = 'estado_solucion';

    protected $primaryKey = 'id';

     public function soluciones(){

    	return $this->hasMany('App\Solucion');
    }
}
