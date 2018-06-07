<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vsector extends Model
{

	protected $primaryKey = 'id';
	
    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }


    public function user(){

    	return $this->hasMany('App\User');
    }

}
