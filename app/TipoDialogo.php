<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDialogo extends Model
{
    protected $table = 'tipo_dialogo';

    protected $primaryKey = 'id';

    public function mesaDialogos(){
    	return $this->hasMany('App\MesaDialogo');
    }
}
