<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspPeriodoReporte extends Model
{
    public function cspPeriodoHechos(){
    	return $this->hasMany('App\CspReportesHecho');
    }
    public function cspPeriodoAlerta(){
    	return $this->hasMany('App\CspReportesAlerta');
    }
    public function cspPeriodoAccionesAlerta(){
    	return $this->hasMany('App\CspAccionesAlerta');
    }
}
