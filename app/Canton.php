<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{ 
	public static function cantones($id){
	   return Canton::Where('provincia_id','=',$id)
		->get();

	}
    public function provincia(){
    	return $this->belongsTo('App\Provincia');
    }
    public function cspAgendaTerritorial(){
    	return $this->hasMany('App\CspAgendaTerritorial');
    }
}
