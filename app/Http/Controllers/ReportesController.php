<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Collection as Collection;
use DB;
use App\User;
use App\Institucion;
use App\Solucion;
use App\ActorSolucion;
use App\InstitucionUsuario;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class ReportesController extends Controller {

 
public function listaMinisterio(Request $request) {
//dd( $request);


$hoy = date("d/m/Y"); 

  $periodo = $request->selPeriodo;

//  dd($periodo);

        $soluciones =  DB::table('solucions')
        //Solucion::all() 
        ->paginate(4);
       // dd( $soluciones);

       //dd(Auth::user()->id);


$institucionUsuario = DB::select("SELECT * FROM institucion_usuarios 
WHERE usuario_id=".Auth::user()->id." ;");
// dd($institucionUsuario[0]->id);

     
$usuario = User::where('id','=',$institucionUsuario[0]->usuario_id)
                            ->get();
$nombreusuario = $usuario[0]->name;
//dd($nombreusuario);


$institucion = Institucion::where('id','=',$institucionUsuario[0]->institucion_id)
                            ->get();
                            

$nombreinstitucion = $institucion[0]->nombre_institucion;
//dd($institucionUsuario[0]->institucion_id);
//dd($nombre_institucion);


//dd($institucion[0]->id);
$consejo = DB::select("SELECT consejo_sectorials.nombre_consejo,institucions.id FROM consejo_sectorials 
								JOIN consejo_institucions 
								ON consejo_sectorials.id = consejo_institucions.consejo_id
								JOIN institucions
								ON consejo_institucions.institucion_id = institucions.id
								WHERE institucions.id = ".$institucion[0]->id.";");

//dd($consejo); 


$nombreConsejo = $consejo[0]->nombre_consejo; 
//dd($nombreConsejo); 

    $resultadosreporte = ActorSolucion::select('solucions.*','institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politica')
                      //Solucion::select('solucions.*','i.id', 'i.nombre_institucion', 'p.nombre_politica')
                                 ->join('solucions', 'solucions.id', '=', 'actor_solucion.solucion_id')
                                 ->join('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
                                 ->join('politicas', 'politicas.id', '=', 'solucions.politica_id')
                                // ->orderBy('solucions.estado_id','DESC')
                                //  ->groupBy ( 'institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politicaS')
        
                                 //->get();
                                 ; 


 $propuestasRecibidas = DB::select(" SELECT i.id, i.nombre_institucion
									,count(e.nombre_estado) as propuestasRecibidas
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join estado_solucion e
									on s.estado_id = e.id
									where i.id=".$institucion[0]->id."
									group by i.id,i.nombre_institucion
									order by i.id, e.id");

//dd($propuestasRecibidas);
//dd($propuestasRecibidas[0]->propuestasRecibidas);
if($propuestasRecibidas){
	$numPropuestasRecibidas = $propuestasRecibidas[0]->propuestasRecibidas;
}else{
	$numPropuestasRecibidas = 0;
}
//dd($numPropuestasRecibidas);


$propuestasDesestimadas = DB::select(" SELECT i.id, i.nombre_institucion
									,count(e.nombre_estado) as propuestasDesestimadas
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join estado_solucion e
									on s.estado_id = e.id
									where i.id=".$institucion[0]->id."
									and e.nombre_estado = 'Desestimadas'
									group by i.id,i.nombre_institucion
									order by i.id, e.id");

if($propuestasDesestimadas){
	$numPropuestasDesestimadas = $propuestasDesestimadas[0]->propuestasDesestimadas;
}else{
	$numPropuestasDesestimadas = 0;
}

//dd($numPropuestasDesestimadas); 

$numPropuestasValidadas = $numPropuestasRecibidas - $numPropuestasDesestimadas;

//dd($numPropuestasValidadas);


$propuestasAnalisadas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasAnalisadas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where  e.nombre_estado = 'En Analisis'
										and i.id = ".$institucion[0]->id."
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");

//dd($propuestasAnalisadas);
if($propuestasAnalisadas){
	$numPropuestasAnalisadas = $propuestasAnalisadas[0]->propuestasAnalisadas;
}else{
	$numPropuestasAnalisadas = 0;
}

//dd($numPropuestasAnalisadas);

$propuestasPolitica = DB::select("SELECT count(politica_id) as propuestasPolitica
									from solucions
									join politicas on solucions.politica_id = politicas.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id = ".$institucion[0]->id." ");

if($propuestasPolitica){
	$numPropuestasPolitica = $propuestasPolitica[0]->propuestasPolitica;
}else{
	$numPropuestasPolitica = 0;
}

//dd($numPropuestasPolitica);

$propuestasLeyes = DB::select("SELECT count(instrumento_id) as propuestasLeyes
									from solucions
									join instrumentos on solucions.instrumento_id = instrumentos.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id =".$institucion[0]->id." "); 

if($propuestasLeyes){
	$numPropuestasLeyes = $propuestasLeyes[0]->propuestasLeyes;
}else{
	$numPropuestasLeyes = 0;
}
//dd($numPropuestasLeyes);

$propuestasDesarrolladas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasDesarrolladas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'En Desarrollo'
										and i.id = ".$institucion[0]->id."
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");


if($propuestasDesarrolladas){
	$numPropuestasDesarrolladas = $propuestasDesarrolladas[0]->propuestasDesarrolladas;
}else{
	$numPropuestasDesarrolladas = 0;
}
//dd($numPropuestasDesarrolladas);


$propuestasFinalisadas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasFinalisadas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'Finalizado'
										and i.id = ".$institucion[0]->id."
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");


if($propuestasFinalisadas){
	$numPropuestasFinalisadas = $propuestasFinalisadas[0]->propuestasFinalisadas;
}else{
	$numPropuestasFinalisadas = 0;
}
//dd($numPropuestasAnalisadas);


$propuestasPlazoLargo = DB::select("SELECT   count(plazo_cumplimiento) as largo
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id = ".$institucion[0]->id."
									and s.plazo_cumplimiento = 'Largo'");



if($propuestasPlazoLargo){
	$numPropuestasPlazoLargo = $propuestasPlazoLargo[0]->largo;
}else{
	$numPropuestasPlazoLargo = 0;
}
//dd($numPropuestasPlazoLargo);


$propuestasPlazoMediano = DB::select("SELECT   count(plazo_cumplimiento) as mediano
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id = ".$institucion[0]->id." 
									and s.plazo_cumplimiento = 'Mediano'");

if($propuestasPlazoMediano){
	$numPropuestasPlazoMediano = $propuestasPlazoMediano[0]->mediano;
}else{
	$numPropuestasPlazoMediano = 0;
}
//dd($numPropuestasPlazoMediano);


$propuestasPlazoCorto = DB::select("SELECT   count(plazo_cumplimiento) as corto
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id = ".$institucion[0]->id." 
									and s.plazo_cumplimiento = 'Mediano'");

if($propuestasPlazoCorto){
	$numPropuestasPlazoCorto = $propuestasPlazoCorto[0]->corto;
}else{
	$numPropuestasPlazoCorto = 0;
}
//dd($numPropuestasPlazoMediano);


//dd($resultadosreporte);

return view('publico.reportes.reporteMinisterio')->with( ["hoy" => $hoy,
															"soluciones" => $soluciones,
        	                                                      "nombreusuario" => $nombreusuario,
        	                                                      "nombreinstitucion"=> $nombreinstitucion,
        	                                                      "nombreConsejo" => $nombreConsejo,
        	                                                      "numPropuestasRecibidas" => $numPropuestasRecibidas,
        	                                                      "numPropuestasDesestimadas" => $numPropuestasDesestimadas,
        	                                                      "numPropuestasValidadas" => $numPropuestasValidadas,
        	                                                      "numPropuestasAnalisadas" => $numPropuestasAnalisadas,
        	                                                      "numPropuestasDesarrolladas" => $numPropuestasDesarrolladas,
        	                                                      "numPropuestasFinalisadas" => $numPropuestasFinalisadas,
        	                                                      "numPropuestasPolitica" => $numPropuestasPolitica,
        	                                                      "numPropuestasLeyes" => $numPropuestasLeyes,
        	                                                      "numPropuestasPlazoLargo" => $numPropuestasPlazoLargo,
        	                                                      "numPropuestasPlazoMediano" => $numPropuestasPlazoMediano,
        	                                                      "numPropuestasPlazoCorto" => $numPropuestasPlazoCorto,
        	                                                      "resultadosreporte" => $resultadosreporte
        	                                                      ] );

    }



public function exportarExcelReporteMinisterio(Request $request){
      //   dd("exportarExcelReporteMinisterio".$request);

         
        \Excel::create('Reporte Ministerio', function($excel) use($request) {

       /*     $cheches = $request['check'];
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
           limit 10"); 
        //dd($agendaTerritorialMAP);
        $solucion=Collection::make($solucion);
*/

 $hoy = date("d/m/Y"); 

$institucionUsuario = DB::select("SELECT * FROM institucion_usuarios 
WHERE usuario_id=".Auth::user()->id." ;");
// dd($institucionUsuario[0]->id);

     
$usuario = User::where('id','=',$institucionUsuario[0]->usuario_id)
                            ->get();
$nombreusuario = $usuario[0]->name;
//dd($nombreusuario);


$institucion = Institucion::where('id','=',$institucionUsuario[0]->institucion_id)
                            ->get();
$nombreinstitucion = $institucion[0]->nombre_institucion;
//dd($institucionUsuario[0]->institucion_id);
//dd($nombre_institucion);

//dd($institucion[0]->id);
$consejo = DB::select("SELECT consejo_sectorials.nombre_consejo,institucions.id FROM consejo_sectorials 
								JOIN consejo_institucions 
								ON consejo_sectorials.id = consejo_institucions.consejo_id
								JOIN institucions
								ON consejo_institucions.institucion_id = institucions.id
								WHERE institucions.id = ".$institucion[0]->id.";");

//dd($consejo); 


$nombreConsejo = $consejo[0]->nombre_consejo; 
//dd($nombreConsejo); 

    $resultadosreporte = ActorSolucion::select('solucions.*','institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politica')
                      //Solucion::select('solucions.*','i.id', 'i.nombre_institucion', 'p.nombre_politica')
                                 ->join('solucions', 'solucions.id', '=', 'actor_solucion.solucion_id')
                                 ->join('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
                                 ->join('politicas', 'politicas.id', '=', 'solucions.politica_id')
                                // ->orderBy('solucions.estado_id','DESC')
                                //  ->groupBy ( 'institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politicaS')
        
                                 //->get();
                                 ; 


 $propuestasRecibidas = DB::select(" SELECT i.id, i.nombre_institucion
									,count(e.nombre_estado) as propuestasRecibidas
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join estado_solucion e
									on s.estado_id = e.id
									where i.id=".$institucion[0]->id."
									group by i.id,i.nombre_institucion
									order by i.id, e.id");

//dd($propuestasRecibidas);
//dd($propuestasRecibidas[0]->propuestasRecibidas);
if($propuestasRecibidas){
	$numPropuestasRecibidas = $propuestasRecibidas[0]->propuestasRecibidas;
}else{
	$numPropuestasRecibidas = 0;
}
//dd($numPropuestasRecibidas);


$propuestasDesestimadas = DB::select(" SELECT i.id, i.nombre_institucion
									,count(e.nombre_estado) as propuestasDesestimadas
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join estado_solucion e
									on s.estado_id = e.id
									where i.id=".$institucion[0]->id."
									and e.nombre_estado = 'Desestimadas'
									group by i.id,i.nombre_institucion
									order by i.id, e.id");

if($propuestasDesestimadas){
	$numPropuestasDesestimadas = $propuestasDesestimadas[0]->propuestasDesestimadas;
}else{
	$numPropuestasDesestimadas = 0;
}

//dd($numPropuestasDesestimadas); 

$numPropuestasValidadas = $numPropuestasRecibidas - $numPropuestasDesestimadas;

//dd($numPropuestasValidadas);


$propuestasAnalisadas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasAnalisadas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where  e.nombre_estado = 'En Analisis'
										and i.id = ".$institucion[0]->id."
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");

//dd($propuestasAnalisadas);
if($propuestasAnalisadas){
	$numPropuestasAnalisadas = $propuestasAnalisadas[0]->propuestasAnalisadas;
}else{
	$numPropuestasAnalisadas = 0;
}

//dd($numPropuestasAnalisadas);

$propuestasPolitica = DB::select("SELECT count(politica_id) as propuestasPolitica
									from solucions
									join politicas on solucions.politica_id = politicas.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id = ".$institucion[0]->id." ");

if($propuestasPolitica){
	$numPropuestasPolitica = $propuestasPolitica[0]->propuestasPolitica;
}else{
	$numPropuestasPolitica = 0;
}

//dd($numPropuestasPolitica);

$propuestasLeyes = DB::select("SELECT count(instrumento_id) as propuestasLeyes
									from solucions
									join instrumentos on solucions.instrumento_id = instrumentos.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id =".$institucion[0]->id." "); 

if($propuestasLeyes){
	$numPropuestasLeyes = $propuestasLeyes[0]->propuestasLeyes;
}else{
	$numPropuestasLeyes = 0;
}
//dd($numPropuestasLeyes);

$propuestasDesarrolladas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasDesarrolladas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'En Desarrollo'
										and i.id = ".$institucion[0]->id."
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");


if($propuestasDesarrolladas){
	$numPropuestasDesarrolladas = $propuestasDesarrolladas[0]->propuestasDesarrolladas;
}else{
	$numPropuestasDesarrolladas = 0;
}
//dd($numPropuestasDesarrolladas);


$propuestasFinalisadas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasFinalisadas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'Finalizado'
										and i.id = ".$institucion[0]->id."
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");


if($propuestasFinalisadas){
	$numPropuestasFinalisadas = $propuestasFinalisadas[0]->propuestasFinalisadas;
}else{
	$numPropuestasFinalisadas = 0;
}
//dd($numPropuestasAnalisadas);


$propuestasPlazoLargo = DB::select("SELECT   count(plazo_cumplimiento) as largo
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id = ".$institucion[0]->id."
									and s.plazo_cumplimiento = 'Largo'");



if($propuestasPlazoLargo){
	$numPropuestasPlazoLargo = $propuestasPlazoLargo[0]->largo;
}else{
	$numPropuestasPlazoLargo = 0;
}
//dd($numPropuestasPlazoLargo);


$propuestasPlazoMediano = DB::select("SELECT   count(plazo_cumplimiento) as mediano
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id = ".$institucion[0]->id." 
									and s.plazo_cumplimiento = 'Mediano'");

if($propuestasPlazoMediano){
	$numPropuestasPlazoMediano = $propuestasPlazoMediano[0]->mediano;
}else{
	$numPropuestasPlazoMediano = 0;
}
//dd($numPropuestasPlazoMediano);


$propuestasPlazoCorto = DB::select("SELECT   count(plazo_cumplimiento) as corto
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id = ".$institucion[0]->id." 
									and s.plazo_cumplimiento = 'Mediano'");

if($propuestasPlazoCorto){
	$numPropuestasPlazoCorto = $propuestasPlazoCorto[0]->corto;
}else{
	$numPropuestasPlazoCorto = 0;
}
//dd($numPropuestasPlazoMediano);


        //dd($solucion);
         /*   $excel->sheet('Propuestas Dialogo', function($sheet) use($solucion) {
         
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
 */
            $excel->sheet('Datos por institución', function($sheet) use($hoy,$nombreusuario,$nombreinstitucion,$nombreConsejo,$numPropuestasRecibidas,$numPropuestasDesestimadas,$numPropuestasValidadas,
$numPropuestasFinalisadas,$numPropuestasDesarrolladas,$numPropuestasAnalisadas,
$numPropuestasPolitica,$numPropuestasLeyes,
$numPropuestasPlazoCorto,$numPropuestasPlazoMediano,$numPropuestasPlazoLargo) {
         
            $sheet->row(1, [
                'REPORTE DE MINISTERIO DE LA PLATAFORMA DEL DIALOGO NACIONAL'
            ]);

            $sheet->row(2, [
                'DATOS INFORMATIVOS'
            ]);

           
            $sheet->row(3, [
                'Fecha',$hoy
            ]);

            $sheet->row(4, [
                'Responsable', strtoupper($nombreusuario)
            ]);

            $sheet->row(5, [
                'Nombre de la Institución', strtoupper($nombreinstitucion)
            ]);

 			$sheet->row(6, [
                'Consejo Sectorial', $nombreConsejo
            ]);
        

		    $sheet->row(7, ['']);

		    $sheet->row(8, [
		                'TIPO DE PROPUESTA'
		            ]);
		    $sheet->row(9, [
		                'N° de Propuestas Recibidas', strtoupper($numPropuestasRecibidas)
		            ]);
		    $sheet->row(10, [
		                'N° de Propuestas Desestimadas', strtoupper($numPropuestasDesestimadas)
		            ]);
		    $sheet->row(11, [
		                'N° de Propuestas Validadas', strtoupper($numPropuestasValidadas)
		            ]);



			$sheet->row(12, ['']);

		    $sheet->row(13, [
		                'ESTADO DE PROPUESTA'
		            ]);
		    $sheet->row(14, [
		                'N° de Propuestas Cumplidas o Finalizadas', strtoupper($numPropuestasFinalisadas)
		            ]);
		    $sheet->row(15, [
		                'N° de Propuestas en Desarrollo', strtoupper($numPropuestasDesarrolladas)
		            ]);
		    $sheet->row(16, [
		                'N° de Propuestas en Análisis', strtoupper($numPropuestasAnalisadas)
		            ]);





            $sheet->row(17, ['']);

		    $sheet->row(18, [
		                'FORMA DE CUMPLIMIENTO'
		            ]);
		    $sheet->row(19, [
		                'N° de Propuestas en PP', strtoupper($numPropuestasPolitica)
		            ]);
		    $sheet->row(20, [
		                'N° de Propuestas leyes', strtoupper($numPropuestasLeyes)
		            ]);
		  



 			$sheet->row(21, ['']);
		    $sheet->row(22, [
		                'PROPUESTAS POR PLAZO'
		            ]);
		    $sheet->row(23, [
		                '
N° de Propuestas a Corto', strtoupper($numPropuestasPlazoCorto)
		            ]);
		    $sheet->row(24, [
		                'N° de Propuestas Mediano', strtoupper($numPropuestasPlazoMediano)
		            ]);
		    $sheet->row(25, [
		                'N° de Propuestas Largo Plazo', strtoupper($numPropuestasPlazoLargo)
		            ]);


         
        });
         
        })->export('xlsx');
        
    }
 

 public function exportarPdfReporteMinisterio(Request $request,$tipo){
     
         $vistaurl="publico.reportes.reporteMinisterioPdf";

    $hoy = date("d/m/Y"); 

		$institucionUsuario = DB::select("SELECT * FROM institucion_usuarios 
			WHERE usuario_id=".Auth::user()->id." ;");
			// dd($institucionUsuario[0]->id);

			     
			$usuario = User::where('id','=',$institucionUsuario[0]->usuario_id)
			                            ->get();
			$nombreusuario = $usuario[0]->name;
			//dd($nombreusuario);


			$institucion = Institucion::where('id','=',$institucionUsuario[0]->institucion_id)
			                            ->get();
			$nombreinstitucion = $institucion[0]->nombre_institucion;
			//dd($institucionUsuario[0]->institucion_id);
			//dd($nombre_institucion);

			//dd($institucion[0]->id);
			$consejo = DB::select("SELECT consejo_sectorials.nombre_consejo,institucions.id FROM consejo_sectorials 
											JOIN consejo_institucions 
											ON consejo_sectorials.id = consejo_institucions.consejo_id
											JOIN institucions
											ON consejo_institucions.institucion_id = institucions.id
											WHERE institucions.id = ".$institucion[0]->id.";");

			//dd($consejo); 


			$nombreConsejo = $consejo[0]->nombre_consejo; 
			//dd($nombreConsejo); 

			    $resultadosreporte = ActorSolucion::select('solucions.*','institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politica')
			                      //Solucion::select('solucions.*','i.id', 'i.nombre_institucion', 'p.nombre_politica')
			                                 ->join('solucions', 'solucions.id', '=', 'actor_solucion.solucion_id')
			                                 ->join('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
			                                 ->join('politicas', 'politicas.id', '=', 'solucions.politica_id')
			                                // ->orderBy('solucions.estado_id','DESC')
			                                //  ->groupBy ( 'institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politicaS')
			        
			                                 //->get();
			                                 ; 


			 $propuestasRecibidas = DB::select(" SELECT i.id, i.nombre_institucion
												,count(e.nombre_estado) as propuestasRecibidas
												from actor_solucion acs
												join institucions i
												on acs.institucion_id = i.id
												join solucions s
												on acs.solucion_id = s.id
												join estado_solucion e
												on s.estado_id = e.id
												where i.id=".$institucion[0]->id."
												group by i.id,i.nombre_institucion
												order by i.id, e.id");

			//dd($propuestasRecibidas);
			//dd($propuestasRecibidas[0]->propuestasRecibidas);
			if($propuestasRecibidas){
				$numPropuestasRecibidas = $propuestasRecibidas[0]->propuestasRecibidas;
			}else{
				$numPropuestasRecibidas = 0;
			}
			//dd($numPropuestasRecibidas);


			$propuestasDesestimadas = DB::select(" SELECT i.id, i.nombre_institucion
												,count(e.nombre_estado) as propuestasDesestimadas
												from actor_solucion acs
												join institucions i
												on acs.institucion_id = i.id
												join solucions s
												on acs.solucion_id = s.id
												join estado_solucion e
												on s.estado_id = e.id
												where i.id=".$institucion[0]->id."
												and e.nombre_estado = 'Desestimadas'
												group by i.id,i.nombre_institucion
												order by i.id, e.id");

			if($propuestasDesestimadas){
				$numPropuestasDesestimadas = $propuestasDesestimadas[0]->propuestasDesestimadas;
			}else{
				$numPropuestasDesestimadas = 0;
			}

			//dd($numPropuestasDesestimadas); 

			$numPropuestasValidadas = $numPropuestasRecibidas - $numPropuestasDesestimadas;

			//dd($numPropuestasValidadas);


			$propuestasAnalisadas = DB::select("SELECT 
													i.nombre_institucion
													,e.nombre_estado
													,count(e.nombre_estado) as propuestasAnalisadas
													from actor_solucion acs
													join institucions i
													on acs.institucion_id = i.id
													join solucions s
													on acs.solucion_id = s.id
													join estado_solucion e
													on s.estado_id = e.id
													where  e.nombre_estado = 'En Analisis'
													and i.id = ".$institucion[0]->id."
													group by i.nombre_institucion, e.nombre_estado
													order by i.id, e.id");

			//dd($propuestasAnalisadas);
			if($propuestasAnalisadas){
				$numPropuestasAnalisadas = $propuestasAnalisadas[0]->propuestasAnalisadas;
			}else{
				$numPropuestasAnalisadas = 0;
			}

			//dd($numPropuestasAnalisadas);

			$propuestasPolitica = DB::select("SELECT count(politica_id) as propuestasPolitica
									from solucions
									join politicas on solucions.politica_id = politicas.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id =  ".$institucion[0]->id." ");
			if($propuestasPolitica){
				$numPropuestasPolitica = $propuestasPolitica[0]->propuestasPolitica;
			}else{
				$numPropuestasPolitica = 0;
			}

			//dd($numPropuestasPolitica);

			$propuestasLeyes = DB::select("SELECT count(instrumento_id) as propuestasLeyes
									from solucions
									join instrumentos on solucions.instrumento_id = instrumentos.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id =".$institucion[0]->id." "); 

			if($propuestasLeyes){
				$numPropuestasLeyes = $propuestasLeyes[0]->propuestasLeyes;
			}else{
				$numPropuestasLeyes = 0;
			}


			$propuestasDesarrolladas = DB::select("SELECT 
													i.nombre_institucion
													,e.nombre_estado
													,count(e.nombre_estado) as propuestasDesarrolladas
													from actor_solucion acs
													join institucions i
													on acs.institucion_id = i.id
													join solucions s
													on acs.solucion_id = s.id
													join estado_solucion e
													on s.estado_id = e.id
													where e.nombre_estado = 'En Desarrollo'
													and i.id = ".$institucion[0]->id."
													group by i.nombre_institucion, e.nombre_estado
													order by i.id, e.id");


			if($propuestasDesarrolladas){
				$numPropuestasDesarrolladas = $propuestasDesarrolladas[0]->propuestasDesarrolladas;
			}else{
				$numPropuestasDesarrolladas = 0;
			}
			//dd($numPropuestasDesarrolladas);


			$propuestasFinalisadas = DB::select("SELECT 
													i.nombre_institucion
													,e.nombre_estado
													,count(e.nombre_estado) as propuestasFinalisadas
													from actor_solucion acs
													join institucions i
													on acs.institucion_id = i.id
													join solucions s
													on acs.solucion_id = s.id
													join estado_solucion e
													on s.estado_id = e.id
													where e.nombre_estado = 'Finalizado'
													and i.id = ".$institucion[0]->id."
													group by i.nombre_institucion, e.nombre_estado
													order by i.id, e.id");


			if($propuestasFinalisadas){
				$numPropuestasFinalisadas = $propuestasFinalisadas[0]->propuestasFinalisadas;
			}else{
				$numPropuestasFinalisadas = 0;
			}
			//dd($numPropuestasAnalisadas);


			$propuestasPlazoLargo = DB::select("SELECT   count(plazo_cumplimiento) as largo
												from actor_solucion acs
												join institucions i
												on acs.institucion_id = i.id
												join solucions s
												on acs.solucion_id = s.id
												join politicas p
												on s.politica_id = p.id
												where i.id = ".$institucion[0]->id."
												and s.plazo_cumplimiento = 'Largo'");



			if($propuestasPlazoLargo){
				$numPropuestasPlazoLargo = $propuestasPlazoLargo[0]->largo;
			}else{
				$numPropuestasPlazoLargo = 0;
			}
			//dd($numPropuestasPlazoLargo);


			$propuestasPlazoMediano = DB::select("SELECT   count(plazo_cumplimiento) as mediano
												from actor_solucion acs
												join institucions i
												on acs.institucion_id = i.id
												join solucions s
												on acs.solucion_id = s.id
												join politicas p
												on s.politica_id = p.id
												where i.id = ".$institucion[0]->id." 
												and s.plazo_cumplimiento = 'Mediano'");

			if($propuestasPlazoMediano){
				$numPropuestasPlazoMediano = $propuestasPlazoMediano[0]->mediano;
			}else{
				$numPropuestasPlazoMediano = 0;
			}
			//dd($numPropuestasPlazoMediano);


			$propuestasPlazoCorto = DB::select("SELECT   count(plazo_cumplimiento) as corto
												from actor_solucion acs
												join institucions i
												on acs.institucion_id = i.id
												join solucions s
												on acs.solucion_id = s.id
												join politicas p
												on s.politica_id = p.id
												where i.id = ".$institucion[0]->id." 
												and s.plazo_cumplimiento = 'Mediano'");

			if($propuestasPlazoCorto){
				$numPropuestasPlazoCorto = $propuestasPlazoCorto[0]->corto;
			}else{
				$numPropuestasPlazoCorto = 0;
			}
			//dd($numPropuestasPlazoMediano);


        //$elementos= sizeof($data1);
        //dd($data1);
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with( [ "hoy" => $hoy,"nombreusuario" => $nombreusuario,
        	                                                      "nombreinstitucion"=> $nombreinstitucion,
        	                                                      "nombreConsejo" => $nombreConsejo,
        	                                                      "numPropuestasRecibidas" => $numPropuestasRecibidas,
        	                                                      "numPropuestasDesestimadas" => $numPropuestasDesestimadas,
        	                                                      "numPropuestasValidadas" => $numPropuestasValidadas,
        	                                                      "numPropuestasAnalisadas" => $numPropuestasAnalisadas,
        	                                                      "numPropuestasDesarrolladas" => $numPropuestasDesarrolladas,
        	                                                      "numPropuestasFinalisadas" => $numPropuestasFinalisadas,
        	                                                      "numPropuestasPolitica" => $numPropuestasPolitica,
        	                                                      "numPropuestasLeyes" => $numPropuestasLeyes,
        	                                                      "numPropuestasPlazoLargo" => $numPropuestasPlazoLargo,
        	                                                      "numPropuestasPlazoMediano" => $numPropuestasPlazoMediano,
        	                                                      "numPropuestasPlazoCorto" => $numPropuestasPlazoCorto,
        	                                                      "resultadosreporte" => $resultadosreporte
        	                                                      ] );
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
       if($tipo==1){return $pdf->stream('DialogoNacional.pdf');}
        if($tipo==2){return $pdf->download('DialogoNacional.pdf'); }
    }

/**********************************************************************/
/*******************REPORTES CONSEJO SECTORIAL************************/
/********************************************************************/
public function obtenerInstitucionUsuario(){
  $institucionUsuario = DB::select("SELECT * FROM institucion_usuarios 
			WHERE usuario_id=".Auth::user()->id." ;");
return $institucionUsuario;
}

public function obtenerInstitucionId($idInstitucion){ 
  $institucionUsuario = DB::select("SELECT * FROM institucions 
			WHERE id=".$idInstitucion." ;"); 
  return $institucionUsuario;
}

public  function obtenerInstitucion($idInstitucion){		// dd($institucionUsuario[0]->id);
	if($idInstitucion == 'Todos'){
       $institucionUsuario = $this->obtenerInstitucionUsuario();
       $institucion1 = Institucion::where('id','=',$institucionUsuario[0]->institucion_id)
			                             ->get();
	}else{ 
       $institucion = $this -> obtenerInstitucionId($idInstitucion); 
       $institucion1 = Institucion::where('id','=',$institucion[0]->id)
			                             ->get();
	}
	       
			
 return $institucion1 ;
}

public function obtenerConsejo($idInstitucion){
$institucion =$this->obtenerInstitucion($idInstitucion);
$consejo = DB::select("SELECT consejo_sectorials.nombre_consejo,institucions.id, consejo_sectorials.id as idConsejo FROM consejo_sectorials 
								JOIN consejo_institucions 
								ON consejo_sectorials.id = consejo_institucions.consejo_id
								JOIN institucions
								ON consejo_institucions.institucion_id = institucions.id
								WHERE institucions.id = ".$institucion[0]->id.";");
return $consejo;
}


public function obtenerMinisteriosPorConsejo($idInstitucion){
$consejo = $this->obtenerConsejo($idInstitucion);
$listaMinisterioPorConsejo = DB::select("SELECT consejo_sectorials.id as idConsejo,consejo_sectorials.nombre_consejo,institucions.id as idInstitucion, institucions.nombre_institucion
FROM institucions  
JOIN  consejo_institucions  
ON institucions.id =consejo_institucions.institucion_id 
join consejo_sectorials
ON  consejo_institucions.consejo_id = consejo_sectorials.id
WHERE consejo_sectorials.id = ".$consejo[0]->idConsejo."
order by consejo_sectorials.nombre_consejo,institucions.nombre_institucion;");
return $listaMinisterioPorConsejo ;
}

public  function obtenerInstitucionesConsejo($idInstitucion){
 $consejo = $this->obtenerConsejo($idInstitucion);
//dd($consejo[0]->idConsejo);

//dd($institucion[0]->id);

$listaMinisterioPorConsejo = $this->obtenerMinisteriosPorConsejo($idInstitucion);
//dd($listaMinisterioPorConsejo);
$idInstituciones =  0;
foreach($listaMinisterioPorConsejo as $lista){
	$idInstituciones1 =  $lista->idInstitucion;
    $idInstituciones =  $idInstituciones1.",".$idInstituciones;
}
//dd( $idInstituciones);
return $idInstituciones;
}



public function obtenerPropuestasRecibidas($idInstitucion,$fechaInicial,$fechaFinal){
if($idInstitucion=="Todos"){
$idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);

}else{
	$idInstituciones = $idInstitucion;

}
//dd($idInstituciones);
$propuestasRecibidas = DB::select(" SELECT i.id, i.nombre_institucion
									,count(e.nombre_estado) as propuestasRecibidas
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join estado_solucion e
									on s.estado_id = e.id
									where i.id in ( ".$idInstituciones." )
									and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
									group by i.id,i.nombre_institucion
									order by i.id, e.id");
return $propuestasRecibidas;
}


public function obtenerPropuestasDesestimadas($idInstitucion,$fechaInicial,$fechaFinal){
if($idInstitucion=="Todos"){
$idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);

}else{
	$idInstituciones = $idInstitucion;

}
$propuestasDesestimadas = DB::select(" SELECT i.id, i.nombre_institucion
									,count(e.nombre_estado) as propuestasDesestimadas
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join estado_solucion e
									on s.estado_id = e.id
									where i.id in ( ".$idInstituciones." )
									and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
									and e.nombre_estado = 'Desestimadas'
									group by i.id,i.nombre_institucion
									order by i.id, e.id");
return $propuestasDesestimadas;
}

public function obtenerPropuestasAnalisadas($idInstitucion,$fechaInicial,$fechaFinal){
		if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasAnalisadas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasAnalisadas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where  e.nombre_estado = 'En Analisis'
										and i.id  in ( ".$idInstituciones." )
										and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");
	return $propuestasAnalisadas;
}

public function obtenerPropuestasPolitica($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasPolitica = DB::select("SELECT count(politica_id) as propuestasPolitica
									from solucions
									join politicas on solucions.politica_id = politicas.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id  in ( ".$idInstituciones." ) 
									and (solucions.created_at > '".$fechaInicial."' or solucions.created_at <'".$fechaFinal."')");
return $propuestasPolitica;
}

public function obtenerPropuestasLeyes($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasLeyes = DB::select("SELECT count(instrumento_id) as propuestasLeyes
									from solucions
									join instrumentos on solucions.instrumento_id = instrumentos.id
									join actor_solucion on  solucions.id = actor_solucion.solucion_id
									join institucions on actor_solucion.institucion_id  = institucions.id
									where institucions.id  in ( ".$idInstituciones." ) 
									and (solucions.created_at > '".$fechaInicial."' or solucions.created_at <'".$fechaFinal."')"); 
 return $propuestasLeyes;
}

public function obtenerPropuestasDesarrolladas($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasDesarrolladas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasDesarrolladas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'En Desarrollo'
										and i.id  in ( ".$idInstituciones." )
										and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");
	return $propuestasDesarrolladas;
}

public function obtenerPropuestasFinalisadas($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasFinalisadas = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasFinalisadas
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'Finalizado'
										and i.id  in ( ".$idInstituciones." )
										and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");
	return $propuestasFinalisadas;
}


public function obtenerPropuestasEnConflicto($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasEnConflicto = DB::select("SELECT 
										i.nombre_institucion
										,e.nombre_estado
										,count(e.nombre_estado) as propuestasEnConflicto
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where e.nombre_estado = 'En Conflicto'
										and i.id  in ( ".$idInstituciones." )
										and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");
	return $propuestasEnConflicto;
}


public function obtenerPropuestasPorEstado($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	 $propuestasPorEstado = DB::select("SELECT 
										e.nombre_estado as nombreEstado
										,count(e.nombre_estado) as propuestasPorEstado
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where  i.id  in ( ".$idInstituciones." )
										and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
										group by  e.nombre_estado
										order by i.id, e.id");
	}else{
		$idInstituciones = $idInstitucion;
		$propuestasPorEstado = DB::select("SELECT 
										i.nombre_institucion as institucion
										,e.nombre_estado as nombreEstado
										,count(e.nombre_estado) as propuestasPorEstado
										from actor_solucion acs
										join institucions i
										on acs.institucion_id = i.id
										join solucions s
										on acs.solucion_id = s.id
										join estado_solucion e
										on s.estado_id = e.id
										where  i.id  in ( ".$idInstituciones." )
										and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
										group by i.nombre_institucion, e.nombre_estado
										order by i.id, e.id");
	}
	
	//dd($propuestasPorEstado);
	return $propuestasPorEstado;
}


public function obtenerPropuestasPlazoLargo($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasPlazoLargo = DB::select("SELECT   count(plazo_cumplimiento) as largo
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id  in ( ".$idInstituciones." )
									and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
									and s.plazo_cumplimiento = 'Largo'");

return $propuestasPlazoLargo;
}


public function obtenerPropuestasPlazoMediano($idInstitucion,$fechaInicial,$fechaFinal){
if($idInstitucion=="Todos"){
	 $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
$propuestasPlazoMediano = DB::select("SELECT   count(plazo_cumplimiento) as mediano
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id  in ( ".$idInstituciones." )
									and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
									and s.plazo_cumplimiento = 'Mediano'");
return $propuestasPlazoMediano;
}

public function obtenerPropuestasPlazoCorto($idInstitucion,$fechaInicial,$fechaFinal){
	if($idInstitucion=="Todos"){
	   $idInstituciones = $this->obtenerInstitucionesConsejo($idInstitucion);
	}else{
		$idInstituciones = $idInstitucion;
	}
	$propuestasPlazoCorto = DB::select("SELECT   count(plazo_cumplimiento) as corto
									from actor_solucion acs
									join institucions i
									on acs.institucion_id = i.id
									join solucions s
									on acs.solucion_id = s.id
									join politicas p
									on s.politica_id = p.id
									where i.id  in ( ".$idInstituciones." )
									and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
									and s.plazo_cumplimiento = 'Corto'");
	return $propuestasPlazoCorto;
}

public function obtenerPropuestasPorMesa($idConsejo,$fechaInicial,$fechaFinal){
	$propuestasPorMesa = DB::select("SELECT  count(s.mesa_id) as porTerminar, md.nombre as nombreMesa, md.id as idMesa
	from plataforma_dialogo.mesa_dialogo md  
	inner join solucions s
	on md.id = s.mesa_id
	where  md.consejo_sectorial_id = ".$idConsejo."
	and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
	and s.estado_id in ( 1,2,3 )
	group by s.mesa_id");
return $propuestasPorMesa;
}

public function obtenerPropuestasPorMesaFinalizadas($idConsejo,$fechaInicial,$fechaFinal){
	$propuestasPorMesa = DB::select("SELECT  count(s.mesa_id) as finalizadas, md.nombre as nombreMesa, md.id as idMesa
	from plataforma_dialogo.mesa_dialogo md  
	inner join solucions s
	on md.id = s.mesa_id
	where  md.consejo_sectorial_id = ".$idConsejo."
	and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
	and s.estado_id in ( 4 )
	group by s.mesa_id");
return $propuestasPorMesa;
}

public function obtenerPropuestasPlanificadas($idConsejo,$fechaInicial,$fechaFinal){
		$propuestasPlanificadas = DB::select("SELECT count(s.planificado) as numPlanificadas
		from plataforma_dialogo.mesa_dialogo md  
		inner join solucions s
		on md.id = s.mesa_id
		where  md.consejo_sectorial_id = ".$idConsejo."
		and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
		and ( s.planificado = 'SI' or s.planificado = 'si' or s.planificado = 'Si' or s.planificado = 'sI')
		group by s.planificado");
return $propuestasPlanificadas;
}

public function obtenerPropuestasNoPlanificadas($idConsejo,$fechaInicial,$fechaFinal){
		$propuestasNoPlanificadas = DB::select("SELECT count(s.planificado) as numNoPlanificadas
		from plataforma_dialogo.mesa_dialogo md  
		inner join solucions s
		on md.id = s.mesa_id
		where  md.consejo_sectorial_id = ".$idConsejo."
		and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
		and ( s.planificado = 'NO' or s.planificado = 'no' or s.planificado = 'No' or s.planificado = 'nO')
		group by s.planificado");
return $propuestasNoPlanificadas;
}

public function obtenerPropuestasPorAmbito($idConsejo,$fechaInicial,$fechaFinal){
	$propuestasPorAmbito = DB::select("SELECT a.nombre_ambit as ambito, count(a.nombre_ambit) AS numPorAmbito
	FROM solucions s
	INNER JOIN ambits a
	ON s.ambit_id = a.id
	inner join mesa_dialogo md
	on s.mesa_id = md.id
	where md.consejo_sectorial_id = ".$idConsejo."
	and (s.created_at > '".$fechaInicial."' or s.created_at <'".$fechaFinal."')
	GROUP BY a.nombre_ambit 
	ORDER BY count(a.nombre_ambit) desc");
return $propuestasPorAmbito;
}

public function listaConsejoPorCodigo(Request $request){
   if($request->consulto == 'no'){
      $this -> exportarExcelReporteConsejo($request);
}

 // dd($request->selInstituciones);
	//dd($request->consulto);

$idBusqueda = $request->selInstituciones;

$periodo = $request->selPeriodo;


$hoy = date("d-m-Y"); 
$year = date('Y'); 
$primerDiaAnio = "01-01-".$year;

if($request->selInstituciones == "Todos"){
  $fechaInicial = $primerDiaAnio; 
  $fechaFinal = $hoy;
  $selPeriodo ="Requerido";
}else{
  $fechaInicial = $request->fechaInicial;
  $fechaFinal = $request->fechaFinal;
}
//dd($primerDiaAnio);

$institucionUsuario = $this->obtenerInstitucionUsuario($request->selInstituciones);

$institucion = new Institucion();

$institucion = $this-> obtenerInstitucion($request->selInstituciones);

//dd($institucion[0]->id);

$nombreinstitucion = $institucion[0]->nombre_institucion;

$usuario = User::where('id','=',$institucionUsuario[0]->usuario_id)
			                            ->get();
$nombreusuario = $usuario[0]->name;
			//dd($nombreusuario);
$idInstituciones = $this->obtenerInstitucionesConsejo($request->selInstituciones);

 $consejo = $this->obtenerConsejo($request->selInstituciones);
//dd($consejo[0]->idConsejo);
$nombreConsejo = $consejo[0]->nombre_consejo; 

$listaMinisterioPorConsejo = $this->obtenerMinisteriosPorConsejo($request->selInstituciones);



$propuestasRecibidas =  $this->obtenerPropuestasRecibidas($request->selInstituciones,$fechaInicial,$fechaFinal);
//dd($propuestasRecibidas);
//dd($propuestasRecibidas[0]->propuestasRecibidas);
if($propuestasRecibidas){
	$numPropuestasRecibidas = $propuestasRecibidas[0]->propuestasRecibidas;
}else{
	$numPropuestasRecibidas = 0;
}


$propuestasDesestimadas = $this->obtenerPropuestasDesestimadas($request->selInstituciones,$fechaInicial,$fechaFinal);

if($propuestasDesestimadas){
	$numPropuestasDesestimadas = $propuestasDesestimadas[0]->propuestasDesestimadas;
}else{
	$numPropuestasDesestimadas = 0;
}

//dd($numPropuestasDesestimadas); 

$numPropuestasValidadas = $numPropuestasRecibidas - $numPropuestasDesestimadas;

//dd($numPropuestasValidadas);


$propuestasAnalisadas = $this -> obtenerPropuestasAnalisadas($request->selInstituciones,$fechaInicial,$fechaFinal);

//dd($propuestasAnalisadas);
if($propuestasAnalisadas){
	$numPropuestasAnalisadas = $propuestasAnalisadas[0]->propuestasAnalisadas;
}else{
	$numPropuestasAnalisadas = 0;
}

//dd($numPropuestasAnalisadas);

$propuestasPolitica = $this -> obtenerPropuestasPolitica($request->selInstituciones,$fechaInicial,$fechaFinal);

if($propuestasPolitica){
	$numPropuestasPolitica = $propuestasPolitica[0]->propuestasPolitica;
}else{
	$numPropuestasPolitica = 0;
}

//dd($numPropuestasPolitica);

$propuestasLeyes = $this -> obtenerPropuestasLeyes($request->selInstituciones,$fechaInicial,$fechaFinal);

if($propuestasLeyes){
	$numPropuestasLeyes = $propuestasLeyes[0]->propuestasLeyes;
}else{
	$numPropuestasLeyes = 0;
}
//dd($numPropuestasLeyes);

$propuestasDesarrolladas = $this -> obtenerPropuestasDesarrolladas($request->selInstituciones,$fechaInicial,$fechaFinal);

if($propuestasDesarrolladas){
	$numPropuestasDesarrolladas = $propuestasDesarrolladas[0]->propuestasDesarrolladas;
}else{
	$numPropuestasDesarrolladas = 0;
}
//dd($numPropuestasDesarrolladas);


$propuestasFinalisadas = $this -> obtenerPropuestasFinalisadas($request->selInstituciones,$fechaInicial,$fechaFinal);


if($propuestasFinalisadas){
	$numPropuestasFinalisadas = $propuestasFinalisadas[0]->propuestasFinalisadas;
}else{
	$numPropuestasFinalisadas = 0;
}
//dd($numPropuestasAnalisadas);


$propuestasEnConflicto = $this -> obtenerPropuestasEnConflicto($request->selInstituciones,$fechaInicial,$fechaFinal);


if($propuestasEnConflicto){
	$numPropuestasConflicto = $propuestasEnConflicto[0]->propuestasEnConflicto;
}else{
	$numPropuestasConflicto = 0;
}

$propuestasPlazoLargo = $this -> obtenerPropuestasPlazoLargo($request->selInstituciones,$fechaInicial,$fechaFinal);



if($propuestasPlazoLargo){
	$numPropuestasPlazoLargo = $propuestasPlazoLargo[0]->largo;
}else{
	$numPropuestasPlazoLargo = 0;
}
//dd($numPropuestasPlazoLargo);


$propuestasPlazoMediano = $this -> obtenerPropuestasPlazoMediano($request->selInstituciones,$fechaInicial,$fechaFinal);

if($propuestasPlazoMediano){
	$numPropuestasPlazoMediano = $propuestasPlazoMediano[0]->mediano;
}else{
	$numPropuestasPlazoMediano = 0;
}
//dd($numPropuestasPlazoMediano);


$propuestasPlazoCorto = $this -> obtenerPropuestasPlazoCorto($request->selInstituciones,$fechaInicial,$fechaFinal);

if($propuestasPlazoCorto){
	$numPropuestasPlazoCorto = $propuestasPlazoCorto[0]->corto;
}else{
	$numPropuestasPlazoCorto = 0;
}
//dd($numPropuestasPlazoMediano);


 $resultadosreporte = ActorSolucion::select('solucions.*','institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politica')
                      //Solucion::select('solucions.*','i.id', 'i.nombre_institucion', 'p.nombre_politica')
                                 ->join('solucions', 'solucions.id', '=', 'actor_solucion.solucion_id')
                                 ->join('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
                                 ->join('politicas', 'politicas.id', '=', 'solucions.politica_id'); 
//dd($resultadosreporte);

//dd($consejo);

//dd($consejo[0]->idConsejo);


$propuestasPorMesa = $this -> obtenerPropuestasPorMesa($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
//dd($propuestasPorMesa);

$propuestasPorMesaFinalizadas = $this -> obtenerPropuestasPorMesaFinalizadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);

$propuestasPlanificadas = $this -> obtenerPropuestasPlanificadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
if($propuestasPlanificadas){
	$numPropuestasPlanificadas = $propuestasPlanificadas[0]->numPlanificadas;
}else{
	$numPropuestasPlanificadas = 0;
}

$propuestasNoPlanificadas = $this -> obtenerPropuestasNoPlanificadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
if($propuestasNoPlanificadas){
	$numPropuestasNoPlanificadas = $propuestasNoPlanificadas[0]->numNoPlanificadas;
}else{
	$numPropuestasNoPlanificadas = 0;
}

$propuestasPorAmbito = $this -> obtenerPropuestasPorAmbito($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);

$propuestasPorEstado = $this -> obtenerPropuestasPorEstado($request->selInstituciones,$fechaInicial,$fechaFinal);

if($idBusqueda=="Todos"){
 $periodo="Requerido";
}
$consulto=$request->consulto; 
return view('consejoSectorial.reporteConsejo')->with( ["hoy" => $hoy,
                          	                           "idBusqueda" => $idBusqueda,
                          	                           "periodo"=>$periodo,
                          	                           "fechaInicial"=>$fechaInicial,
                          	                           "fechaFinal"=>$fechaFinal,
                          	                           "consulto"=>$consulto,
	                                                       "nombreusuario" => $nombreusuario,
	                                                       "nombreinstitucion" => $nombreinstitucion,
	                                                       "nombreConsejo" => $nombreConsejo,
															       "listaMinisterioPorConsejo" => $listaMinisterioPorConsejo ,
        	                                                      "numPropuestasRecibidas" => $numPropuestasRecibidas,
        	                                                      "numPropuestasDesestimadas" => $numPropuestasDesestimadas,
        	                                                      "numPropuestasValidadas" => $numPropuestasValidadas,
        	                                                      "numPropuestasAnalisadas" => $numPropuestasAnalisadas,
        	                                                      "numPropuestasDesarrolladas" => $numPropuestasDesarrolladas,
        	                                                      "numPropuestasFinalisadas" => $numPropuestasFinalisadas,
        	                                                      "numPropuestasConflicto" => $numPropuestasConflicto,
        	                                                      "numPropuestasPolitica" => $numPropuestasPolitica,
        	                                                      "numPropuestasLeyes" => $numPropuestasLeyes,
        	                                                      "numPropuestasPlazoLargo" => $numPropuestasPlazoLargo,
        	                                                      "numPropuestasPlazoMediano" => $numPropuestasPlazoMediano,
        	                                                      "numPropuestasPlazoCorto" => $numPropuestasPlazoCorto,
        	                                                      "resultadosreporte" =>  $resultadosreporte,
        	                                                      "propuestasPorMesa" => $propuestasPorMesa,
        	                                                      "propuestasPorMesaFinalizadas" => $propuestasPorMesaFinalizadas,
        	                                                      "numPropuestasPlanificadas" => $numPropuestasPlanificadas,
        	                                                       "numPropuestasNoPlanificadas" => $numPropuestasNoPlanificadas,
        	                                                       "propuestasPorAmbito" => $propuestasPorAmbito,
        	                                                       "propuestasPorEstado" => $propuestasPorEstado
        	                                                      ] );




}

public function exportarExcelReporteConsejo(Request $request){
          //dd("DESCARGAR EXCEL"); 
        // \Excel::create('Reporte Consejo', function($excel) use($request) {


\Excel::create('Reporte Consejo', function($excel) use($request){


$idBusqueda = $request->selInstituciones;

$periodo = $request->selPeriodo;

$idInstitucion=$request->codInstitucion;

$hoy = date("d-m-Y"); 
$year = date('Y'); 
$primerDiaAnio = "01-01-".$year;

if($request->selInstituciones == "Todos"){
  $fechaInicial = $primerDiaAnio; 
  $fechaFinal = $hoy;
  $selPeriodo ="Requerido";
}else{
  $fechaInicial = $request->fechaInicial;
  $fechaFinal = $request->fechaFinal;
}



if(empty($request->codInstitucion)){
	//dd("No hay cod institucion");
	 Flash::success("No seleccionó una institución");
}
//dd($request->consulto);
if($request->consulto == 'no'){
Flash::success("Debe dar click en consultar para poder exportar la información");
}

$institucion = new Institucion();

$institucion = $this-> obtenerInstitucion($idInstitucion);

//dd($institucion[0]->id);

$nombreinstitucion = $institucion[0]->nombre_institucion;

$institucionUsuario = $this->obtenerInstitucionUsuario($idInstitucion);

$usuario = User::where('id','=',$institucionUsuario[0]->usuario_id)
			                            ->get();
$nombreusuario = $usuario[0]->name;

/*$institucion = Institucion::where('id','=',$institucionUsuario[0]->institucion_id)
                            ->get();
                            */
//dd($idInstitucion);
/* $institucion = Institucion::where('id','=',$idInstitucion)
                            ->get(); */
$institucion = $this -> obtenerInstitucion($idInstitucion);

$nombreinstitucion = $institucion[0]->nombre_institucion;
//dd($institucionUsuario[0]->institucion_id);
//dd($nombreinstitucion);

//dd($institucion[0]->id);
//$consejo = obtenerConsejo($institucion[0]->id);
$consejo =  $this->obtenerConsejo($idInstitucion);
//dd($consejo); 


$nombreConsejo = $consejo[0]->nombre_consejo; 
//dd($nombreConsejo); 

$periodo = $request->selPeriodo;

dd($periodo);
$listaMinisterioPorConsejo = $this -> obtenerConsejo($idInstitucion);

//dd($listaMinisterioPorConsejo);
$resultadosreporte = ActorSolucion::select('solucions.*','institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politica')
                      //Solucion::select('solucions.*','i.id', 'i.nombre_institucion', 'p.nombre_politica')
                                 ->join('solucions', 'solucions.id', '=', 'actor_solucion.solucion_id')
                                 ->join('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
                                 ->join('politicas', 'politicas.id', '=', 'solucions.politica_id')
                                // ->orderBy('solucions.estado_id','DESC')
                                //  ->groupBy ( 'institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politicaS')
        
                                 //->get();
                                 ; 


 $propuestasRecibidas = $this -> obtenerPropuestasRecibidas($idInstitucion,$fechaInicial,$fechaFinal);
 

//dd($propuestasRecibidas);
//dd($propuestasRecibidas[0]->propuestasRecibidas);
if($propuestasRecibidas){
	$numPropuestasRecibidas = $propuestasRecibidas[0]->propuestasRecibidas;
}else{
	$numPropuestasRecibidas = 0;
}
//dd($numPropuestasRecibidas);


$propuestasDesestimadas = $this -> obtenerPropuestasDesestimadas($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasDesestimadas){
	$numPropuestasDesestimadas = $propuestasDesestimadas[0]->propuestasDesestimadas;
}else{
	$numPropuestasDesestimadas = 0;
}

//dd($numPropuestasDesestimadas); 

$numPropuestasValidadas = $numPropuestasRecibidas - $numPropuestasDesestimadas;

//dd($numPropuestasValidadas);


$propuestasAnalisadas = $this -> obtenerPropuestasAnalisadas($idInstitucion,$fechaInicial,$fechaFinal);

//dd($propuestasAnalisadas);
if($propuestasAnalisadas){
	$numPropuestasAnalisadas = $propuestasAnalisadas[0]->propuestasAnalisadas;
}else{
	$numPropuestasAnalisadas = 0;
}

//dd($numPropuestasAnalisadas);

$propuestasPolitica = $this -> obtenerPropuestasPolitica($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasPolitica){
	$numPropuestasPolitica = $propuestasPolitica[0]->propuestasPolitica;
}else{
	$numPropuestasPolitica = 0;
}

//dd($numPropuestasPolitica);

$propuestasLeyes = $this -> obtenerPropuestasLeyes($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasLeyes){
	$numPropuestasLeyes = $propuestasLeyes[0]->propuestasLeyes;
}else{
	$numPropuestasLeyes = 0;
}
//dd($numPropuestasLeyes);

$propuestasDesarrolladas = $this -> obtenerPropuestasDesarrolladas($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasDesarrolladas){
	$numPropuestasDesarrolladas = $propuestasDesarrolladas[0]->propuestasDesarrolladas;
}else{
	$numPropuestasDesarrolladas = 0;
}
//dd($numPropuestasDesarrolladas);


$propuestasFinalisadas = $this -> obtenerPropuestasFinalisadas($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasFinalisadas){
	$numPropuestasFinalisadas = $propuestasFinalisadas[0]->propuestasFinalisadas;
}else{
	$numPropuestasFinalisadas = 0;
}
//dd($numPropuestasAnalisadas);

$propuestasEnConflicto = $this -> obtenerPropuestasEnConflicto($request->selInstituciones,$fechaInicial,$fechaFinal);


if($propuestasEnConflicto){
	$numPropuestasConflicto = $propuestasEnConflicto[0]->propuestasEnConflicto;
}else{
	$numPropuestasConflicto = 0;
}

$propuestasPlazoLargo = $this -> obtenerPropuestasPlazoLargo($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasPlazoLargo){
	$numPropuestasPlazoLargo = $propuestasPlazoLargo[0]->largo;
}else{
	$numPropuestasPlazoLargo = 0;
}
//dd($numPropuestasPlazoLargo);


$propuestasPlazoMediano = $this -> obtenerPropuestasPlazoMediano($idInstitucion,$fechaInicial,$fechaFinal);

if($propuestasPlazoMediano){
	$numPropuestasPlazoMediano = $propuestasPlazoMediano[0]->mediano;
}else{
	$numPropuestasPlazoMediano = 0;
}
//dd($numPropuestasPlazoMediano);


$propuestasPlazoCorto = $this -> obtenerPropuestasPlazoCorto($idInstitucion,$fechaInicial,$fechaFinal);


if($propuestasPlazoCorto){
	$numPropuestasPlazoCorto = $propuestasPlazoCorto[0]->corto;
}else{
	$numPropuestasPlazoCorto = 0;
}
//dd($numPropuestasPlazoMediano);

$propuestasPorMesa = $this -> obtenerPropuestasPorMesa($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
//dd($propuestasPorMesa);

$propuestasPorMesaFinalizadas = $this -> obtenerPropuestasPorMesaFinalizadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);

$propuestasPlanificadas = $this -> obtenerPropuestasPlanificadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
if($propuestasPlanificadas){
	$numPropuestasPlanificadas = $propuestasPlanificadas[0]->numPlanificadas;
}else{
	$numPropuestasPlanificadas = 0;
}

$propuestasNoPlanificadas = $this -> obtenerPropuestasNoPlanificadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
if($propuestasNoPlanificadas){
	$numPropuestasNoPlanificadas = $propuestasNoPlanificadas[0]->numNoPlanificadas;
}else{
	$numPropuestasNoPlanificadas = 0;
}

$propuestasPorAmbito = $this -> obtenerPropuestasPorAmbito($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);

$propuestasPorEstado = $this -> obtenerPropuestasPorEstado($request->selInstituciones,$fechaInicial,$fechaFinal);

if($idBusqueda=="Todos"){
 $periodo="Requerido";
}

$excel->sheet('Datos por Consejo', function($sheet) use($hoy,$nombreusuario,$nombreinstitucion,$nombreConsejo,$numPropuestasRecibidas,$numPropuestasDesestimadas,$numPropuestasValidadas,
$numPropuestasFinalisadas,$propuestasEnConflict,$numPropuestasDesarrolladas,$numPropuestasAnalisadas,
$numPropuestasPolitica,$numPropuestasLeyes,
$numPropuestasPlazoCorto,$numPropuestasPlazoMediano,$numPropuestasPlazoLargo,
$propuestasPorMesa,$propuestasPorMesaFinalizadas,$numPropuestasPlanificadas,$numPropuestasNoPlanificadas,$propuestasPorAmbito, $propuestasPorEstado) {
         
            $sheet->row(1, [
                'REPORTE DE MINISTERIO DE LA PLATAFORMA DEL DIALOGO NACIONAL'
            ]);

            $sheet->row(2, [
                'DATOS INFORMATIVOS'
            ]);

           
            $sheet->row(3, [
                'Fecha',$hoy
            ]);

           
            $sheet->row(4, [
                'Responsable', strtoupper($nombreinstitucion)
            ]);

 			$sheet->row(5, [
                'Consejo Sectorial', $nombreConsejo
            ]);
        




		    $sheet->row(6, ['']);

		    $sheet->row(7, [
		                'TIPO DE PROPUESTA'
		            ]);
		    $sheet->row(8, [
		                'N° de Propuestas Recibidas', strtoupper($numPropuestasRecibidas)
		            ]);
		    $sheet->row(9, [
		                'N° de Propuestas Desestimadas', strtoupper($numPropuestasDesestimadas)
		            ]);
		    $sheet->row(10, [
		                'N° de Propuestas Validadas', strtoupper($numPropuestasValidadas)
		            ]);



			$sheet->row(11, ['']);

		    $sheet->row(12, [
		                'ESTADO DE PROPUESTA'
		            ]);
		    $sheet->row(13, [
		                'N° de Propuestas Cumplidas o Finalizadas', strtoupper($numPropuestasFinalisadas)
		            ]);
		    $sheet->row(14, [
		                'N° de Propuestas en Desarrollo', strtoupper($numPropuestasDesarrolladas)
		            ]);
		    $sheet->row(15, [
		                'N° de Propuestas en Análisis', strtoupper($numPropuestasAnalisadas)
		            ]);





            $sheet->row(16, ['']);

		    $sheet->row(17, [
		                'FORMA DE CUMPLIMIENTO'
		            ]);
		    $sheet->row(18, [
		                'N° de Propuestas en PP', strtoupper($numPropuestasPolitica)
		            ]);
		    $sheet->row(19, [
		                'N° de Propuestas leyes', strtoupper($numPropuestasLeyes)
		            ]);
		  
               

 			$sheet->row(20, ['']);
		    $sheet->row(21, [
		                'PROPUESTAS TIEMPO POR CONSEJO SECTORIAL'
		            ]);
		    $sheet->row(22, [
		                '
N° de Propuestas a Corto', strtoupper($numPropuestasPlazoCorto)
		            ]);
		    $sheet->row(23, [
		                'N° de Propuestas Mediano', strtoupper($numPropuestasPlazoMediano)
		            ]);
		    $sheet->row(24, [
		                'N° de Propuestas Largo Plazo', strtoupper($numPropuestasPlazoLargo)
		            ]);

           
           

		    $sheet->row(25, ['']);

		    $sheet->row(26, [
		                'PROPUESTAS PLANIFICADAS POR CONSEJO SECTORIAL'
		            ]);
		    $sheet->row(27, [
		                'N° de Propuestas Planificadas', strtoupper($numPropuestasPlanificadas)
		            ]);
		    $sheet->row(28, [
		                'N° de Propuestas No planificadas', strtoupper($numPropuestasNoPlanificadas)
		            ]);


            
            
            $sheet->row(29, ['']);

		    $sheet->row(30, [
		                'ESTADISTICA DE PROPUESTAS POR MESA'
		            ]);
		    $cont = 30;
		   /* foreach ($propuestasPorMesa as $propuestasPorMesa) {
		    	 $sheet->row($cont+1, [ strtoupper($propuestasPorMesa),if($propuestasPorMesa->idMesa == $propuestasPorMesaFinalizadas->idMesa){strtoupper($propuestasPorMesaFinalizadas)}
		            ]);
		          $cont++;
		    }
		   
        
        });*/

        
           foreach ($propuestasPorMesa as $propuestasPorMesa) {
		    	 $sheet->row($cont+1,  [strtoupper($propuestasPorMesa->nombreMesa) ,$propuestasPorMesa->porTerminar
		    	 	]);
		          $cont++;
		    }
		   
        
        });
         
        })->export('xlsx');
        

    }
 

 //public function exportarPdfReporteConsejo(Request $request,$tipo){

public function exportarPdfReporteConsejo(Request $request){
 		
//dd($idBusqueda);
		//dd($request->selInstituciones);
	//dd($request->codInstitucion);
	
 	$vistaurl="publico.reportes.reporteConsejoPdf";
 	//dd($request->idBusqueda);
 	$idInstitucion = $request->codInstitucion;
    $idBusqueda = $request->codInstitucion;

    $hoy = date("d/m/Y"); 
    $periodo = $request->periodo;
//dd($hoy);
$fechaInicial = $request->fechaInicial;

$fechaFinal = $request->fechaFinal;
//dd("periodo".$periodo."_finicio_".$fechaInicial."_ffin".$fechaFinal);
		
		/*$institucionUsuario = DB::select("SELECT * FROM institucion_usuarios 
			WHERE us°uario_id=".Auth::user()->id." ;");*/
			// dd($institucionUsuario[0]->id);
 
 $institucion = $this->obtenerInstitucion($idInstitucion);
			     
			/*$usuario = User::where('id','=',$institucionUsuario[0]->usuario_id)
			                            ->get();*/
		//dd($institucion[0]->id);	
			$usuarioInstitucion = DB::select("SELECT  * from institucion_usuarios
                      where institucion_id = ".$institucion[0]->id." and activo=1");

			$usuario = User::where('id','=',$usuarioInstitucion[0]->usuario_id)
			                            ->get(); 
			$nombreusuario = $usuario[0]->name;
		
 
			$nombreinstitucion = $institucion[0]->nombre_institucion;
			//dd($institucion[0]->id);
			//dd($nombreinstitucion);

			//dd($institucion[0]->id);
			$consejo = $this -> obtenerConsejo($idInstitucion);

			//dd($consejo); 


			$nombreConsejo = $consejo[0]->nombre_consejo; 
			//dd($nombreConsejo); }

$listaMinisterioPorConsejo = $this -> obtenerMinisteriosPorConsejo($idInstitucion);

//dd($listaMinisterioPorConsejo);
$idInstituciones =  0;
foreach($listaMinisterioPorConsejo as $lista){
	$idInstituciones1 =  $lista->idInstitucion;
    $idInstituciones =  $idInstituciones1.",".$idInstituciones;
}
//dd($idInstituciones);
			    $resultadosreporte = ActorSolucion::select('solucions.*','institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politica')
			                      //Solucion::select('solucions.*','i.id', 'i.nombre_institucion', 'p.nombre_politica')
			                                 ->join('solucions', 'solucions.id', '=', 'actor_solucion.solucion_id')
			                                 ->join('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
			                                 ->join('politicas', 'politicas.id', '=', 'solucions.politica_id')
			                                // ->orderBy('solucions.estado_id','DESC')
			                                //  ->groupBy ( 'institucions.id', 'institucions.nombre_institucion', 'politicas.nombre_politicaS')
			        
			                                 //->get();
			                                 ; 


			 $propuestasRecibidas = $this -> obtenerPropuestasRecibidas($idInstitucion,$fechaInicial,$fechaFinal);

			 
			//dd($propuestasRecibidas);
			//dd($propuestasRecibidas[0]->propuestasRecibidas);
			if($propuestasRecibidas){
				$numPropuestasRecibidas = $propuestasRecibidas[0]->propuestasRecibidas;
			}else{
				$numPropuestasRecibidas = 0;
			}
			//dd($numPropuestasRecibidas);


			$propuestasDesestimadas = $this -> obtenerPropuestasDesestimadas($idInstitucion,$fechaInicial,$fechaFinal);

			if($propuestasDesestimadas){
				$numPropuestasDesestimadas = $propuestasDesestimadas[0]->propuestasDesestimadas;
			}else{
				$numPropuestasDesestimadas = 0;
			}

			//dd($numPropuestasDesestimadas); 

			$numPropuestasValidadas = $numPropuestasRecibidas - $numPropuestasDesestimadas;

			//dd($numPropuestasValidadas);


			$propuestasAnalisadas = $this -> obtenerPropuestasAnalisadas($idInstitucion,$fechaInicial,$fechaFinal);

			//dd($propuestasAnalisadas);
			if($propuestasAnalisadas){
				$numPropuestasAnalisadas = $propuestasAnalisadas[0]->propuestasAnalisadas;
			}else{
				$numPropuestasAnalisadas = 0;
			}

			//dd($numPropuestasAnalisadas);

			$propuestasPolitica = $this -> obtenerPropuestasPolitica($idInstitucion,$fechaInicial,$fechaFinal);

			
			if($propuestasPolitica){
				$numPropuestasPolitica = $propuestasPolitica[0]->propuestasPolitica;
			}else{
				$numPropuestasPolitica = 0;
			}

			//dd($numPropuestasPolitica);

			$propuestasLeyes = $this -> obtenerPropuestasLeyes($idInstitucion,$fechaInicial,$fechaFinal);

			if($propuestasLeyes){
				$numPropuestasLeyes = $propuestasLeyes[0]->propuestasLeyes;
			}else{
				$numPropuestasLeyes = 0;
			}


			$propuestasDesarrolladas = $this -> obtenerPropuestasDesarrolladas($idInstitucion,$fechaInicial,$fechaFinal);

			
			if($propuestasDesarrolladas){
				$numPropuestasDesarrolladas = $propuestasDesarrolladas[0]->propuestasDesarrolladas;
			}else{
				$numPropuestasDesarrolladas = 0;
			}
			//dd($numPropuestasDesarrolladas);


			$propuestasFinalisadas = $this -> obtenerPropuestasFinalisadas($idInstitucion,$fechaInicial,$fechaFinal);

			
			if($propuestasFinalisadas){
				$numPropuestasFinalisadas = $propuestasFinalisadas[0]->propuestasFinalisadas;
			}else{
				$numPropuestasFinalisadas = 0;
			}
			//dd($numPropuestasAnalisadas);

			$propuestasEnConflicto = $this -> obtenerPropuestasEnConflicto($idInstitucion,$fechaInicial,$fechaFinal);


			if($propuestasEnConflicto){
				$numPropuestasConflicto = $propuestasEnConflicto[0]->propuestasEnConflicto;
			}else{
				$numPropuestasConflicto = 0;
			}

			$propuestasPlazoLargo = $this -> obtenerPropuestasPlazoLargo($idInstitucion,$fechaInicial,$fechaFinal);

			
			if($propuestasPlazoLargo){
				$numPropuestasPlazoLargo = $propuestasPlazoLargo[0]->largo;
			}else{
				$numPropuestasPlazoLargo = 0;
			}
			//dd($numPropuestasPlazoLargo);


			$propuestasPlazoMediano = $this -> obtenerPropuestasPlazoMediano($idInstitucion,$fechaInicial,$fechaFinal);

			
			if($propuestasPlazoMediano){
				$numPropuestasPlazoMediano = $propuestasPlazoMediano[0]->mediano;
			}else{
				$numPropuestasPlazoMediano = 0;
			}
			//dd($numPropuestasPlazoMediano);


			$propuestasPlazoCorto = $this -> obtenerPropuestasPlazoCorto($idInstitucion,$fechaInicial,$fechaFinal);

			
			if($propuestasPlazoCorto){
				$numPropuestasPlazoCorto = $propuestasPlazoCorto[0]->corto;
			}else{
				$numPropuestasPlazoCorto = 0;
			}
			//dd($numPropuestasPlazoMediano);

$propuestasPorMesa = $this -> obtenerPropuestasPorMesa($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
//dd($propuestasPorMesa);

$propuestasPorMesaFinalizadas = $this -> obtenerPropuestasPorMesaFinalizadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);

$propuestasPlanificadas = $this -> obtenerPropuestasPlanificadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
if($propuestasPlanificadas){
	$numPropuestasPlanificadas = $propuestasPlanificadas[0]->numPlanificadas;
}else{
	$numPropuestasPlanificadas = 0;
}

$propuestasNoPlanificadas = $this -> obtenerPropuestasNoPlanificadas($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);
if($propuestasNoPlanificadas){
	$numPropuestasNoPlanificadas = $propuestasNoPlanificadas[0]->numNoPlanificadas;
}else{
	$numPropuestasNoPlanificadas = 0;
}

$propuestasPorAmbito = $this -> obtenerPropuestasPorAmbito($consejo[0]->idConsejo,$fechaInicial,$fechaFinal);


        //$elementos= sizeof($data1);
        //dd($data1);
        $date = date('Y-m-d');
      /* dd( "hoy".$hoy."_nombreusuario".$nombreusuario."_periodo".$periodo.        	                                                      "_fechaInicial".$fechaInicial.
                                                                  "_fechaFinal".$fechaFinal. 
        	                                                      "_nombreinstitucion".$nombreinstitucion.
        	                                                      "_nombreConsejo".$nombreConsejo.
        	                                                      "_numPropuestasRecibidas".$numPropuestasRecibidas.
        	                                                      "_numPropuestasDesestimadas".$numPropuestasDesestimadas.
        	                                                      "_numPropuestasValidadas".$numPropuestasValidadas.
        	                                                      "_numPropuestasAnalisadas".$numPropuestasAnalisadas.
        	                                                      "_numPropuestasDesarrolladas".$numPropuestasDesarrolladas.
        	                                                      "_numPropuestasFinalisadas".$numPropuestasFinalisadas.
        	                                                      "_numPropuestasPolitica".$numPropuestasPolitica.
        	                                                      "_numPropuestasLeyes".$numPropuestasLeyes.
        	                                                      "_numPropuestasPlazoLargo".$numPropuestasPlazoLargo.
        	                                                      "_numPropuestasPlazoMediano".$numPropuestasPlazoMediano.
        	                                                      "_numPropuestasPlazoCorto".$numPropuestasPlazoCorto);
        	                                                      //"_resultadosreporte".$resultadosreporte);

*/
        $view = \View::make($vistaurl, compact('date'))->with( [ "hoy" => $hoy,"nombreusuario" => $nombreusuario,
        	                                                     "idBusqueda" => $idBusqueda,
        	                                                     "periodo" => $periodo,
        	                                                      "fechaInicial" =>$fechaInicial,
                                                                  "fechaFinal" => $fechaFinal, 
        	                                                      "nombreinstitucion"=> $nombreinstitucion,
        	                                                      "nombreConsejo" => $nombreConsejo,
        	                                                      "numPropuestasRecibidas" => $numPropuestasRecibidas,
        	                                                      "numPropuestasDesestimadas" => $numPropuestasDesestimadas,
        	                                                      "numPropuestasValidadas" => $numPropuestasValidadas,
        	                                                      "numPropuestasAnalisadas" => $numPropuestasAnalisadas,
        	                                                      "numPropuestasDesarrolladas" => $numPropuestasDesarrolladas,
        	                                                      "numPropuestasFinalisadas" => $numPropuestasFinalisadas,
        	                                                      "numPropuestasConflicto" => $numPropuestasConflicto,
        	                                                      "numPropuestasPolitica" => $numPropuestasPolitica,
        	                                                      "numPropuestasLeyes" => $numPropuestasLeyes,
        	                                                      "numPropuestasPlazoLargo" => $numPropuestasPlazoLargo,
        	                                                      "numPropuestasPlazoMediano" => $numPropuestasPlazoMediano,
        	                                                      "numPropuestasPlazoCorto" => $numPropuestasPlazoCorto,
        	                                                      "numPropuestasPlanificadas" => $numPropuestasPlanificadas,
        	                                                      "numPropuestasNoPlanificadas" => $numPropuestasPlanificadas,
        	                                                      "propuestasPorMesa" => $propuestasPorMesa,
        	                                                      "propuestasPorAmbito" => $propuestasPorAmbito  
        	                                                      ] )->render();
       //  dd($view);
        $pdf = \App::make('dompdf.wrapper');
        // dd($pdf);
        $pdf->loadHTML($view);
       //dd($pdf);
        //if($tipo==1){return $pdf->stream('ReporteConsejo.pdf');}
        //if($tipo==2){return $pdf->download('ReporteConsejo.pdf'); }
        return $pdf->download('ReporteConsejo.pdf');

    }


}