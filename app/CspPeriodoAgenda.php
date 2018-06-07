<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspPeriodoAgenda extends Model
{
    public function cspAgendaTerritorial(){
    	return $this->hasMany('App\CspAgendaTerritorial');
    }  
}
