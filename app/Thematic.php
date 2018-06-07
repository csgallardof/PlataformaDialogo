<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thematic extends Model
{
    //

	protected $table = 'thematics';

	protected $primaryKey = 'id';	

    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }
}
