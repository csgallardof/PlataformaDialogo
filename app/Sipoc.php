<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sipoc extends Model
{
    //
   // protected $fillable = ['name_sipoc'];

	protected $table = 'sipocs';

	protected $primaryKey = 'id';

	public function solucion(){

    	return $this->hasMany('App\Solucion');
    }


}
