<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CnPoblacion extends Model
{
    public function cnProvincia(){
    	return $this->belongsTo('App\CnProvincia');
    }
    public function cnTipoFuente(){
    	return $this->belongsTo('App\CnTipoFuente');
    }
}
