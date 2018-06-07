<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoParticipante extends Model
{
    protected $table = 'tipo_participante';

    protected $primaryKey = 'id';

    public function participantes(){
    	return $this->hasMany('App\Participante');
    }
}
