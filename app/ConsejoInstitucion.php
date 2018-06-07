<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsejoInstitucion extends Model
{
        protected $table = 'consejo_institucions';

	protected $primaryKey = 'id';
        
            /* Relacion entre Institucion y Soluciones */

    public function institucion() {
        //return $this->hasMany('App\Intitucion');
        return $this->belongsTo('App\Institucion','institucion_id');
    }
    
        /* Relacion entre Institucion y Soluciones */

    public function consejo() {
       //return $this->hasMany('App\Sector');
        return $this->belongsTo('App\ConsejoSectorial','consejo_id');
    }
        
}
