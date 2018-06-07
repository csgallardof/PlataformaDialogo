<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\CspTipoAgenda;
use App\CspTipoImpactoAgenda;
use App\CspPeriodoAgenda;
use App\CspAgendaTerritorial;
use App\Provincia;
use App\Canton;
use DB;
//use App\User;
//use Illuminate\Support\Facades\Auth;

class CspAgendaTerritorialController extends Controller
{
    public function vistaCrearAgenda(){
    	$usuario_institucion_id = Auth::user()->institucion_id;
    	$cspTipoAgenda = CspTipoAgenda::all();
    	$cspTipoImpactoAgenda = CspTipoImpactoAgenda::all();
    	$provincias = Provincia::all();
    	//dd($cspTipoAgenda);
    	return view('csp.cspAgendaTerritorial.createAgendaTerritorialCsp')->with(["usuario_institucion_id"=>$usuario_institucion_id,
    		"cspTipoImpactoAgenda"=>$cspTipoImpactoAgenda,
    		"provincias"=>$provincias,
    		"cspTipoAgenda"=>$cspTipoAgenda]);
    }
    public function obtenerCantones(Request $request, $id){
        return Canton::cantones($id);
    }

    public function crearAgenda(Request $request){

        
        $fecha_agenda = $request['agenda_fecha'];
        $hora = $request['hora_agenda'];
        $hora_agenda=date("H:i", strtotime($hora));
        $fecha_hora_agenda=$fecha_agenda." ".$hora_agenda.":00";
        
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }

        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspAgenda = CspPeriodoAgenda::find($i);
        $date_start = $PeriodoCspAgenda->fecha_inicio;
        $date_end = $PeriodoCspAgenda->fecha_final;
        $today = $fecha_hora_agenda;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspAgenda->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        //dd('Sipaso');
        
    	$responsable = $request['responsable'];
        $institucion_id = $request['institucion_id'];
        $lugar = $request['lugar'];
        $canton_id = $request['select_canton'];
        $tipo_agenda_id = $request['tipo_agenda_id'];
        $descripcion_tipo_agenda = $request['descripcion_tipo_agenda'];
        $tipo_impacto_id = $request['tipo_impacto_id'];
        $descripcion_tipo_impacto = $request['descripcion_tipo_impacto'];
        $tipo_comunicacional = $request['tipo_comunicacional'];
        //dd($lugar);

        $CspAgendaTerritorial = new CspAgendaTerritorial();
        $CspAgendaTerritorial-> institucion_id = $institucion_id;
        $CspAgendaTerritorial-> canton_id = $canton_id;
        $CspAgendaTerritorial-> lugar = $lugar;
        $CspAgendaTerritorial-> tipo_agenda_id = $tipo_agenda_id;
        $CspAgendaTerritorial-> tipo_impacto_id = $tipo_impacto_id;
        $CspAgendaTerritorial-> periodo_agenda_id = $periodo_id;
        $CspAgendaTerritorial-> descripcion_tipo_agenda = $descripcion_tipo_agenda;
        $CspAgendaTerritorial-> descripcion_tipo_impacto = $descripcion_tipo_impacto;
        $CspAgendaTerritorial-> responsable = $responsable;
        $CspAgendaTerritorial-> fecha_agenda = $fecha_hora_agenda;
        $CspAgendaTerritorial-> tipo_comunicacional = $tipo_comunicacional;
        $CspAgendaTerritorial-> save();
        return redirect('/institucion/ver-agenda-territorial');
        
