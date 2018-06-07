<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solucion;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //

    public function exportMesas(){

		\Excel::create('Consejo Consultivo', function($excel) {
		 
		    $mesas = Solucion::where('tipo_fuente','=',2)
                                ->where('sector_id','=',7)
                                ->orderBy('verbo_solucion','ASC')->get();
		 
		    $excel->sheet('Mesas', function($sheet) use($mesas) {
		 
			$sheet->row(1, [
    			
    			'PROPUESTA VERBO',
                'PROPUESTA SOLUCIÓN',
    			'PROBLEMÁTICA',
    			'PROVINCIA',
    			'ESLABON DE LA CADENA PRODUCTIVA',
    			'INSTRUMENTOS NECESARIOS',
				'CLASIFICACIÓN EMPRESA RELACIONADA',
				'AMBITO',
				'RESPONSABLE DE EJECUCIÓN',
				'CO-RESPONSABLES DE EJECUCIÓN',
				'ESTADO'
			]);

			foreach($mesas as $index => $solucion) {
    			$actores= $solucion->actor_solucion;
    			$responsable="";
    			$corresponsable="";
    			foreach ($actores as $actor) {
    			 	if($actor->tipo_actor == 1){
    			 		$responsable = $actor->usuario->name;
    			 	}
    			 	if($actor->tipo_actor == 2){
    			 		$corresponsable = $corresponsable."- ". $actor->usuario->name;
    			 	}
    			}

    			$sheet->row($index+2, [
        			strtoupper($solucion->verbo_solucion),
                    strtoupper($solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion),
        			strtoupper($solucion->problema_solucion),
        			strtoupper($solucion->provincia->nombre_provincia),
        			strtoupper($solucion->sipoc->nombre_sipoc),
        			strtoupper($solucion->instrumento->nombre_instrumento),
        			strtoupper($solucion->tipoEmpresa->nombre_tipo_empresa),
        			strtoupper($solucion->ambit->nombre_ambit),
        			strtoupper($responsable),
        			strtoupper($corresponsable),
        			strtoupper($solucion->estado->nombre_estado)
    			]); 
			}

		    
		 
		});
		 
		})->export('xlsx');


    }

    public function exportConsejo(){
    	
		\Excel::create('Consejo Consultivo', function($excel) {
		 
		    $consejo = Solucion::where('tipo_fuente','=',2)->orderBy('solucion_ccpt','ASC')->get();
		 
		    $excel->sheet('Consejo', function($sheet) use($consejo) {
		 
		    $sheet->row(1, [
    			
    			'PROPUESTA ORIGINAL',
    			'MESA',
    			'SECTOR',
    			'ESLABON DE LA CADENA PRODUCTIVA',
    			'FOMENTO DE LA PRODUCCIÓN NACIONAL',
    			'AMBITO',
    			'PROPUESTA AJUSTADA',
    			'RESPONSABLE DE EJECUCIÓN',
				'CO-RESPONSABLES DE EJECUCIÓN',
				'ESTADO'
			]);

			foreach($consejo as $index => $solucion) {
    			$actores= $solucion->actor_solucion;
    			$responsable="";
    			$corresponsable="";
    			foreach ($actores as $actor) {
    			 	if($actor->tipo_actor == 1){
    			 		$responsable = $actor->usuario->name;
    			 	}
    			 	if($actor->tipo_actor == 2){
    			 		$corresponsable = $corresponsable."- ". $actor->usuario->name;
    			 	}
    			}

    			$sheet->row($index+2, [
        			trim( strtoupper($solucion->solucion_ccpt) ),
        			strtoupper($solucion->mesa->nombre_mesa),
        			strtoupper($solucion->sector->nombre_sector),
        			strtoupper($solucion->sipoc->nombre_sipoc),
        			strtoupper($solucion->thematic->nombre_thematic),
        			strtoupper($solucion->ambit->nombre_ambit),
        			strtoupper($solucion->pajustada->nombre_pajustada),
        			strtoupper($responsable),
        			strtoupper($corresponsable),
        			strtoupper($solucion->estado->nombre_estado)
    			]); 
			}
		 
		});
		 
		})->export('xlsx');	
    }

}




