<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    //

	protected $table = 'instrumentos';

	protected $primaryKey = 'id';

    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }
}
