<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CspReporteEstado extends Model
{
    public function cspReportesAlerta(){
    	return $this->hasMany('App\CspReportesAlerta');
    }
}
