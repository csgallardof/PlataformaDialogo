<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'participante';

    protected $primaryKey = 'id';

    public function mesaDialogo(){
        return $this->belongsTo('App\MesaDialogo');
    }
    public function tipoParticipante(){
        return $this->belongsTo('App\TipoParticipante');
    }
    public function sector(){
        return $this->belongsTo('App\Sector');
    }
    public function sectorEmpresa(){
        return $this->belongsTo('App\Sector');
    }
}
