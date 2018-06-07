<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspTipoImpactoAgenda extends Model
{
    public function cspAgendaTerritorial(){
    	return $this->hasMany('App\CspAgendaTerritorial');
    }
}
