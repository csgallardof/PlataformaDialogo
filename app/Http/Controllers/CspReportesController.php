<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\CspReportesHecho;
use App\CspReporteEstado;
use App\CspReportesAlerta;
use App\CspAccionesAlerta;
use App\Institucion;
use App\CspPeriodoReporte;
use App\User;
use Illuminate\Support\Facades\Auth;
use Storage;
use File;
use DB;
class CspReportesController extends Controller
{
    public function vistaCrearReporteHecho(){
        $usuario_institucion_id = Auth::user()->institucion_id;

        //dd($date_start,$date_end,$today);
        return view('csp.createReporteHechoCsp',['usuario_institucion_id'=>$usuario_institucion_id]);   
    }
    public function vistaCrearReporteAlerta(){
        $estadoReporte = CspReporteEstado::all();
        $usuario_institucion_id = Auth::user()->institucion_id; 
        return view('csp.createReporteAlertaCsp',['estadoReporte'=>$estadoReporte],['usuario_institucion_id'=>$usuario_institucion_id]);   
    }
    public function guardarReporteHecho(Request $request){
        
       
        $hora = date("h:i");
        $fecha_reporte = $request['fecha_reporte'];
        $fecha_hora_Reporte=$fecha_reporte." ".$hora;
        
        $creacion_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$creacion_reporte." ".$hora;
        
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        //dd($fecha_creacion_Reporte,$fecha_hora_Reporte);
        $fecha_reporte = $request['fecha_reporte'];
        $fecha_hora_Reporte=$fecha_reporte." ".$hora;
        //dd($fecha_hora_Reporte, $fecha_hora_Reporte);
        $institucion_id = $request['institucion_id'];
        $tema = $request['tema'];
        $descripcion = $request['descripcion'];
        $fuente = $request['fuente'];
        $lugar = $request['lugar'];
        $porcentaje_avance = $request['porcentaje_avance'];
        $lineas_discursivas = $request['lineas_discursivas'];
        $tipo_comunicacional = $request['tipo_comunicacional'];
        if($request->hasFile('anexo')){
        $anexo = $request->file('anexo');
        //dd($anexo,'kjhksj');
        $nombreArchivo = strtotime("now").'-'.$anexo->getClientOriginalName();

        Storage::disk('CspReportesHechos')->put($nombreArchivo,file_get_contents($anexo->getRealPath()));
        }else
        $nombreArchivo="000Ninguno";
        
        $CspReportesHecho = new CspReportesHecho();
        $CspReportesHecho-> fecha_reporte = $fecha_hora_Reporte;
        $CspReportesHecho-> institucion_id = $institucion_id;
        $CspReportesHecho-> periodo_id = $periodo_id;
        $CspReportesHecho-> tema = $tema;
        $CspReportesHecho-> descripcion = $descripcion;
        $CspReportesHecho-> fuente = $fuente;
        $CspReportesHecho-> lugar = $lugar;
        $CspReportesHecho-> porcentaje_avance = $porcentaje_avance;
        $CspReportesHecho-> lineas_discursivas = $lineas_discursivas;
        $CspReportesHecho-> anexo = $nombreArchivo;
        $CspReportesHecho-> tipo_comunicacional = $tipo_comunicacional;
        $CspReportesHecho-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-hechos');
    }
    public function crearAccionesAlerta(Request $request){
        $hora = date("h:i");
        $creacion_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$creacion_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        $reporte_alerta_id = $request['reporte_alerta_id'];
        $acciones = $request['acciones'];
        $fecha = $request['fecha'];
        $fecha_hora_Accion=$fecha." ".$hora;
        
        if($request->hasFile('anexo')){
        $anexo = $request->file('anexo');   
        $nombreArchivo = strtotime("now").'-'.$anexo->getClientOriginalName();
        Storage::disk('CspReportesAlerta')->put($nombreArchivo,file_get_contents($anexo->getRealPath()));
        }else 
        $nombreArchivo="000Ninguno";
        $CspAccionesAlerta = new CspAccionesAlerta();
        $CspAccionesAlerta-> reporte_alerta_id = $reporte_alerta_id;
        $CspAccionesAlerta-> periodo_id = $periodo_id;
        $CspAccionesAlerta-> acciones = $acciones;
        $CspAccionesAlerta-> fecha = $fecha_hora_Accion;
        $CspAccionesAlerta-> anexo = $nombreArchivo;
         //dd($CspAccionesAlerta);
        $CspAccionesAlerta-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-alertas');
    }
    public function guardarReporteAlerta(Request $request){
        $hora = date("h:i");
        $creacion_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$creacion_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        //dd(fecha_atencion_hora);
        $estado_reporte_id = $request['estado_reporte_id'];
        $institucion_id = $request['institucion_id'];
        $fecha_atencion = $request['fecha_atencion'];
        $fecha_hora_atencion=$fecha_atencion." ".$hora;
        $tema = $request['tema'];
        $descripcion = $request['descripcion'];
        $solucion_propuesta = $request['solucion_propuesta'];
        $riesgo_principal = $request['riesgo_principal'];
        $fuente = $request['fuente'];
        $tipo_comunicacional = $request['tipo_comunicacional'];
        //dd($tipo_comunicacional);
        if($request->hasFile('anexo')){
        $anexo = $request->file('anexo');   
        $nombreArchivo = strtotime("now").'-'.$anexo->getClientOriginalName();
        Storage::disk('CspReportesAlerta')->put($nombreArchivo,file_get_contents($anexo->getRealPath()));
        }else
        $nombreArchivo="000Ninguno";
        $CspReportesAlerta = new CspReportesAlerta();
        $CspReportesAlerta-> estado_reporte_id = $estado_reporte_id;
        $CspReportesAlerta-> institucion_id = $institucion_id;
        $CspReportesAlerta-> periodo_id = $periodo_id;
        $CspReportesAlerta-> fecha_atencion = $fecha_hora_atencion;
        $CspReportesAlerta-> tema = $tema;
        $CspReportesAlerta-> descripcion = $descripcion;
        $CspReportesAlerta-> solucion_propuesta = $solucion_propuesta;
        $CspReportesAlerta-> riesgo_principal = $riesgo_principal;
        $CspReportesAlerta-> fuente = $fuente;
        $CspReportesAlerta-> tipo_comunicacional = $tipo_comunicacional;
        $CspReportesAlerta-> anexo = $nombreArchivo;
        $CspReportesAlerta-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-alertas');
    }

