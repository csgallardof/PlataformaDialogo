<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesas';

    protected $primaryKey = 'id';

    public function solucion(){

    	return $this->hasMany('App\Solucion');
    }

}
