<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspTipoAgenda extends Model
{
    public function cspAgendaTerritorial(){
    	return $this->hasMany('App\CspAgendaTerritorial');
    }
}