    public function homeReportesHechos(){

        

         $usuario_institucion_id = Auth::user()->institucion_id;
        //dd($usuario_institucion_id);
        $tipofuente=Auth::user()->tipo_fuente;
        //dd($tipofuente);
        $hora = date("h:i");
        $semana_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$semana_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }

       

        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_id);
        $periodoAnterior =CspPeriodoReporte::find($periodo_id-1);
        //dd($periodoAnterior, $PeriodoSemanaCspReporte);
    
        
        //dd($intervaloEditar);
            $idAnteriorPeriodo=0;
            $fechaActual=date("Y-m-d");
            $finPeriodoAnterior= substr($periodoAnterior->fecha_final,0,10);
            //dd($finPeriodoAnterior);
            $datetime1 = date_create($finPeriodoAnterior);
            $datetime2 = date_create($fechaActual);
                                                        //dd($datetime1, $datetime2);
            $interval = date_diff($datetime1, $datetime2);
            $intervaloEditar= $interval->format('%R%a');
            $intervaloEditar=$intervaloEditar+0;

            if($intervaloEditar<=4 && $intervaloEditar>=0){

                    $idAnteriorPeriodo= $periodoAnterior->id;

            }
                                                        //dd('intervalo',$intervaloEditar);
                                            
            //dd($idAnteriorPeriodo,$intervaloEditar);

        if($tipofuente==4){
        $reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->where('institucions.id', '=',$usuario_institucion_id) 
        ->select('csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.id','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.periodo_id','csp_reportes_hechos.anexo','csp_periodo_reportes.nombre as Periodo','csp_reportes_hechos.created_at as FechaRegistro')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->get();
        //dd($reportesHechos);
        //dd($reportesHechos);
        return view('csp.homeReportesHechos')->with(["PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte,
                                                    'reportesHechos'=>$reportesHechos,
                                                    'idAnteriorPeriodo'=>$idAnteriorPeriodo,
                                                
                                                    ]);
        }

    }

    public function homeReportesAlertas(){
        $usuario_institucion_id = Auth::user()->institucion_id;
        //dd($usuario_institucion_id);
        $tipofuente=Auth::user()->tipo_fuente;
        //dd($tipofuente);
        $hora = date("h:i");
        $semana_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$semana_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_id);
        
        //dd($PeriodoSemanaCspReporte);
        if($tipofuente==4){
        
        
        $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->where('institucions.id', '=',$usuario_institucion_id)
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.tema','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->get();
    
        //dd($reportesHechos);
        return view('csp.homeReportesAlertas')->with(["PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte,
                                                        'reportesAlerta'=>$reportesAlerta
                                                    ]);
        }
    }
    public function mostrarReportes(){
        $usuario_institucion_id = Auth::user()->institucion_id;
        //dd($usuario_institucion_id);
        $tipofuente=Auth::user()->tipo_fuente;
        //dd($tipofuente);
        $hora = date("h:i");
        $semana_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$semana_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_id);
        //dd($PeriodoSemanaCspReporte);
        if($tipofuente==4){
        $reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->where('institucions.id', '=',$usuario_institucion_id)
        ->select('csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.id','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_periodo_reportes.nombre as Periodo','csp_reportes_hechos.created_at as FechaRegistro')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->paginate(20);
        //dd($reportesHechos); 
        
        $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->where('institucions.id', '=',$usuario_institucion_id)
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.tema','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->paginate(20);
    
        //dd($reportesHechos);
        return view('csp.home',['reportesHechos'=>$reportesHechos],['reportesAlerta'=>$reportesAlerta])->with(["PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte]);
        } else
        $reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->paginate(20);
        
        $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.tema','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->paginate(20);
        return view('csp.homeVisualizarReportesCSP',['reportesHechos'=>$reportesHechos],['reportesAlerta'=>$reportesAlerta])->with(["PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte]);
    }
    public function AccionesAlertas($id){
        $cspReportesAlerta = CspReportesAlerta::find($id);
       // dd(cspReportesAlerta);
        return view('csp.createAccionesReporteAlertasCsp',compact('cspReportesAlerta'));    
    }
    public function visualizarAccionesAlertas($id){
        $cspReportesAlerta = CspReportesAlerta::find($id);
        $hora = date("h:i");
        $semana_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$semana_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_id);
        
        $periodoAnterior =CspPeriodoReporte::find($periodo_id-1);
        //dd($periodoAnterior, $PeriodoSemanaCspReporte);
    
        
        //dd($intervaloEditar);
            $idAnteriorPeriodo=0;
            $fechaActual=date("Y-m-d");
            $finPeriodoAnterior= substr($periodoAnterior->fecha_final,0,10);
            //dd($finPeriodoAnterior);
            $datetime1 = date_create($finPeriodoAnterior);
            $datetime2 = date_create($fechaActual);
                                                        //dd($datetime1, $datetime2);
            $interval = date_diff($datetime1, $datetime2);
            $intervaloEditar= $interval->format('%R%a');
            $intervaloEditar=$intervaloEditar+0;

            if($intervaloEditar<=4 && $intervaloEditar>=0){

                    $idAnteriorPeriodo= $periodoAnterior->id;

            }
            //dd($idAnteriorPeriodo,$intervaloEditar);

        $accionesReporteAlerta =DB::table('csp_acciones_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_acciones_alertas.periodo_id')
        ->join('csp_reportes_alertas','csp_reportes_alertas.id','=','csp_acciones_alertas.reporte_alerta_id')
        ->where('csp_acciones_alertas.reporte_alerta_id', '=',$id)
        ->select('csp_acciones_alertas.anexo','csp_acciones_alertas.periodo_id','csp_acciones_alertas.fecha','csp_acciones_alertas.acciones','csp_acciones_alertas.id','csp_acciones_alertas.created_at','csp_periodo_reportes.nombre as Periodo')
        ->paginate(10);
        //dd($accionesReporteAlerta);
        return view('csp.visualizarAccionesAlertas',compact('cspReportesAlerta'),compact('accionesReporteAlerta'))->with([
                                                                                    "PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte,
                                                                                    "idAnteriorPeriodo"=>$idAnteriorPeriodo,
                                                                                ]);    
    }
    public function visualizarAccionesAlertasGeneral($id){
        $cspReportesAlerta = CspReportesAlerta::find($id);
        $accionesReporteAlerta =DB::table('csp_acciones_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_acciones_alertas.periodo_id')
        ->join('csp_reportes_alertas','csp_reportes_alertas.id','=','csp_acciones_alertas.reporte_alerta_id')
        ->where('csp_acciones_alertas.reporte_alerta_id', '=',$id)
        ->select('csp_acciones_alertas.anexo','csp_acciones_alertas.fecha','csp_acciones_alertas.acciones','csp_acciones_alertas.id','csp_acciones_alertas.created_at','csp_periodo_reportes.nombre as Periodo')
        ->paginate(10);
        //dd($accionesReporteAlerta);
        return view('csp.visualizarAccionesAlertasGeneral',compact('cspReportesAlerta'),compact('accionesReporteAlerta'));    
    }
    public function visualizarReporteHecho($id){

        $cspReportesHecho = CspReportesHecho::find($id);
        //dd($ReporteHechoVisualizar);
        return view('csp.visualizarReporteHechoCsp',compact('cspReportesHecho'),compact('ReporteHechoVisualizar'));    
    }

    public function visualizarDetalleReporteHecho($id){

        $cspReportesHecho = CspReportesHecho::find($id);
        //dd($ReporteHechoVisualizar);
        return view('csp.vistaSecretario.visualizarReporteHechoCspSecretario',compact('cspReportesHecho'),compact('ReporteHechoVisualizar'));    
    }
    public function visualizarReporteAlerta($id){
        $cspReportesAlerta = cspReportesAlerta::find($id);
        
        //dd($ReporteHechoVisualizar);
        return view('csp.visualizarReporteAlertaCsp',compact('cspReportesAlerta'));    
    }

    public function visualizarDetalleReporteAlerta($id){
        $cspReportesAlerta = cspReportesAlerta::find($id);
        
        //dd($ReporteHechoVisualizar);
        return view('csp.vistaSecretario.visualizarReporteAlertaCspSecretario',compact('cspReportesAlerta'));    
    }
    //EDITAR REPORTES HECHO CSP
    public function vistaEditarReporteHecho($id){
         $cspReportesHecho = CspReportesHecho::find($id);
          $usuario_institucion_id = Auth::user()->institucion_id;
        return view('csp.editarReportesCsp.editarReporteHechoCsp',compact('cspReportesHecho'),['usuario_institucion_id'=>$usuario_institucion_id]);
    }
    public function editarReporteHechoCsp(Request $request, $id){
        $fecha_reporte = $request->input('fecha_reporte');
        $institucion_id = $request->input('institucion_id');
        $tema = $request->input('tema');
        $descripcion = $request->input('descripcion');
        $fuente = $request->input('fuente');
        $porcentaje_avance = $request->input('porcentaje_avance');
        $lineas_discursivas = $request->input('lineas_discursivas');
        $tipo_comunicacional = $request['tipo_comunicacional'];
        //dd($tipo_comunicacional);
        if($request->hasFile('anexo')){
        $anexo = $request->file('anexo');   
        $nombreArchivo = strtotime("now").'-'.$anexo->getClientOriginalName();
        Storage::disk('CspReportesHechos')->put($nombreArchivo,file_get_contents($anexo->getRealPath()));
        }else
        $nombreArchivo="000Ninguno";
        $cspReportesHecho = CspReportesHecho::find($id);
        $cspReportesHecho-> fecha_reporte = $fecha_reporte;
        $cspReportesHecho-> institucion_id = $institucion_id;
        $cspReportesHecho-> tema = $tema;
        $cspReportesHecho-> descripcion = $descripcion;
        $cspReportesHecho-> fuente = $fuente;
        $cspReportesHecho-> porcentaje_avance = $porcentaje_avance;
        $cspReportesHecho-> lineas_discursivas = $lineas_discursivas;
        $cspReportesHecho-> anexo = $nombreArchivo;
        $cspReportesHecho-> tipo_comunicacional = $tipo_comunicacional;
        $cspReportesHecho-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-hechos');
    }
    //EDITAR REPORTES ALERTA CSP
    public function vistaEditarReporteAlerta($id){
        $hora = date("h:i");
        $semana_reporte=date("Y/m/d");
        $fecha_creacion_Reporte=$semana_reporte." ".$hora;
        function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
        }
        $periodoCorrecto=False;
        $i=1;
        
        while ($periodoCorrecto==False) {
        $PeriodoCspReporte = CspPeriodoReporte::find($i);
        $date_start = $PeriodoCspReporte->fecha_inicio;
        $date_end = $PeriodoCspReporte->fecha_final;
        $today = $fecha_creacion_Reporte;
        if( check_in_range($date_start, $date_end, $today) ){
            $periodo_id=$PeriodoCspReporte->id;
            $periodoCorrecto=True;
            } else {
            $periodoCorrecto==False;
            }
            $i++;  
        
        }
        $CspPeriodoReporte = CspPeriodoReporte::find($periodo_id);
        //$PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_id);
        $periodoAnterior =CspPeriodoReporte::find($periodo_id-1);
        //dd($periodoAnterior, $CspPeriodoReporte);
    
        
        //dd($intervaloEditar);
            $idAnteriorPeriodo=0;
            $fechaActual=date("Y-m-d");
            $finPeriodoAnterior= substr($periodoAnterior->fecha_final,0,10);
            //dd($finPeriodoAnterior);
            $datetime1 = date_create($finPeriodoAnterior);
            $datetime2 = date_create($fechaActual);
                                                        //dd($datetime1, $datetime2);
            $interval = date_diff($datetime1, $datetime2);
            $intervaloEditar= $interval->format('%R%a');
            $intervaloEditar=$intervaloEditar+0;

            if($intervaloEditar<=4 && $intervaloEditar>=0){

                    $idAnteriorPeriodo= $periodoAnterior->id;

            }
            //dd($idAnteriorPeriodo,$intervaloEditar);
        $usuario_institucion_id = Auth::user()->institucion_id;
        $cspReportesAlerta = cspReportesAlerta::find($id);
         $estadoReporte = CspReporteEstado::all();
         
        return view('csp.editarReportesCsp.editarReporteAlertaCsp',['usuario_institucion_id'=>$usuario_institucion_id],['estadoReporte'=>$estadoReporte],['CspPeriodoReporte'=>$CspPeriodoReporte])->with(["cspReportesAlerta"=>$cspReportesAlerta,
                                                                            "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                            "idAnteriorPeriodo"=>$idAnteriorPeriodo
                                                                        ]); 
    }
    public function editarReporteAlertaCsp(Request $request, $id){
        $estado_reporte_id = $request->input('estado_reporte_id');
        $institucion_id = $request->input('institucion_id');
        $fecha_atencion = $request->input('fecha_atencion');
        $tema = $request->input('tema');
        $descripcion = $request->input('descripcion');
        $solucion_propuesta = $request->input('solucion_propuesta');
        $riesgo_principal = $request->input('riesgo_principal');
        $fuente = $request->input('fuente');
        $tipo_comunicacional = $request->input('tipo_comunicacional');
        //dd($tipo_comunicacional);
        if($request->hasFile('anexo')){
        $anexo = $request->file('anexo');   
        $nombreArchivo = strtotime("now").'-'.$anexo->getClientOriginalName();
        Storage::disk('CspReportesAlerta')->put($nombreArchivo,file_get_contents($anexo->getRealPath()));
        }else
        $nombreArchivo="000Ninguno";
        $cspReportesAlerta = cspReportesAlerta::find($id);
        $cspReportesAlerta-> estado_reporte_id = $estado_reporte_id;
        $cspReportesAlerta-> institucion_id = $institucion_id;
        $cspReportesAlerta-> fecha_atencion = $fecha_atencion;
        $cspReportesAlerta-> tema = $tema;
        $cspReportesAlerta-> descripcion = $descripcion;
        $cspReportesAlerta-> solucion_propuesta = $solucion_propuesta;
        $cspReportesAlerta-> riesgo_principal = $riesgo_principal;
        $cspReportesAlerta-> fuente = $fuente;
        $cspReportesAlerta-> tipo_comunicacional = $tipo_comunicacional;
        $cspReportesAlerta-> anexo = $nombreArchivo;
        $cspReportesAlerta-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-alertas');
    }
    public function editarReporteAlertaEstadoCsp(Request $request, $id){
        $estado_reporte_id = $request->input('estado_reporte_id');
        $institucion_id = $request->input('institucion_id');
        $fecha_atencion = $request->input('fecha_atencion');
        $tema = $request->input('tema');
        $descripcion = $request->input('descripcion');
        $solucion_propuesta = $request->input('solucion_propuesta');
        $riesgo_principal = $request->input('riesgo_principal');
        $fuente = $request->input('fuente');
        $anexo = $request->input('anexo');
        $cspReportesAlerta = cspReportesAlerta::find($id);
        $cspReportesAlerta-> estado_reporte_id = $estado_reporte_id;
        $cspReportesAlerta-> institucion_id = $institucion_id;
        $cspReportesAlerta-> fecha_atencion = $fecha_atencion;
        $cspReportesAlerta-> tema = $tema;
        $cspReportesAlerta-> descripcion = $descripcion;
        $cspReportesAlerta-> solucion_propuesta = $solucion_propuesta;
        $cspReportesAlerta-> riesgo_principal = $riesgo_principal;
        $cspReportesAlerta-> fuente = $fuente;
        $cspReportesAlerta-> anexo = $anexo;
        $cspReportesAlerta-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-alertas');
    }
     //EDITAR ACCIONES ALERTAS CSP
    public function vistaEditaraccionesAlerta($id){
         $CspAccionesAlerta = CspAccionesAlerta::find($id);
         
        return view('csp.editarReportesCsp.editarAccionesAlertasCsp',compact('CspAccionesAlerta')); 
    }
    public function editarAccionesAlertaCsp(Request $request, $id){
        $reporte_alerta_id = $request->input('reporte_alerta_id');
        $acciones = $request->input('acciones');
        $fecha = $request->input('fecha');
        if($request->hasFile('anexo')){
        $anexo = $request->file('anexo');   
        $nombreArchivo = strtotime("now").'-'.$anexo->getClientOriginalName();
        Storage::disk('CspReportesAlerta')->put($nombreArchivo,file_get_contents($anexo->getRealPath()));
        }else
        $nombreArchivo="000Ninguno";
        $CspAccionesAlerta = CspAccionesAlerta::find($id);
        $CspAccionesAlerta-> reporte_alerta_id = $reporte_alerta_id;
        $CspAccionesAlerta-> acciones = $acciones;
        $CspAccionesAlerta-> fecha = $fecha;
        $CspAccionesAlerta-> anexo = $nombreArchivo;
        $CspAccionesAlerta-> save();
        return redirect('/institucion/consejo-sectorial-produccion/reportes-alertas');
    }
}