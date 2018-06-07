<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambit extends Model
{
    //

	protected $table = 'ambits';

	protected $primaryKey = 'id';

    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }
}
