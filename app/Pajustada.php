<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pajustada extends Model
{
    //

	protected $table = 'pajustadas';

	protected $primaryKey = 'id';

    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }

    
    public function actor_solucion()
    {
        return $this->hasMany('App\ActorSolucion','solucion_id','id');
    }

}
