<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CnCifrasNacionales extends Model
{
    public function cnTipoImpuesto(){
    	return $this->belongsTo('App\CnTipoImpuesto');
    }
    public function cnCiiu(){
    	return $this->belongsTo('App\CnCiiu');
    }

    public function cnProvincia(){
    	return $this->belongsTo('App\CnProvincia');
    }

    public function cnTipoCifraNacional(){
    	return $this->belongsTo('App\CnTipoCifraNacional');
    }

    public function cnTipoEmpresa(){
    	return $this->belongsTo('App\CnTipoEmpresa');
    }
    public function cnTipoFuente(){
    	return $this->belongsTo('App\CnTipoFuente');
    }
}
