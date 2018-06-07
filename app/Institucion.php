<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
   public function cspReportesHechosInstitucion(){
    	return $this->hasMany('App\CspReportesHecho');
    }
    public function cspReportesAlertaInstitucion(){
    	return $this->hasMany('App\CspReportesAlerta');
    }
    public function cspAgendaTerritorial(){
    	return $this->hasMany('App\CspAgendaTerritorial');
    }
}