        //dd($responsable,$fecha_hora_agenda,$institucion_id,$canton_id,$tipo_agenda_id,$descripcion_tipo_agenda,$tipo_impacto_id,$descripcion_tipo_impacto);


    }

    public function mostrarAgendaTerritorial(){
        $usuario_institucion_id = Auth::user()->institucion_id;
        $tipo_fuente=Auth::user()->tipo_fuente;
        if ($tipo_fuente==5) {
          return redirect('/institucion/lista-agenda-territorial-csp');
        } else
        $agendaTerritorial = DB::table('csp_agenda_territorials')
        ->join('csp_periodo_agendas','csp_periodo_agendas.id', '=','csp_agenda_territorials.periodo_agenda_id')
        ->join('cantons','cantons.id', '=','csp_agenda_territorials.canton_id')
        ->join('provincias','provincias.id', '=','cantons.provincia_id')
        ->join('csp_tipo_agendas','csp_tipo_agendas.id', '=','csp_agenda_territorials.tipo_agenda_id')
        ->join('csp_tipo_impacto_agendas','csp_tipo_impacto_agendas.id', '=','csp_agenda_territorials.tipo_impacto_id')
        ->join('institucions','institucions.id', '=','csp_agenda_territorials.institucion_id')
        ->where('institucions.id', '=',$usuario_institucion_id)
        ->select('csp_agenda_territorials.fecha_agenda','csp_agenda_territorials.lugar','csp_agenda_territorials.id','csp_agenda_territorials.responsable','csp_agenda_territorials.tipo_comunicacional','csp_agenda_territorials.descripcion_tipo_agenda','csp_agenda_territorials.descripcion_tipo_impacto','cantons.nombre_canton','institucions.siglas_institucion as Institucion','csp_periodo_agendas.mes','provincias.nombre_provincia','csp_periodo_agendas.semana_anio','csp_agenda_territorials.created_at as FechaRegistro','csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda','csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda')
        ->orderBy('csp_agenda_territorials.id','DESC')
        ->get();
        //dd($agendaTerritorial);
        //dd($agendaTerritorial);
        return view('csp.cspAgendaTerritorial.mostrarAgendaTerritorial')->with(["agendaTerritorial"=>$agendaTerritorial,
            "tipo_fuente"=>$tipo_fuente]);
    }

    public function vistaEditarAgendaTerritorial($id){
         $CspAgendaTerritorial = CspAgendaTerritorial::find($id);
          $usuario_institucion_id = Auth::user()->institucion_id;
          $cspTipoAgenda = CspTipoAgenda::all();
        $cspTipoImpactoAgenda = CspTipoImpactoAgenda::all();
        $provincias = Provincia::all();
        return view('csp.cspAgendaTerritorial.editarAgendaTerritorialCsp')->with(["usuario_institucion_id"=>$usuario_institucion_id,
            "cspTipoImpactoAgenda"=>$cspTipoImpactoAgenda,
            "provincias"=>$provincias,
            "cspTipoAgenda"=>$cspTipoAgenda,
            "CspAgendaTerritorial"=>$CspAgendaTerritorial]);

    }
    public function editarReporteAlertaCsp(Request $request, $id){

        $responsable = $request['responsable'];
        $fecha_agenda = $request['agenda_fecha'];
        $hora = $request['hora_agenda'];
        $hora_agenda=date("H:i", strtotime($hora));
        $fecha_hora_agenda=$fecha_agenda." ".$hora_agenda.":00";
        $institucion_id = $request['institucion_id'];
        $canton_id = $request['select_canton'];
        $lugar = $request['lugar'];
        $tipo_agenda_id = $request['tipo_agenda_id'];
        $descripcion_tipo_agenda = $request['descripcion_tipo_agenda'];
        $tipo_impacto_id = $request['tipo_impacto_id'];
        $descripcion_tipo_impacto = $request['descripcion_tipo_impacto'];
        $tipo_comunicacional = $request['tipo_comunicacional'];
        
        $CspAgendaTerritorial = CspAgendaTerritorial::find($id);
        $CspAgendaTerritorial-> institucion_id = $institucion_id;
        $CspAgendaTerritorial-> canton_id = $canton_id;
        $CspAgendaTerritorial-> tipo_agenda_id = $tipo_agenda_id;
        $CspAgendaTerritorial-> tipo_impacto_id = $tipo_impacto_id;
        $CspAgendaTerritorial-> lugar = $lugar;
        $CspAgendaTerritorial-> descripcion_tipo_agenda = $descripcion_tipo_agenda;
        $CspAgendaTerritorial-> descripcion_tipo_impacto = $descripcion_tipo_impacto;
        $CspAgendaTerritorial-> responsable = $responsable;
        $CspAgendaTerritorial-> fecha_agenda = $fecha_hora_agenda;
        $CspAgendaTerritorial-> tipo_comunicacional = $tipo_comunicacional;
        $CspAgendaTerritorial-> save();
        
        return redirect('/institucion/ver-agenda-territorial');
    }

    

    
}
