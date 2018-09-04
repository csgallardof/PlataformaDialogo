<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solucion;
use App\Actividad;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Collection as Collection;

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

    public function exportarPropuestaDetallada($idPropuesta){
        
        
        //$solucion = Solucion::where('id','=',$idPropuesta)->get(); 

            
        \Excel::create('Propuesta Detallada', function($excel) use($idPropuesta){
            $estado_solucion = DB::table('solucions')->where('id', $idPropuesta)->first();

            if ($estado_solucion->estado_id==1) {
                //dd('estoy aki');
                $solucion = DB::table('solucions')  
                                                    ->join('estado_solucion','estado_solucion.id', '=','solucions.estado_id')
                                                    ->where('solucions.id', $idPropuesta)
                                                    ->select('solucions.*','estado_solucion.nombre_estado')
                                                    ->first();
                
                 $excel->sheet('Propuesta Solucion', function($sheet) use($solucion) {
       
            
            $sheet->cells('A1:F1',function($cells){
                $cells->setBackground('#A6ACAF');
            });   
         
            $sheet->row(1, [
                'CODIGO',
                'FECHA CREACION',
                'PROBLEMA SOLUCION',
                'PROPUESTA SOLUCIÓN',
                'RESPONSABLE DE EJECUCIÓN',
                'CO-RESPONSABLES DE EJECUCIÓN',
                'ESTADO',
                'ACTIVIDADES'
            ]);

                
               
                $sheet->row(2, [
                    strtoupper($solucion->id),
                    strtoupper(substr($solucion->created_at,0,10)),
                    strtoupper($solucion->problema_solucion),
                    strtoupper($solucion->propuesta_solucion),
                    strtoupper($solucion->responsable_solucion),
                    strtoupper($solucion->corresponsable_solucion),
                    strtoupper($solucion->nombre_estado),
                    strtoupper('No se encontraron actividades registradas.')
                ]); 
            
        
            
         
        });
            }else{
         
            DB::statement('SET GLOBAL group_concat_max_len = 9000000'); 
        $solucion= DB::table('solucions')->leftJoin('actividades', 'actividades.solucion_id', '=', 'solucions.id')
                                            ->leftJoin('estado_solucion', 'estado_solucion.id', '=', 'solucions.estado_id')
                                            ->leftJoin('actor_solucion', 'actor_solucion.solucion_id', '=', 'solucions.id')
                                            ->leftJoin('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
                                            ->WHERE('solucions.id','=', $idPropuesta)
                                            ->Where('actor_solucion.tipo_actor','=', 1)     
                                            ->select('solucions.*','estado_solucion.nombre_estado','institucions.nombre_institucion')
                                            ->selectRAW('GROUP_CONCAT(actividades.comentario) as actividades')
                                            ->groupBy('solucions.id')
                                            ->first();
       
       
       
       //dd($estado_solucion->estado_id);
            
            $excel->sheet('Propuesta Solucion', function($sheet) use($solucion) {
        
            
            $sheet->cells('A1:H1',function($cells){
                $cells->setBackground('#A6ACAF');
            });   
         
            $sheet->row(1, [
                'CODIGO',
                'FECHA CREACION',
                'PROBLEMA SOLUCION',
                'PROPUESTA SOLUCIÓN',
                'RESPONSABLE DE EJECUCIÓN',
                'CO-RESPONSABLES DE EJECUCIÓN',
                'ESTADO',
                'ACTIVIDADES'
            ]);

            
               
                $sheet->row(2, [
                    strtoupper($solucion->id),
                    strtoupper(substr($solucion->created_at,0,10)),
                    strtoupper($solucion->problema_solucion),
                    strtoupper($solucion->propuesta_solucion),
                    strtoupper($solucion->nombre_institucion),
                    strtoupper($solucion->corresponsable_solucion),
                    strtoupper($solucion->nombre_estado),
                    strtoupper(strip_tags($solucion->actividades))
                ]); 
            
        
            
         
        });
        }
         
        })->export('xlsx');

    }

    public function exportarPropuestasDialogoNacional(Request $request){
    dd("exportarPropuestasDialogoNacional".$request);
        \Excel::create('Dialogo Nacional', function($excel) use($request) {

            $cheches = $request['check'];
            $check="";
     
        for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        //dd($consulta);
        $solucion=DB::select("SELECT solucions.*, estado_solucion.nombre_estado, institucions.nombre_institucion FROM solucions
            JOIN estado_solucion ON estado_solucion.id=solucions.estado_id
            LEFT JOIN actor_solucion on actor_solucion.solucion_id = solucions.id
            LEFT JOIN institucions on institucions.id = actor_solucion.institucion_id  
            WHERE solucions.id in ($consulta) "); 
        //dd($agendaTerritorialMAP);
        $solucion=Collection::make($solucion);
        //dd($solucion);
            $excel->sheet('Propuestas Dialogo', function($sheet) use($solucion) {
         
            $sheet->row(1, [
                'CODIGO',
                'FECHA CREACION',
                'PROBLEMA SOLUCION',
                'PROPUESTA SOLUCIÓN',
                'RESPONSABLE DE EJECUCIÓN',
                'CO-RESPONSABLES DE EJECUCIÓN',
                'ESTADO'
            ]);

            foreach($solucion as $index => $solucion) {
               

                $sheet->row($index+2, [
                    strtoupper($solucion->id),
                    strtoupper(substr($solucion->created_at,0,10)),
                    strtoupper($solucion->problema_solucion),
                    strtoupper($solucion->propuesta_solucion),
                    strtoupper($solucion->nombre_institucion),
                    strtoupper($solucion->nombre_institucion),
                    strtoupper($solucion->nombre_estado)
                ]); 
            }

            
         
        });
         
        })->export('xlsx');

    }

    


}




