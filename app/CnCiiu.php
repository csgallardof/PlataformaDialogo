<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CnCiiu extends Model
{
    public function cnCifrasNacionales(){
    	return $this->hasMany('App\CnCifrasNacionales');
    }
}
