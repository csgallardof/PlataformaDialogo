<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspReportesHecho extends Model 
{
    public function cspReporteInstitucion(){
    return $this->belongsTo('App\Institucion');
    }
    public function cspReportePeriodoHecho(){
    return $this->belongsTo('App\CspPeriodoReporte');
    }

    public function scopePeriodo($query,$parametro){
    	//dd($parametro);
    	
    	$query->where('periodo_id',$parametro);
    	//dd($query);
    }


}
