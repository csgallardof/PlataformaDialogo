<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspAgendaTerritorial extends Model
{
    public function institucion(){
    	return $this->belongsTo('App\Institucion');
    }
    public function canton(){
    	return $this->belongsTo('App\Canton');
    }

	public function tipoAgenda(){
    	return $this->belongsTo('App\CspTipoAgenda');
    }
    public function tipoImpactoAgenda(){
    	return $this->belongsTo('App\CspTipoImpactoAgenda');
    }
    public function periodoAgenda(){
    	return $this->belongsTo('App\CspPeriodoAgenda');
    }       
}
