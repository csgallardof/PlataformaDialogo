<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CnProvincia extends Model
{
    public function cnCifrasNacionales(){
    	return $this->hasMany('App\CnCifrasNacionales');
    }
    public function cnPoblacion(){
    	return $this->hasMany('App\CnPoblacion');
    }
}
