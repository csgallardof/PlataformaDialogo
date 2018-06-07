<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspReportesAlerta extends Model
{
    public function cspReporteEstado(){
    return $this->belongsTo('App\CspReporteEstado');
    }
    public function cspReporteInstitucion(){
    return $this->belongsTo('App\Institucion');
    }
    public function cspAccionesAlerta(){
    	return $this->hasMany('App\CspAccionesAlerta');
    }
    public function cspReportePeriodoAlerta(){
    return $this->belongsTo('App\CspPeriodoReporte');
    }
}
