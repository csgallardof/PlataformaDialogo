<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    protected $table = 'parroquia';

    protected $primaryKey = 'id';

    public static function parroquias($id){
	   return Parroquia::Where('canton_id','=',$id)->get();
	}

	public function canton(){
    	return $this->belongsTo('App\Canton');
    }
}
