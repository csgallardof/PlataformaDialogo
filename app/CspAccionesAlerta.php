<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspAccionesAlerta extends Model
{
    public function cspReporteAlerta(){
    return $this->belongsTo('App\CspReportesAlerta');
    }
    public function cspReportePeriodoAccionAlerta(){
    return $this->belongsTo('App\CspPeriodoReporte');
    }
}
