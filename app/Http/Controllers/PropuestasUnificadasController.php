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

        $usuario_consejo = DB::table('institucions')
                        ->select('institucions.id')
                        ->join('institucion_usuarios', 'institucion_usuarios.institucion_id', '=', 'institucions.id')
                        ->join('users', 'users.id', '=', 'institucion_usuarios.usuario_id')
                        ->where('users.id', '=', $usuario_id)
                        ->get();
        $institucion_id = $usuario_consejo[0]->id;
        //dd( $usuario_consejo[0]->id);
       

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
                                        ( actor_solucion.institucion_id = ".$institucion_id." AND tipo_actor = 1 ) OR
                                        ( actor_solucion.institucion_id = ".$institucion_id." AND tipo_actor = 2 ); 
                                        ");
        

        $notificaciones = DB::select("SELECT actividades.* FROM actividades
                                                    INNER JOIN solucions ON solucions.id = actividades.solucion_id
                                                    INNER JOIN actor_solucion ON actor_solucion.solucion_id = solucions.id
                                                    WHERE actor_solucion.user_id = ".$institucion_id." 
                                                    AND actividades.ejecutor_id = ".$institucion_id."
                                                    AND actividades.fecha_inicio >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)
                                                    ORDER BY actividades.fecha_inicio DESC; ");

        return view('institucion.PropuestasUnificadas.home')->with([ "solucionesDespliegue"=>$solucionesDespliegue,
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

        Flash::error("Se ha guardo correctamente la propuesta ajustado");

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


                        $solucionGuardada = DB::select('SELECT * from solucions where pajustada_id ='.$soluciones->pajustada_id); dd($solucionGuardada);
                       $idTabla = $solucionGuardada[0] ->id;  
                       $nombreTabla = "solucions";
                       $proceso = "insert";
                       $usuario = Auth::user()->name;
                       $cedula = Auth::user()->cedula;
                       $observacion = "Ninguna";
                        AuditoriaController::guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion );

    		}


    	}
    	//dd("se guardo");

    }


 public function verPropuestasUnificadas(){

      $usuario_id = Auth::user()->id;
        //dd($usuario_id);
        $tipo_fuente = Auth::user()->tipo_fuente;
      //  $varPrueba = 12;
      //  dd($varPrueba);//para ver los valores
//dd('HOLA');
       
    
 /* $unificadas = DB::select("select  pajustadas.nombre_pajustada, pajustadas.comentario_union 
                            from solucions 
                            inner join pajustadas 
                            on pajustadas.id = solucions.pajustada_id
                            order by solucions.pajustada_id; ");
      */
//$idAjustada = $request['idAjustada'];
$unificadas = DB::select("select  pajustadas.nombre_pajustada, pajustadas.comentario_union, id 
                            from pajustadas ; ");

 $totalPropuestaAjustada = count($unificadas);

  $solucionesDespliegue= DB::select('SELECT solucions.id, solucions.propuesta_solucion, actor_solucion.tipo_actor, estado_solucion.nombre_estado
                            from solucions
                            inner join actor_solucion on actor_solucion.solucion_id = solucions.id
                            inner join institucions on institucions.id = actor_solucion.institucion_id
                            inner join institucion_usuarios on institucion_usuarios.institucion_id = institucions.id
                            inner join users on institucion_usuarios.usuario_id = users.id
                            INNER JOIN estado_solucion ON estado_solucion.id = solucions.estado_id
                            where estado_solucion.id < 5
                            and institucions.id = ( SELECT institucions.id from institucions
                            inner join institucion_usuarios on institucion_usuarios.institucion_id = institucions.id
                            inner join users on users.id = institucion_usuarios.usuario_id
                            and users.id ='.$usuario_id.')');

        $totalPropuestas = count($solucionesDespliegue);
       

        $solucionesDespliegueConflicto= DB::select('SELECT solucions.id, solucions.propuesta_solucion, actor_solucion.tipo_actor, estado_solucion.nombre_estado
                                    from solucions
                                    inner join actor_solucion on actor_solucion.solucion_id = solucions.id
                                    inner join institucions on institucions.id = actor_solucion.institucion_id
                                    inner join institucion_usuarios on institucion_usuarios.institucion_id = institucions.id
                                    inner join users on institucion_usuarios.usuario_id = users.id
                                    INNER JOIN estado_solucion ON estado_solucion.id = solucions.estado_id
                                    where estado_solucion.id = 6
                                    and users.id ='.$usuario_id);        
       $totalPropuestaConflicto = count($solucionesDespliegueConflicto);

       $solucionesDespliegueDesestimada= DB::select('SELECT solucions.id, solucions.propuesta_solucion, actor_solucion.tipo_actor, estado_solucion.nombre_estado
                                    from solucions
                                    inner join actor_solucion on actor_solucion.solucion_id = solucions.id
                                    inner join institucions on institucions.id = actor_solucion.institucion_id
                                    inner join institucion_usuarios on institucion_usuarios.institucion_id = institucions.id
                                    inner join users on institucion_usuarios.usuario_id = users.id
                                    INNER JOIN estado_solucion ON estado_solucion.id = solucions.estado_id
                                    where estado_solucion.id = 5
                                    and users.id ='.$usuario_id);

         $totalPropuestaDesestimada = count($solucionesDespliegueDesestimada);
//dd($unificadas);
//dd($unificadas);
//$detalle = DB::select("select solucions.id, solucions.pajustada, solucions.propuesta_solucion
 //                           from solucions ; ");
 
// detallePropuestasUnificadas(1);
        
  
return view('institucion.PropuestasUnificadas.verPropuestasUnificadas')->with([
                                                "unificadas"=>$unificadas,
                                                "totalPropuestaAjustada"=>$totalPropuestaAjustada,
                                                  "totalPropuestas"=>$totalPropuestas,
                                                 "totalPropuestaConflicto"=> $totalPropuestaConflicto,
                                                 "totalPropuestaDesestimada"=> $totalPropuestaDesestimada
                                                ]);
}


//public function detallePropuestasUnificadas(Request $request){
public function detallePropuestasUnificadas(){
  //  public function detallePropuestasUnificadas (Request $request, $idAjusta){
  //  $pAjusta = Post::where('idAjusta',$idAjusta); 
      //dd($pAjusta);    
 
    $uniDetalle = DB::select("select solucions.id, solucions.pajustada, propuesta_solucion, ponderacion, lugar_solucion
                            from solucions ");
                           // where solucions.pajustada_id = "$idAjusta"; ");
  //$urlResultados = '?idAjusta='.$request->$uniDetalle1->id;
    //dd($urlResultados);
  //return view('institucion.PropuestasUnificadas.verPropuestasUnificadas.post',compact('post'));
  //->with(["uniDetalle1"=>$uniDetalle1]);


   return view('institucion.PropuestasUnificadas.detallePropuestasUnificadas')->with([
                                            "uniDetalle"=>$uniDetalle
                                            // , "urlResultados"=>$urlResultados
                                             ]);
    }

}