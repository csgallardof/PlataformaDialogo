<?php

namespace App\Http\Controllers;

use App\Solucion;
use App\Pajustada;
use App\Actividad;
use App\ActorSolucion;
use App\Archivo;
use App\DetalleActividad;
use Mail;
use App\Politica;
use App\PlanNacional;
use App\IndiceCompetitividad;



use DB;
use File;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuditoriaController;


class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    public function verActividadesDespliegue($tipo_actor, $idSolucion){

        if( $tipo_actor != 1 && $tipo_actor != 2 ){
            return abort(404);
        }


        $solucion = DB::select("SELECT solucions.* FROM solucions
                                INNER JOIN actor_solucion asl ON asl.solucion_id = solucions.id
                                INNER JOIN user_institucions ui ON ui.institucion_id = asl.institucion_id
                                WHERE ui.user_id = ". Auth::user()->id." AND asl.solucion_id = ".$idSolucion." AND asl.tipo_actor = ". $tipo_actor." ;");

        
        $this->notFound($solucion);  //REDIRECCIONA AL ERROR 404  SI EL OBJETO NO EXISTE

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 1)
                                ->orderBy('created_at','DESC')->get();


        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->orderBy('tipo_actor','ASC')->get();

        //dd($tipo_actor);


        $tipo_fuente = Auth::user()->tipo_fuente; 

