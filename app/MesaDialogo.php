<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MesaDialogo extends Model
{
    protected $table = 'mesa_dialogo';

    protected $primaryKey = 'id';

    //public $timestamps = false; 

    public function tipoDialogo(){
    	return $this->belongsTo('App\TipoDialogo');
    }    

    public function organizador(){
        return $this->belongsTo('App\Institucion');
    }
    public function consejoSectorial(){
        return $this->belongsTo('App\ConsejoSectorial');
    }

    public function zona(){
        return $this->belongsTo('App\Zona');
    }
    public function provincia(){
        return $this->belongsTo('App\Provincia');
    }
    public function canton(){
        return $this->belongsTo('App\Canton');
    }
    public function parroquia(){
        return $this->belongsTo('App\Parroquia');
    }

    public function sector(){
        return $this->belongsTo('App\Sector');
    }
    public function usuario(){
    	return $this->belongsTo('App\User');
    }


    public function soluciones(){
    	return $this->hasMany('App\Solucion');
    }
    public function participantes(){
    	return $this->hasMany('App\Participante');
    }

    /*
    * Busca coincidencia con cada campo mostrado de la mesa, tomando el parámetro de búsqueda $name
    */
    public function scopeSearch($query, $name)
    {
        $query->where('nombre','LIKE',"%$name%")
                    ->orwhere('lider','LIKE',"%$name%")
                    ->orwhere('coordinador','LIKE',"%$name%")
                    ->orwhere('sistematizador','LIKE',"%$name%")
                    ->orwhere('lugar','LIKE',"%$name%")
                    ->orwhere('organizacion','LIKE',"%$name%")
                    ->orwhere('descripcion','LIKE',"%$name%");
        
        $tiposDialogo = TipoDialogo::where('nombre','LIKE',"%$name%")->get();
        if(count($tiposDialogo) > 0){
            foreach ($tiposDialogo as $tipoDialogo) {
                $query->orwhere('tipo_dialogo_id', '=',"$tipoDialogo->id" );
            }
        }
        $instituciones = Institucion::where('nombre_institucion','LIKE',"%$name%")->get();
        if(count($instituciones) > 0){
            foreach ($instituciones as $institucion) {
                $query->orwhere('organizador_id', '=',"$institucion->id" );
            }
        }
        
        $consejosSectoriales = ConsejoSectorial::where('nombre_consejo','LIKE',"%$name%")->get();
        if(count($consejosSectoriales) > 0){
            foreach ($consejosSectoriales as $consejoSectorial) {
                 $query->orwhere('consejo_sectorial_id', '=',"$consejoSectorial->id" );
            }
        }
        $zonas = Zona::where('nombre','LIKE',"%$name%")->get();
        if(count($zonas) > 0){
            foreach ($zonas as $zona) {
                $query->orwhere('zona_id', '=',"$zona->id" );
            }
        }
        $provincias = Provincia::where('nombre_provincia','LIKE',"%$name%")->get();
        if(count($provincias) > 0){
            foreach ($provincias as $provincia) {
                $query->orwhere('provincia_id', '=',"$provincia->id" );
            }
        }
        $cantones = Canton::where('nombre_canton','LIKE',"%$name%")->get();
        if(count($cantones) > 0){
            foreach ($cantones as $canton) {
                $query->orwhere('canton_id', '=',"$canton->id" );
            }
        }
        $parroquias = Parroquia::where('nombre_parroquia','LIKE',"%$name%")->get();
        if(count($parroquias) > 0){
            foreach ($parroquias as $parroquia) {
                $query->orwhere('parroquia_id', '=',"$parroquia->id" );
            }
        }
        $sectores = Sector::where('nombre_sector','LIKE',"%$name%")->get();
        if(count($sectores) > 0){
            foreach ($sectores as $sector) {
                $query->orwhere('sector_id', '=',"$sector->id" );
            }
        }

        return $query;
    }
}
