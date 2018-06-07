<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //
	protected $table = 'eventos';

    protected $primaryKey = 'id';

    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }

    public function provincia(){

    	return $this->belongsTo('App\Provincia');
    }

    public function solucions() {
        return $this->belongsToMany('Solucion', 'user_evento_solucion','evento_id','solucion_id');
    }

    public function usuarios() {
        return $this->belongsToMany('User', 'user_evento_solucion','evento_id','user_id');
    }

    

}
