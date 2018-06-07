<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ActorSolucion;
use App\Solucion;
use App\User;
use App\Pajustada;
use DB;
use Laracasts\Flash\Flash;
use Mail; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class PropuestasUnificadasController extends Controller
{
    public function mostrarPropuestas(){
    	$usuario_id = Auth::user()->id;
        $tipo_fuente = Auth::user()->tipo_fuente;
       

        $totalDespliegue = Solucion::where('tipo_fuente','=',1)->count();
        $totalConsejo = Solucion::where('tipo_fuente','=',2)->count();

        $totalResponsable = ActorSolucion::where('user_id','=',$usuario_id)
                                         ->where('tipo_actor','=','1')->count();
        $totalCorresponsable = ActorSolucion::where('user_id','=',$usuario_id)
                                         ->where('tipo_actor','=','2')->count();

        $solucionesDespliegue= DB::select("SELECT solucions.*, actor_solucion.tipo_actor,estado_solucion.nombre_estado,pajustadas.nombre_pajustada FROM solucions 
                                        INNER JOIN actor_solucion ON actor_solucion.solucion_id = solucions.id
                                        INNER JOIN estado_solucion ON estado_solucion.id = solucions.estado_id
                                        LEFT JOIN pajustadas ON solucions.pajustada_id = pajustadas.id
                                        WHERE 
                                        ( actor_solucion.tipo_fuente = 1 AND actor_solucion.user_id = ".$usuario_id." AND tipo_actor = 1 ) OR
                                        ( actor_solucion.tipo_fuente = 1 AND actor_solucion.user_id = ".$usuario_id." AND tipo_actor = 2 ); 
                                        ");
        //dd($solucionesDespliegue);
        $solucionesCCPT = DB::select("SELECT DISTINCT pajustadas.*, actor_solucion.tipo_actor, solucions.tipo_fuente 
                                    FROM pajustadas 
                                    INNER JOIN actor_solucion ON actor_solucion.solucion_id = pajustadas.id
                                    INNER JOIN solucions ON solucions.pajustada_id = pajustadas.id

                                    WHERE 
                                    ( actor_solucion.tipo_fuente = 2 AND actor_solucion.user_id = ".$usuario_id." AND tipo_actor = 1 ) OR
                                    ( actor_solucion.tipo_fuente = 2 AND actor_solucion.user_id = ".$usuario_id." AND tipo_actor = 2 ); 
                                    ");

        $notificaciones = DB::select("SELECT actividades.* FROM actividades
                                                    INNER JOIN solucions ON solucions.id = actividades.solucion_id
                                                    INNER JOIN actor_solucion ON actor_solucion.solucion_id = solucions.id
                                                    WHERE actor_solucion.user_id = ".$usuario_id." 
                                                    AND actividades.ejecutor_id = ".$usuario_id."
                                                    AND actividades.fecha_inicio >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)
                                                    ORDER BY actividades.fecha_inicio DESC; ");

        return view('institucion.PropuestasUnificadas.home')->with([ "solucionesDespliegue"=>$solucionesDespliegue,
                                                "solucionesCCPT"=>$solucionesCCPT,
                                                "totalDespliegue"=>$totalDespliegue,
                                                "totalConsejo"=>$totalConsejo,
                                                "totalResponsable"=>$totalResponsable,
                                                "totalCorresponsable"=>$totalCorresponsable,
                                                "notificaciones"=>$notificaciones,
                                                "tipo_fuente"=>$tipo_fuente     
                                                 ]);
    }

    public function obtenerPropuestasUnificadas(Request $request){


        if( is_null($request['check'])){
            Flash::error("No a seleccionado ninguna propuesta. Seleccione 2 o mas Propuestas");
            return redirect('/institucion/unificar-propuestas');

        }else{
    	$checks = $request['check'];
    	$check="";
        
    	for ($i=0; $i <count($checks) ; $i++) { 
            $check .= $checks[$i].",";
        }
        $consulta=substr($check,0,-1);
    	 $tipo_fuente = Auth::user()->tipo_fuente;


    	
    	$solucionesDespliegue= DB::select("SELECT * FROM solucions WHERE id in($consulta)");
    	$sumaPAjustada=0;
    	$propuestaPajustada=true;
    	$idPajustadas="";
    	$idPropuestasSinPa="";
    	//$idActualPajustadas=0;
    	//$idsiguientePajustadas=0;
    	foreach ($solucionesDespliegue as $soluciones) {
    		$sumaPAjustada += $soluciones->pajustada_id;
    		if($soluciones->pajustada_id==0){
    			//dd($soluciones->id);
    			$idPropuestasSinPa .= $soluciones->id.",";
    			$propuestaPajustada=false;
    		}else{
    			
    			$idPajustadas .= $soluciones->pajustada_id.",";
    		}


    	}
    	$consultaIDPajustadas=substr($idPajustadas,0,-1);
    	$consultaIDPropuestasSinPa=substr($idPropuestasSinPa,0,-1);
    	$solucionesSinPa= DB::select("SELECT * FROM solucions WHERE id in($consultaIDPropuestasSinPa)");
    	//dd($solucionesSinPa,$consultaIDPropuestasSinPa,$propuestaPajustada);
    	
    	//dd($idPajustadas,$consultaIDPajustadas);
    	if($sumaPAjustada==0){
    	return view('institucion.PropuestasUnificadas.createUnificarPropuestas')->with([
    											"consulta"=>$consulta,
    											"tipo_fuente"=>$tipo_fuente,
    											"solucionesDespliegue"=>$solucionesDespliegue
                                                 ]);
    	}else{
    		
    		if($propuestaPajustada==false){

    			$pAjustadaConsulta= DB::select("SELECT * FROM pajustadas WHERE id in($consultaIDPajustadas)");
    			 $pAjustadaConsulta=Collection::make($pAjustadaConsulta);

				$solucionPajustadas= DB::select("SELECT solucions.verbo_solucion,solucions.sujeto_solucion,solucions.complemento_solucion,pajustadas.nombre_pajustada FROM solucions 
					JOIN pajustadas ON pajustadas.id = solucions.pajustada_id
					WHERE solucions.id in($consulta)
                                      ");
    			 $solucionPajustadas=Collection::make($solucionPajustadas);

    			//dd($solucionPajustadas);

    		return view('institucion.PropuestasUnificadas.createUnificarElegirPropuestasComboBox')->with([
    											"consulta"=>$consulta,
    											"tipo_fuente"=>$tipo_fuente,
    											"solucionPajustadas"=>$solucionPajustadas,
    											"solucionesSinPa"=>$solucionesSinPa,
    											"pAjustadaConsulta"=>$pAjustadaConsulta
    																			]);
    		}

    		
    	}
    }
    }

    public function guardarPajustadaUnificar(Request $request){

		$propuestas = $request['idPropuestas'];
		$pAjusta = $request['palabraAjustada'];
		$comentario = $request['comentarioUnion'];

		$Pajustada = new Pajustada;
        $Pajustada-> nombre_pajustada = $pAjusta;
        $Pajustada-> comentario_union = $comentario;
        $Pajustada-> save();

         $pAjustadaCreada = DB::table('pajustadas')->where('nombre_pajustada', $pAjusta )->first();


                    $array = explode(",", $propuestas);
                    
                    foreach ($array as $array) {
                        
                        $Solucion = Solucion::find($array);
 						
				        $Solucion-> pajustada_id = $pAjustadaCreada->id;
				        
				        $Solucion-> save();
                    }

		return redirect('/institucion/home'); 
    }

    public function definirPajustada(Request $request){

    	$propuestas = $request['idPropuestas'];
		$pAjusta = $request['pajustada_id'];
		//dd($propuestas,$pAjusta);
		$solucionesDespliegue= DB::select("SELECT * FROM solucions WHERE id in($propuestas)");
		//dd($solucionesDespliegue);
		foreach ($solucionesDespliegue as $soluciones) {
    		
    		if($soluciones->pajustada_id==0){
    				//dd($soluciones->id);
    			 $Solucion = Solucion::find($soluciones->id);
 						
				        $Solucion-> pajustada_id = $pAjusta;
				        
				        $Solucion-> save();
    		}


    	}
    	//dd("se guardo");

    }
}
