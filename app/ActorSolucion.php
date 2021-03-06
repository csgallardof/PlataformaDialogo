<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorSolucion extends Model
{
    //
    protected $table = 'actor_solucion';

    protected $primaryKey = 'id';

    public function usuario()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function solucion()
    {
        return $this->belongsTo('App\Solucion','solucion_id');
    }

   
    public function institucion()
    {
        return $this->belongsTo('App\Institucion','institucion_id');
    }



}