        return view('institucion.actividades.solucionDesp')->with(["actoresSoluciones"=>$actoresSoluciones,
                                                            "solucion"=>$solucion[0],
                                                            "actividades"=>$actividades,
                                                            "tipo_actor"=>$tipo_actor,
                                                            "tipo_fuente"=>$tipo_fuente
                                                        ]);
    }

    public function vistaParametrosCumplimiento($idSolucion){
        
        //dd('hola');
        $tipo_fuente = Auth::user()->tipo_fuente;
        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 1)
                                ->orderBy('created_at','DESC')->get();
        $solucion = DB::table('solucions')->where('id', $idSolucion )->first();

        $politica = Politica::all();
        $plan_nacional = PlanNacional::all();
        $indice_competitividad = IndiceCompetitividad::all();

        //dd($politica);
        return view('institucion.actividades.createParametrosCumplimiento')->with([
                            "idSolucion"=>$idSolucion,
                            "tipo_fuente"=>$tipo_fuente,
                            "actividades"=>$actividades,
                            "solucion"=>$solucion,
                            "politica"=>$politica,
                            "plan_nacional"=>$plan_nacional,
                            "indice_competitividad" => $indice_competitividad,
                        ]);

    }

    public function crearParametrosCumplimiento(Request $request, $id){
        //dd('uno');

        $fecha_cumplimiento = $request['fecha_cumplimimento'];
        $plazo_cumplimiento = $request['plazo_cumplimiento'];
        $riesgos_cumplimiento = $request['riesgos_cumplimiento'];
        $supuestos_cumplimientos = $request['supuestos_cumplimientos'];
        $politica = $request['politica'];
        $plan_nacional = $request['plan_nacional'];
        $indice_competitividad = $request['indice_competitividad'];
        $planificado = $request['planificado'];
        $riesgos_cumplimiento = $request['riesgos_cumplimiento'];
        $instrumento = $request['instrumento'];

        //dd($fecha_cumplimimento,$plazo_cumplimiento,$riesgos_cumplimiento,$supuestos_cumplimientos);
        
        $Solucion = Solucion::find($id); 
        //dd($Solucion->pajustada_id);
       
        $Solucion-> fecha_cumplimiento = $fecha_cumplimiento;
        $Solucion-> plazo_cumplimiento = $plazo_cumplimiento;
        $Solucion-> riesgos_cumplimiento = $riesgos_cumplimiento;
        $Solucion-> politica_id = $politica;
        $Solucion-> plan_nacional_id = $plan_nacional;
        $Solucion-> indice_competitividad_id = $indice_competitividad;
        $Solucion-> planificado = $planificado;
        $Solucion-> riesgos_cumplimiento = $riesgos_cumplimiento;
        $Solucion-> planificado_instrumento = $instrumento;
        
        $Solucion-> save();
        if($Solucion->pajustada_id>0){
            //dd('Si estoy en el if');
            $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $Solucion->pajustada_id)->get();
            
            
            foreach($SolucionesUnificadas as $SolucionesUnificadas){
                //var_dump($SolucionesUnificadas->id);
                    if($SolucionesUnificadas->id!=$id){
                        $Solucion = Solucion::find($SolucionesUnificadas->id); 
                        //dd($Solucion->pajustada_id);
                        $Solucion-> fecha_cumplimiento = $fecha_cumplimiento;
                        $Solucion-> plazo_cumplimiento = $plazo_cumplimiento;
                        $Solucion-> riesgos_cumplimiento = $riesgos_cumplimiento;
                        $Solucion-> supuestos_cumplimientos = $supuestos_cumplimientos;
                        $Solucion-> save();
                        }
                    //dd("no entre en el if");
            }
            
            }

        //dd($id);
        return redirect()->route('verSolucion.despliegue',[1,$id]);        

    }

    public function vistaFinalizarPropuesta($idSolucion){

         Flash::success("Registre la Actividad para finalizar la Propuesta");

         //dd('hola');
        $solucion = Solucion::find($idSolucion);

        $tipo_fuente = Auth::user()->tipo_fuente;

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->orderBy('created_at','ASC')->get();

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->orderBy('tipo_actor','ASC')->get();
        
        return view('institucion.actividades.createAccionFinalizarPropuesta')->with(["solucion"=>$solucion,"actividades"=>$actividades,"actoresSoluciones"=>$actoresSoluciones,"tipo_fuente"=>$tipo_fuente]);
    }

    public function finalizarPropuestaSolucion(Request $request, $tipo_fuente, $idSolucion){

        $Solucion = Solucion::find($idSolucion);
        $Solucion-> estado_id = 4;
        $Solucion-> save();

        $actividad = new Actividad;
        $actividad-> comentario = 'Finalizado por: '.$request-> comentario;
        $actividad-> solucion_id = $idSolucion;
        $actividad-> ejecutor_id = $request-> institucion_id;
        $actividad-> tipo_fuente = $tipo_fuente;
        if( isset($request-> fecha) ){
            $actividad-> fecha_inicio = $request-> fecha. " 00:00:00";
            if($request->tipo_fuente_id ==1){
                    $solucion = Solucion::find($idSolucion);
                    $solucion-> estado_id = 3; // 3 = Propuesta en desarrollo
                    $solucion->save();
                }
                
        }

        $actividad-> save();

        $actividadcreada = DB::table('actividades')->where('comentario', $request-> comentario)->first();
            $solucionAsignada = Solucion::find($idSolucion);
            
            //dd($actividadcreada->fecha_inicio,$solucionAsignada->pajustada_id,$SolucionesUnificadas);
            
            // if($solucionAsignada->pajustada_id>0){
                
            // $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $solucionAsignada->pajustada_id)->get();
            // //dd($SolucionesUnificadas);
            // foreach($SolucionesUnificadas as $SolucionesUnificadas){

            //     //var_dump($SolucionesUnificadas->id);
            //         if($SolucionesUnificadas->id!=$idSolucion){

            //             $SolucionUnificadaFinalizado = Solucion::find($SolucionesUnificadas->id);
            //             $SolucionUnificadaFinalizado-> estado_id = 4;
            //             $SolucionUnificadaFinalizado-> save();
            //             //dd('entre al if');
            //             $actividadUnificada=new Actividad;
            //             $actividadUnificada-> fecha_inicio = $actividadcreada->fecha_inicio;
            //             $actividadUnificada-> comentario   = $actividadcreada->comentario;
            //             $actividadUnificada-> solucion_id = $SolucionesUnificadas->id;
            //             $actividadUnificada-> tipo_fuente = $actividadcreada->tipo_fuente;
            //             $actividadUnificada-> ejecutor_id = $actividadcreada->ejecutor_id;
            //             $actividadUnificada-> save();

                        
            //         }
            //         //dd("no entre en el if");
            // }
            // }


         $nombreArchivos="";   

        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {

                $nombreArchivo = $file->getClientOriginalName();
                $nombreArchivo = strtotime("now")."_despliegue_".$idSolucion."_-_".$nombreArchivo;     // agregamos la fecha

                $archivo = new Archivo;
                $archivo-> nombre_archivo= $nombreArchivo;
                $archivo-> actividad_id= $actividad->id;
                $archivo->save();
                $nombreArchivos.=$nombreArchivo.",";
                /*$file = $request->file('imagen');*/
                \Storage::disk('local3')->put($nombreArchivo,  \File::get($file) );
            }
        }

        $nombreArchivos=substr($nombreArchivos,0,-1);
        //dd($nombreArchivos);
        

                $actividadesUnificadas = DB::table('actividades')->where('comentario', $request-> comentario)->get();
                //dd($actividadesUnificadas,$nombreArchivos,$actividad->id);

            foreach($actividadesUnificadas as $actividadesUnificadas){
                $array = explode(",", $nombreArchivos);
                        
                    if($actividadesUnificadas->id!=$actividad->id){
                        
                        
                        foreach ($array as $array) {
                           //dd('entre al 2 '); 
                            $archivoUnificado = new Archivo;
                            //dd('estoy 1');
                            $archivoUnificado-> nombre_archivo= $array;
                            //dd('estoy 2', $array);
                            $archivoUnificado-> actividad_id= $actividadesUnificadas->id;
                            //dd('estoy 3', $actividadesUnificadas->id);
                            $archivoUnificado->save();
                            //dd('Guardado 2');
                        }

                    }
                    //dd("no entre en el if");
            }


        Flash::success("Se ha creado la actividad exitosamente y ha finalizado la Propuesta");
        if($tipo_fuente == 1){
            return redirect()->route('verSolucion.despliegue',[1,$idSolucion]);
        }else{
            return redirect()->route('verSolucion.consejo',[1, $idSolucion]);
        }
    }


    //Inicio Aperturar propuestas

        public function vistaAperturarPropuesta($idSolucion){

        Flash::success("Registre la Actividad para APERTURAR la Propuesta");

         //dd('hola');
        $solucion = Solucion::find($idSolucion);

        $solucion_estado = DB::select("SELECT estado_solucion.* FROM solucions
                                INNER JOIN actor_solucion asl ON asl.solucion_id = solucions.id
                                INNER JOIN estado_solucion on estado_solucion.id = solucions.estado_id
                                INNER JOIN user_institucions ui ON ui.institucion_id = asl.institucion_id
                                WHERE asl.solucion_id = ".$idSolucion." ;");



        $tipo_fuente = Auth::user()->tipo_fuente;

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->orderBy('created_at','ASC')->get();

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->where('tipo_actor','=',1)
                                            ->get();
                                            //->orderBy('tipo_actor','ASC')->get();
        
        return view('institucion.actividades.createAccionAperturarPropuesta')->with(["solucion"=>$solucion,
            "actividades"=>$actividades,
            "actoresSoluciones"=>$actoresSoluciones,
            "tipo_fuente"=>$tipo_fuente,
            "solucion_estado"=>$solucion_estado]);
    }

    public function AperturarPropuestaSolucion(Request $request, $tipo_fuente, $idSolucion){

        //dd('uno');

        $Solucion = Solucion::find($idSolucion);
        $Solucion-> estado_id = 3;
        $Solucion-> save();

        $actividad = new Actividad;
        $actividad-> comentario = "Reapertura por motivo".$request-> comentario;
        $actividad-> solucion_id = $idSolucion;
        $actividad-> ejecutor_id = $request-> institucion_id;
        $actividad-> tipo_fuente = $tipo_fuente;
        if( isset($request-> fecha) ){
            $actividad-> fecha_inicio = $request-> fecha. " 00:00:00";
            if($request->tipo_fuente_id ==1){
                    $solucion = Solucion::find($idSolucion);
                    $solucion-> estado_id = 3; // 3 = Propuesta en desarrollo
                    $solucion->save();
                }
                
        }

        $actividad-> save();

        $actividadcreada = DB::table('actividades')->where('comentario', $request-> comentario)->first();
            $solucionAsignada = Solucion::find($idSolucion);
            
            //dd($actividadcreada->fecha_inicio,$solucionAsignada->pajustada_id,$SolucionesUnificadas);
            
            if($solucionAsignada->pajustada_id>0){
                
            $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $solucionAsignada->pajustada_id)->get();
            //dd($SolucionesUnificadas);
            foreach($SolucionesUnificadas as $SolucionesUnificadas){

                //var_dump($SolucionesUnificadas->id);
                    if($SolucionesUnificadas->id!=$idSolucion){

                        $SolucionUnificadaFinalizado = Solucion::find($SolucionesUnificadas->id);
                        $SolucionUnificadaFinalizado-> estado_id = 3;
                        $SolucionUnificadaFinalizado-> save();
                        //dd('entre al if');
                        $actividadUnificada=new Actividad;
                        $actividadUnificada-> fecha_inicio = $actividadcreada->fecha_inicio;
                        $actividadUnificada-> comentario   = $actividadcreada->comentario;
                        $actividadUnificada-> solucion_id = $SolucionesUnificadas->id;
                        $actividadUnificada-> tipo_fuente = $actividadcreada->tipo_fuente;
                        $actividadUnificada-> ejecutor_id = $actividadcreada->ejecutor_id;
                        $actividadUnificada-> save();

                        
                    }
                    //dd("no entre en el if");
            }
            }


         $nombreArchivos="";   

        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {

                $nombreArchivo = $file->getClientOriginalName();
                $nombreArchivo = strtotime("now")."_despliegue_".$idSolucion."_-_".$nombreArchivo;     // agregamos la fecha

                $archivo = new Archivo;
                $archivo-> nombre_archivo= $nombreArchivo;
                $archivo-> actividad_id= $actividad->id;
                $archivo->save();
                $nombreArchivos.=$nombreArchivo.",";
                /*$file = $request->file('imagen');*/
                \Storage::disk('local3')->put($nombreArchivo,  \File::get($file) );
            }
        }

        $nombreArchivos=substr($nombreArchivos,0,-1);
        //dd($nombreArchivos);
        

                $actividadesUnificadas = DB::table('actividades')->where('comentario', $request-> comentario)->get();
                //dd($actividadesUnificadas,$nombreArchivos,$actividad->id);

            foreach($actividadesUnificadas as $actividadesUnificadas){
                $array = explode(",", $nombreArchivos);
                        
                    if($actividadesUnificadas->id!=$actividad->id){
                        
                        
                        foreach ($array as $array) {
                           //dd('entre al 2 '); 
                            $archivoUnificado = new Archivo;
                            //dd('estoy 1');
                            $archivoUnificado-> nombre_archivo= $array;
                            //dd('estoy 2', $array);
                            $archivoUnificado-> actividad_id= $actividadesUnificadas->id;
                            //dd('estoy 3', $actividadesUnificadas->id);
                            $archivoUnificado->save();
                            //dd('Guardado 2');
                        }

                    }
                    //dd("no entre en el if");
            }


        Flash::success("La apertura de ha realizado exitosamente");
        
        return redirect('/consejo-sectorial/home');
        
    }

    //Fin Aperturar propuestas


    public function verActividadesConsejo($tipo_actor, $idSolucion){

        if( $tipo_actor != 1 && $tipo_actor != 2 ){
            return abort(404);
        }

        $solucion = DB::select("SELECT pajustadas.* FROM pajustadas
                                INNER JOIN solucions ON pajustadas.id = solucions.pajustada_id
                                INNER JOIN actor_solucion ON actor_solucion.solucion_id = pajustadas.id
                                WHERE actor_solucion.user_id = ".Auth::user()->id." AND actor_solucion.solucion_id = ".$idSolucion."
                                AND actor_solucion.tipo_actor = ".$tipo_actor."
                                ;");

        $this->notFound($solucion);  //REDIRECCIONA AL ERROR 404  SI EL OBJETO NO EXISTE

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 2)
                                ->orderBy('created_at','DESC')->get();

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->where('tipo_fuente','=',2)
                                            ->orderBy('tipo_actor','ASC')->get();

        return view('institucion.actividades.solucionCCPT')->with(["actoresSoluciones"=>$actoresSoluciones,
                                                            "solucion"=>$solucion[0],
                                                            "actividades"=>$actividades,
                                                            "tipo_actor"=>$tipo_actor
                                                        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDespliegue($idSolucion)
    {
        $solucion = Solucion::find($idSolucion);

        $tipo_fuente = Auth::user()->tipo_fuente;

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->orderBy('created_at','ASC')->get();

        
        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->orderBy('tipo_actor','ASC')->get();

        //dd($actividades);

        return view('institucion.actividades.createDesp')->with(["solucion"=>$solucion,
                                                                "actividades"=>$actividades,
                                                                "actoresSoluciones"=>$actoresSoluciones,
                                                                "tipo_fuente"=>$tipo_fuente]);
    }

    public function createDespliegueAdmin($idSolucion)
    {
        $solucion = Solucion::find($idSolucion);

        $tipo_fuente = Auth::user()->tipo_fuente;

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 1)
                                ->orderBy('created_at','ASC')->get();

        // $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
        //                                     ->where('tipo_fuente','=',1)
        //                                     ->orderBy('tipo_actor','ASC')->get();

        $actoresSoluciones = ActorSolucion::select('institucions.id','institucions.nombre_institucion','actor_solucion.*')
                                            ->join('institucions', 'institucions.id','=','actor_solucion.institucion_id')
                                            ->where('actor_solucion.solucion_id','=',$idSolucion)
                                            ->get();
        //dd($actoresSoluciones);

        return view('admin.actores.actividades.createDesp')->with(["solucion"=>$solucion,"actividades"=>$actividades,"actoresSoluciones"=>$actoresSoluciones,"tipo_fuente"=>$tipo_fuente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createConsejo($idSolucion)
    {
        $pajustada = Pajustada::find($idSolucion);

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 2)
                                ->orderBy('created_at','ASC')->get();

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->where('tipo_fuente','=',2)
                                            ->orderBy('tipo_actor','ASC')->get();

        return view('institucion.actividades.createCCPT')->with(["pajustada"=>$pajustada,"actividades"=>$actividades,"actoresSoluciones"=>$actoresSoluciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveActividad(Request $request, $tipo_actor, $idSolucion)
    {
       //dd($request->institucion_id);

        $tipo_fuente = Auth::user()->tipo_fuente;
        //dd($tipo_actor);
        $actividad = new Actividad;
        $actividad-> comentario = $request->comentario;
        $actividad-> solucion_id = $idSolucion;
        $actividad-> ejecutor_id = $request->institucion_id;
        $actividad-> tipo_fuente = $tipo_actor; 
        

        //dd($request->fecha);
        if( isset($request-> fecha) ){
            $actividad-> fecha_inicio = $request-> fecha. " 00:00:00";
            if($request->tipo_fuente_id ==1){
                    $solucion = Solucion::find($idSolucion);
                    $solucion-> estado_id = 3; // 3 = Propuesta en desarrollo
                    $solucion->save();
                }
        }
        
        $actividad-> save();
        //dd('guardo');
        $actividadGuardada = DB::select('SELECT * from actividades where solucion_id ='.$idSolucion.' and tipo_fuente = "'.$tipo_actor.'"');
        //dd($actividadGuardada[0] ->id);

        $idTabla = $actividadGuardada[0] ->id;  
        $nombreTabla = "actividades";
        $proceso = "insert";
        $usuario = Auth::user()->id;
        $cedula = Auth::user()->cedula;
        $observacion = "Agregar actividad en la propuesta";
        AuditoriaController::guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion);


        //dd('uno');
         $actividadcreada = DB::table('actividades')->where('comentario', $request-> comentario)->first();
            $solucionAsignada = Solucion::find($idSolucion);
            
            //dd($actividadcreada->fecha_inicio,$solucionAsignada->pajustada_id,$SolucionesUnificadas);
            
            if($solucionAsignada->pajustada_id>0){

            $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $solucionAsignada->pajustada_id)->get();
            //dd($SolucionesUnificadas);
            foreach($SolucionesUnificadas as $SolucionesUnificadas){
                //var_dump($SolucionesUnificadas->id);
                    if($SolucionesUnificadas->id!=$idSolucion){
                        //dd('entre al if');
                        $actividadUnificada=new Actividad;
                        $actividadUnificada-> fecha_inicio = $actividadcreada->fecha_inicio;
                        $actividadUnificada-> comentario   = $actividadcreada->comentario;
                        $actividadUnificada-> solucion_id = $SolucionesUnificadas->id;
                        $actividadUnificada-> tipo_fuente = $actividadcreada->tipo_fuente;
                        $actividadUnificada-> ejecutor_id = $actividadcreada->ejecutor_id;
                        $actividadUnificada-> save();

                        $solucionU = Solucion::find($SolucionesUnificadas->id);
                        $solucionU-> estado_id = 3; // 3 = Propuesta en desarrollo
                        $solucionU->save();
                    }
                    //dd("no entre en el if");
            }
            }
        //dd('uno');
        $nombreArchivos="";
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {

                $nombreArchivo = $file->getClientOriginalName();
                $nombreArchivo = strtotime("now")."_despliegue_".$idSolucion."_-_".$nombreArchivo;     // agregamos la fecha

                $archivo = new Archivo;
                $archivo-> nombre_archivo= $nombreArchivo;
                $archivo-> actividad_id= $actividad->id;
                $archivo->save();
                $nombreArchivos.=$nombreArchivo.",";

                /*$file = $request->file('imagen');*/
                \Storage::disk('local3')->put($nombreArchivo,  \File::get($file) );
            }
        }
        //dd($nombreArchivos);
        $nombreArchivos=substr($nombreArchivos,0,-1);
        //dd($nombreArchivos);
        

                $actividadesUnificadas = DB::table('actividades')->where('comentario', $request-> comentario)->get();
                //dd($actividadesUnificadas,$nombreArchivos,$actividad->id);

            foreach($actividadesUnificadas as $actividadesUnificadas){
                $array = explode(",", $nombreArchivos);
                        
                    if($actividadesUnificadas->id!=$actividad->id){
                        
                        
                        foreach ($array as $array) {
                           //dd('entre al 2 '); 
                            $archivoUnificado = new Archivo;
                            //dd('estoy 1');
                            $archivoUnificado-> nombre_archivo= $array;
                            //dd('estoy 2', $array);
                            $archivoUnificado-> actividad_id= $actividadesUnificadas->id;
                            //dd('estoy 3', $actividadesUnificadas->id);
                            $archivoUnificado->save();
                            //dd('Guardado 2');
                        }

                    }
                    //dd("no entre en el if");
            }


        Flash::success("Se ha creado la actividad exitosamente");
        
        if($tipo_actor == 1){
               
            return redirect()->route('verSolucion.despliegue',[$tipo_actor,$idSolucion]);
        }else{
            return redirect()->route('verSolucion.consejo',[$tipo_actor, $idSolucion]);
        }

        if($tipo_actor == 2){
           // dd($tipo_fuente);
            return redirect()->route('verSolucion.despliegue',[$tipo_actor,$idSolucion]);
        }else{
            return redirect()->route('verSolucion.consejo',[$tipo_actor, $idSolucion]);
        }

    }
     public function saveActividadAdmin(Request $request, $tipo_actor, $idSolucion) 
    { 
        $tipo_fuente = Auth::user()->tipo_fuente;
        $actividad = new Actividad;
        $actividad-> comentario = $request-> comentario;
        $actividad-> solucion_id = $idSolucion;
        $actividad-> ejecutor_id = $request-> institucion_id;
        $actividad-> tipo_fuente = $tipo_actor; 
        

        //dd($request->tipo_fuente_id);
        if( isset($request-> fecha) ){
            $actividad-> fecha_inicio = $request-> fecha. " 00:00:00";
            if($request->tipo_fuente_id ==1){
                    $solucion = Solucion::find($idSolucion);
                    $solucion-> estado_id = 3; // 3 = Propuesta en desarrollo
                    $solucion->save();
                }
            if($request->tipo_fuente_id ==2){
                
                $solucion = Solucion::find($idSolucion);
                $solucion-> estado_id = 3; // 3 = Propuesta en desarrollo
                $solucion->save();
            }

            $solucionGuardada = DB::select('SELECT * from solucions where id ='.$idSolucion.'');
   $idTabla = $solucionGuardada[0] ->id;  
   $nombreTabla = "solucions";
   $proceso = "update";
   $usuario = Auth::user()->name;
   $cedula = Auth::user()->cedula;
   $observacion = "Se agregan actividades";
   AuditoriaController::guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion);

        }
        

        // dd($actividad);

            Mail::send('emails.correoRegistroActividad', ["solucion"=>$solucion ,"actividad" => $actividad], function($msj) {
            $msj->to('alex.dominguez@secom.gob.ec', '')->subject('Inteligencia Productiva - Notificación de registro una Actvidad');
                //$msj->to( $correo);
                
            $msj->from('inteligencia.contacto@gmail.com','Plataforma de Dialogo');
        });

        dd("hasta aca");

        $actividad-> save();

        $actividadcreada = DB::table('actividades')->where('comentario', $request-> comentario)->first();
        $solucionAsignada = Solucion::find($idSolucion);
            
            //dd($actividadcreada->fecha_inicio,$solucionAsignada->pajustada_id,$SolucionesUnificadas);
            
            if($solucionAsignada->pajustada_id>0){

            $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $solucionAsignada->pajustada_id)->get();
            //dd($SolucionesUnificadas);
            foreach($SolucionesUnificadas as $SolucionesUnificadas){
                //var_dump($SolucionesUnificadas->id);
                    if($SolucionesUnificadas->id!=$idSolucion){
                        //dd('entre al if');
                        $actividadUnificada=new Actividad;
                        $actividadUnificada-> fecha_inicio = $actividadcreada->fecha_inicio;
                        $actividadUnificada-> comentario   = $actividadcreada->comentario;
                        $actividadUnificada-> solucion_id = $SolucionesUnificadas->id;
                        $actividadUnificada-> tipo_fuente = $actividadcreada->tipo_fuente;
                        $actividadUnificada-> ejecutor_id = $actividadcreada->ejecutor_id;
                        $actividadUnificada-> save();

                        $solucionU = Solucion::find($SolucionesUnificadas->id);
                        $solucionU-> estado_id = 3; // 3 = Propuesta en desarrollo
                        $solucionU->save();
                    }
                    //dd("no entre en el if");
            }
            }
        
        $nombreArchivos="";
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {

                $nombreArchivo = $file->getClientOriginalName();
                $nombreArchivo = strtotime("now")."_despliegue_".$idSolucion."_-_".$nombreArchivo;     // agregamos la fecha

                $archivo = new Archivo;
                $archivo-> nombre_archivo= $nombreArchivo;
                $archivo-> actividad_id= $actividad->id;
                $archivo->save();
                $nombreArchivos.=$nombreArchivo.",";

                /*$file = $request->file('imagen');*/
                \Storage::disk('local3')->put($nombreArchivo,  \File::get($file) );
            }
        }
        //dd($nombreArchivos);
        $nombreArchivos=substr($nombreArchivos,0,-1);
        //dd($nombreArchivos);
        

                $actividadesUnificadas = DB::table('actividades')->where('comentario', $request-> comentario)->get();
                //dd($actividadesUnificadas,$nombreArchivos,$actividad->id);

            foreach($actividadesUnificadas as $actividadesUnificadas){
                $array = explode(",", $nombreArchivos);
                        
                    if($actividadesUnificadas->id!=$actividad->id){
                        
                        
                        foreach ($array as $array) {
                           //dd('entre al 2 '); 
                            $archivoUnificado = new Archivo;
                            //dd('estoy 1');
                            $archivoUnificado-> nombre_archivo= $array;
                            //dd('estoy 2', $array);
                            $archivoUnificado-> actividad_id= $actividadesUnificadas->id;
                            //dd('estoy 3', $actividadesUnificadas->id);
                            $archivoUnificado->save();
                            //dd('Guardado 2');
                        }

                    }
                    //dd("no entre en el if");
            }


        Flash::success("Se ha creado la actividad exitosamente");

        return redirect('/admin/actores/asignados');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = provincia::find($id);

        return view('admin.provincias.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $provincia = provincia::find($id);
        $this ->validate($request,[
            'nombre_provincia' =>'required'
        ]);
        $provincia->nombre_provincia = $request->nombre_provincia;
        $provincia->save();
        return redirect('provincias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function verActividadesDespliegueConsejo($tipo_actor, $idSolucion){

      // dd('uno');


        $solucion = DB::select("SELECT solucions.*, estado_solucion.nombre_estado FROM solucions
                                INNER JOIN actor_solucion asl ON asl.solucion_id = solucions.id
                                INNER JOIN estado_solucion on estado_solucion.id = solucions.estado_id
                                INNER JOIN user_institucions ui ON ui.institucion_id = asl.institucion_id
                                WHERE asl.solucion_id = ".$idSolucion." ;");

        
        $this->notFound($solucion);  //REDIRECCIONA AL ERROR 404  SI EL OBJETO NO EXISTE

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 1)
                                ->orderBy('created_at','DESC')->get();


        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->orderBy('tipo_actor','ASC')->get();

        //dd($tipo_actor);


        $tipo_fuente = Auth::user()->tipo_fuente; 

        return view('institucion.actividades.solucionConsejo')->with(["actoresSoluciones"=>$actoresSoluciones,
                                                            "solucion"=>$solucion[0],
                                                            "actividades"=>$actividades,
                                                            "tipo_actor"=>$tipo_actor,
                                                            "tipo_fuente"=>$tipo_fuente
                                                        ]);
    }

    public function vistaEditParametrosCumplimiento($idSolucion){

        $tipo_fuente = Auth::user()->tipo_fuente;
        
        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->where('tipo_fuente','=', 1)
                                ->orderBy('created_at','DESC')->get();
        $solucion = DB::table('solucions')->where('id', $idSolucion )->first();


        //dd($solucion);
        return view('institucion.actividades.editParametrosCumplimiento')->with(["idSolucion"=>$idSolucion,"tipo_fuente"=>$tipo_fuente,"actividades"=>$actividades,"solucion"=>$solucion]);

    }

    public function vistaDesestimarPropuesta($idSolucion){

         Flash::success("Registre la el motivo para dar por desestimada la Propuesta");

         //dd('hola');
        $solucion = Solucion::find($idSolucion);

        $tipo_fuente = Auth::user()->tipo_fuente;

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->orderBy('created_at','ASC')->get();

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->orderBy('tipo_actor','ASC')->get();
        
        return view('institucion.actividades.createAccionDesestimarPropuesta')->with(["solucion"=>$solucion,
                                                            "actividades"=>$actividades,
                                                            "actoresSoluciones"=>$actoresSoluciones,
                                                            "tipo_fuente"=>$tipo_fuente]);
    }

    public function desestimarPropuestaSolucion(Request $request, $tipo_fuente, $idSolucion){

        $Solucion = Solucion::find($idSolucion);
        $Solucion-> estado_id = 5;
        $Solucion-> save();

        $actividad = new Actividad;
        $actividad-> comentario = 'Propuesta desestimada por: '.$request-> comentario;
        $actividad-> solucion_id = $idSolucion;
        $actividad-> ejecutor_id = $request-> institucion_id;
        $actividad-> tipo_fuente = $tipo_fuente;
        if( isset($request-> fecha) ){
            $actividad-> fecha_inicio = $request-> fecha. " 00:00:00";
        }

        $actividad-> save();

        $actividadcreada = DB::table('actividades')->where('comentario', $request-> comentario)->first();
        $solucionAsignada = Solucion::find($idSolucion);
            
        //dd($actividadcreada->fecha_inicio,$solucionAsignada->pajustada_id,$SolucionesUnificadas);
            
        // if($solucionAsignada->pajustada_id>0){
                
        //     $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $solucionAsignada->pajustada_id)->get();
        //     //dd($SolucionesUnificadas);
        //     foreach($SolucionesUnificadas as $SolucionesUnificadas){

        //         //var_dump($SolucionesUnificadas->id);
        //             if($SolucionesUnificadas->id!=$idSolucion){

        //                 $SolucionUnificadaFinalizado = Solucion::find($SolucionesUnificadas->id);
        //                 $SolucionUnificadaFinalizado-> estado_id = 4;
        //                 $SolucionUnificadaFinalizado-> save();
        //                 //dd('entre al if');
        //                 $actividadUnificada=new Actividad;
        //                 $actividadUnificada-> fecha_inicio = $actividadcreada->fecha_inicio;
        //                 $actividadUnificada-> comentario   = $actividadcreada->comentario;
        //                 $actividadUnificada-> solucion_id = $SolucionesUnificadas->id;
        //                 $actividadUnificada-> tipo_fuente = $actividadcreada->tipo_fuente;
        //                 $actividadUnificada-> ejecutor_id = $actividadcreada->ejecutor_id;
        //                 $actividadUnificada-> save();

                        
        //             }
        //             //dd("no entre en el if");
        //     }
        // }


        $nombreArchivos="";   

        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {

                $nombreArchivo = $file->getClientOriginalName();
                $nombreArchivo = strtotime("now")."_despliegue_".$idSolucion."_-_".$nombreArchivo;     // agregamos la fecha

                $archivo = new Archivo;
                $archivo-> nombre_archivo= $nombreArchivo;
                $archivo-> actividad_id= $actividad->id;
                $archivo->save();
                $nombreArchivos.=$nombreArchivo.",";
                /*$file = $request->file('imagen');*/
                \Storage::disk('local3')->put($nombreArchivo,  \File::get($file) );
            }
        }

        $nombreArchivos=substr($nombreArchivos,0,-1);
        //dd($nombreArchivos);
        

                $actividadesUnificadas = DB::table('actividades')->where('comentario', $request-> comentario)->get();
                //dd($actividadesUnificadas,$nombreArchivos,$actividad->id);

            foreach($actividadesUnificadas as $actividadesUnificadas){
                $array = explode(",", $nombreArchivos);
                        
                    if($actividadesUnificadas->id!=$actividad->id){
                        
                        
                        foreach ($array as $array) {
                           //dd('entre al 2 '); 
                            $archivoUnificado = new Archivo;
                            //dd('estoy 1');
                            $archivoUnificado-> nombre_archivo= $array;
                            //dd('estoy 2', $array);
                            $archivoUnificado-> actividad_id= $actividadesUnificadas->id;
                            //dd('estoy 3', $actividadesUnificadas->id);
                            $archivoUnificado->save();
                            //dd('Guardado 2');
                        }

                    }
                    //dd("no entre en el if");
            }


        Flash::success("Se ha creado la actividad exitosamente y ha finalizado la Propuesta");
        if($tipo_fuente == 1){
            return redirect()->route('verSolucion.despliegue',[1,$idSolucion]);
        }else{
            return redirect()->route('verSolucion.consejo',[1, $idSolucion]);
        }
    }

    public function vistaConflictoPropuesta($idSolucion){

         Flash::success("Registre el motivo del conflicto la Propuesta");

         //dd('hola');
        $solucion = Solucion::find($idSolucion);

        $tipo_fuente = Auth::user()->tipo_fuente;

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
                                ->orderBy('created_at','ASC')->get();

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
                                            ->orderBy('tipo_actor','ASC')->get();
        
        return view('institucion.actividades.createAccionConflictoPropuesta')->with(["solucion"=>$solucion,
                                                            "actividades"=>$actividades,
                                                            "actoresSoluciones"=>$actoresSoluciones,
                                                            "tipo_fuente"=>$tipo_fuente]);
    }


    public function conflictoPropuestaSolucion(Request $request, $tipo_fuente, $idSolucion){

        $Solucion = Solucion::find($idSolucion);
        $Solucion-> estado_id = 6;
        $Solucion-> save();

        $actividad = new Actividad;
        $actividad-> comentario = 'Propuesta en conflicto por: '.$request-> comentario;
        $actividad-> solucion_id = $idSolucion;
        $actividad-> ejecutor_id = $request-> institucion_id;
        $actividad-> tipo_fuente = $tipo_fuente;
        if( isset($request-> fecha) ){
            $actividad-> fecha_inicio = $request-> fecha. " 00:00:00";
        }

        $actividad-> save();

        $actividadcreada = DB::table('actividades')->where('comentario', $request-> comentario)->first();
        $solucionAsignada = Solucion::find($idSolucion);
            
        //dd($actividadcreada->fecha_inicio,$solucionAsignada->pajustada_id,$SolucionesUnificadas);
            
        // if($solucionAsignada->pajustada_id>0){
                
        //     $SolucionesUnificadas = DB::table('solucions')->where('pajustada_id', $solucionAsignada->pajustada_id)->get();
        //     //dd($SolucionesUnificadas);
        //     foreach($SolucionesUnificadas as $SolucionesUnificadas){

        //         //var_dump($SolucionesUnificadas->id);
        //             if($SolucionesUnificadas->id!=$idSolucion){

        //                 $SolucionUnificadaFinalizado = Solucion::find($SolucionesUnificadas->id);
        //                 $SolucionUnificadaFinalizado-> estado_id = 4;
        //                 $SolucionUnificadaFinalizado-> save();
        //                 //dd('entre al if');
        //                 $actividadUnificada=new Actividad;
        //                 $actividadUnificada-> fecha_inicio = $actividadcreada->fecha_inicio;
        //                 $actividadUnificada-> comentario   = $actividadcreada->comentario;
        //                 $actividadUnificada-> solucion_id = $SolucionesUnificadas->id;
        //                 $actividadUnificada-> tipo_fuente = $actividadcreada->tipo_fuente;
        //                 $actividadUnificada-> ejecutor_id = $actividadcreada->ejecutor_id;
        //                 $actividadUnificada-> save();

                        
        //             }
        //             //dd("no entre en el if");
        //     }
        // }


        $nombreArchivos="";   

        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {

                $nombreArchivo = $file->getClientOriginalName();
                $nombreArchivo = strtotime("now")."_despliegue_".$idSolucion."_-_".$nombreArchivo;     // agregamos la fecha

                $archivo = new Archivo;
                $archivo-> nombre_archivo= $nombreArchivo;
                $archivo-> actividad_id= $actividad->id;
                $archivo->save();
                $nombreArchivos.=$nombreArchivo.",";
                /*$file = $request->file('imagen');*/
                \Storage::disk('local3')->put($nombreArchivo,  \File::get($file) );
            }
        }

        $nombreArchivos=substr($nombreArchivos,0,-1);
        //dd($nombreArchivos);
        

                $actividadesUnificadas = DB::table('actividades')->where('comentario', $request-> comentario)->get();
                //dd($actividadesUnificadas,$nombreArchivos,$actividad->id);

            foreach($actividadesUnificadas as $actividadesUnificadas){
                $array = explode(",", $nombreArchivos);
                        
                    if($actividadesUnificadas->id!=$actividad->id){
                        
                        
                        foreach ($array as $array) {
                           //dd('entre al 2 '); 
                            $archivoUnificado = new Archivo;
                            //dd('estoy 1');
                            $archivoUnificado-> nombre_archivo= $array;
                            //dd('estoy 2', $array);
                            $archivoUnificado-> actividad_id= $actividadesUnificadas->id;
                            //dd('estoy 3', $actividadesUnificadas->id);
                            $archivoUnificado->save();
                            //dd('Guardado 2');
                        }

                    }
                    //dd("no entre en el if");
            }


        Flash::success("Se ha creado exitosamente y a cambiado a estado CONFLICTO la Propuesta");
        if($tipo_fuente == 1){
            return redirect()->route('verSolucion.despliegue',[1,$idSolucion]);
        }else{
            return redirect()->route('verSolucion.consejo',[1, $idSolucion]);
        }
    }





}
