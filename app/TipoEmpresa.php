<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEmpresa extends Model
{
    protected $table = 'tipo_empresa';

    protected $primaryKey = 'id';

    public function soluciones(){

    	return $this->hasMany('App\Solucion');
    }
}
