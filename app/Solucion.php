<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solucion extends Model
{
    //
    protected $table = 'solucions';

    protected $primaryKey = 'id';

    public static function propuestas($id){
        return Solucion::Where('tipo_fuente','=',$id)
        ->get();
    }

    public function provincia(){

        return $this->belongsTo('App\Provincia'); 
    }

    public function ambit(){

        return $this->belongsTo('App\Ambit');
    }

    public function evento(){

        return $this->belongsTo('App\Evento');
    }

    public function instrumento(){

        return $this->belongsTo('App\Instrumento');
    }

    public function pajustada(){

        return $this->belongsTo('App\Pajustada');
    }

    public function sector(){

        return $this->belongsTo('App\Sector');
    }

    public function thematic(){

        return $this->belongsTo('App\Thematic');
    }

    public function vsector(){

        return $this->belongsTo('App\Vsector');
    }

    public function sipoc(){

        return $this->belongsTo('App\Sipoc');
    }

    public function scopeSearch($query, $name)
    {
        $query->where('problema_solucion','LIKE',"%$name%")
                    ->orwhere('verbo_solucion','LIKE',"%$name%")
                    ->orwhere('sujeto_solucion','LIKE',"%$name%")
                    ->orwhere('complemento_solucion','LIKE',"%$name%")
                    ->orwhere('responsable_solucion','LIKE',"%$name%")
                    ->orwhere('corresponsable_solucion','LIKE',"%$name%")
                    ->orwhere('solucion_ccpt','LIKE',"%$name%");

        $provincias = Provincia::where('nombre_provincia','LIKE',"%$name%")->get();
        if(count($provincias) > 0){
            foreach ($provincias as $provincia) {
                $query->orwhere('provincia_id', '=',"$provincia->id" );
            }
        }

        $instrumentos= Instrumento::where('nombre_instrumento','LIKE',"%$name%")->get();
        if(count($instrumentos) > 0){
            foreach ($instrumentos as $instrumento) {
                $query->orwhere('instrumento_id', '=',"$instrumento->id" );
            }
        }

        $sipocs= Sipoc::where('nombre_sipoc','LIKE',"%$name%")->get();
        if(count($sipocs) > 0){
            foreach ($sipocs as $sipoc) {
                $query->orwhere('sipoc_id', '=',"$sipoc->id" );
            }
        }

        $eventos= Evento::where('nombre_evento','LIKE',"%$name%")->get();
        if(count($eventos) > 0){
            foreach ($eventos as $evento) {
                $query->orwhere('evento_id', '=',"$evento->id" );
            }
        }

        $ambitos= Ambit::where('nombre_ambit','LIKE',"%$name%")->get();
        if(count($ambitos) > 0){
            foreach ($ambitos as $ambito) {
                $query->orwhere('ambit_id', '=',"$ambito->id" );
            }
        }

        $tipoEmpresas= TipoEmpresa::where('nombre_tipo_empresa','LIKE',"%$name%")->get();
        if(count($tipoEmpresas) > 0){
            foreach ($tipoEmpresas as $tipoEmpresa) {
                $query->orwhere('tipo_empresa_id', '=',"$tipoEmpresa->id" );
            }
        }

        $sectors= Sector::where('nombre_sector','LIKE',"%$name%")->get();
        if(count($sectors) > 0){
            foreach ($sectors as $sector) {
                $query->orwhere('sector_id', '=',"$sector->id" );
            }
        }

        $mesas= Mesa::where('nombre_mesa','LIKE',"%$name%")->get();
        if(count($mesas) > 0){
            foreach ($mesas as $mesa) {
                $query->orwhere('mesa_id', '=',"$mesa->id" );
            }
        }

        $pajustadas= Pajustada::where('nombre_pajustada','LIKE',"%$name%")->get();
        if(count($pajustadas) > 0){
            foreach ($pajustadas as $pajustada) {
                $query->orwhere('pajustada_id', '=',"$pajustada->id" );
            }
        }

        return $query;

    }

    public function tipoEmpresa(){

        return $this->belongsTo('App\TipoEmpresa');
    }

    public function mesa(){

        return $this->belongsTo('App\Mesa');
    }

    public static function solucionesPorTipo($tipo_fuente){

        return Solucion::where('tipo_fuente','=',$tipo_fuente)->get();
    }

    public function actorSolucion(){

        return $this->hasMany('App\ActorSolucion');
    }

    public function actor_solucion()
    {
        return $this->hasMany('App\ActorSolucion','solucion_id','id');
    }

    public function estado(){

        return $this->belongsTo('App\EstadoSolucion');
    }

}
