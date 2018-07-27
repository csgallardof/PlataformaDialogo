<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
use Laracasts\Flash\Flash;

use App\TipoDialogo;
use App\MesaDialogo;
use App\Participante;
use App\TipoParticipante;
use App\Solucion;
use App\Sector;
use App\Institucion;
use App\ConsejoSectorial;
use App\Zona;
use App\Provincia;
use App\Canton;
use App\Parroquia;
use App\User;
use App\PalabrasClave;
use App\ActorSolucion;
use App\EstadoPublicacion;
use App\IndiceCompetitividad;
use App\PlanNacional;

use File;
use DB;
use PHPExcel; 
use PHPExcel_IOFactory; 
use PHPExcel_Shared_Date;

use Mail;

class MesaDialogoController extends Controller
{

    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mesas_dialogo = MesaDialogo::search($request->parametro)->orderBy('id','DESC')->paginate(15);
        
        return view('admin.mesadialogo.home')->with(["mesasdialogo"=>$mesas_dialogo]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposDialogo= TipoDialogo::all();
        $instituciones= Institucion::all();
        $consejosSectoriales= ConsejoSectorial::all();
        $zonas= Zona::all();
        $sectores= Sector::all();

        return view('admin.mesadialogo.create')->with(["nuevo"=> true,
                                                    "tiposDialogo"=>$tiposDialogo,
                                                    "instituciones"=>$instituciones,
                                                    "consejosSectoriales"=>$consejosSectoriales,
                                                    "sectores"=>$sectores,
                                                    "zonas"=>$zonas
                                                    ]); 
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
        $item = MesaDialogo::find($id);
        //Obtenemos las listas que se desplegarán en los combos del formulario
        $tiposDialogo= TipoDialogo::all();
        $instituciones= Institucion::all();
        $consejosSectoriales= ConsejoSectorial::all();
        $zonas= Zona::all();
        if(!is_null($item->zona_id)){
            $provincias= Provincia::provincias($item->zona_id);
        }
        if(!is_null($item->provincia_id)){
            $cantones= Canton::cantones($item->provincia_id);                
        }
        if(!is_null($item->canton_id)){
            $parroquias= Parroquia::parroquias($item->canton_id);                
        }
        $sectores= Sector::all();
        //Enviamos a la vista todos los valores requeridos para la edición
        return view('admin.mesadialogo.edit', compact('item'))->with(["nuevo"=>false,
                                                                    "tiposDialogo"=>$tiposDialogo,
                                                                    "instituciones"=>$instituciones,
                                                                    "consejosSectoriales"=>$consejosSectoriales,
                                                                    "sectores"=>$sectores,
                                                                    "zonas"=>$zonas,
                                                                    "provincias"=>$provincias,
                                                                    "cantones"=>$cantones,
                                                                    "parroquias"=>$parroquias
                                                                    ]); 
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
        try{

            $mesa_dialogo = MesaDialogo::find($id);
            
            $mesa_dialogo->nombre = $request->nombre;        
            $mesa_dialogo->tipo_dialogo_id = $request->tipo_dialogo_id;
            $mesa_dialogo->organizador_id = $request->organizador_id;
            $mesa_dialogo->consejo_sectorial_id = $request->consejo_sectorial_id;
            $mesa_dialogo->lider = $request->lider;
            $mesa_dialogo->coordinador = $request->coordinador;
            $mesa_dialogo->sistematizador = $request->sistematizador;
            $mesa_dialogo->zona_id = $request->zona_id;
            $mesa_dialogo->provincia_id = $request->provincia_id;
            $mesa_dialogo->canton_id = $request->canton_id;
            $mesa_dialogo->parroquia_id = $request->parroquia_id;
            $mesa_dialogo->lugar = $request->lugar;
            $mesa_dialogo->organizacion = $request->organizacion;
            $mesa_dialogo->fecha = $request->fecha;
            $mesa_dialogo->sector_id = $request->sector_id;
            $mesa_dialogo->descripcion = $request->descripcion;
          
            $mesa_dialogo->save();

            Flash::success("La información de la mesa de dialogo ha sido guardada exitosamente.");

            return redirect('/admin/mesadialogo');

        } catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesa_dialogo = MesaDialogo::find($id)->delete();
        return redirect('/admin/mesadialogo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //dd($request->nuevo);
        //Obtenemos el usuario autenticado
        $user = Auth::user();
        //Guarda la información de la nueva mesa de dialogo
        if($request->nuevo == true ){
            
            $mesa_dialogo = new MesaDialogo;            
            $mesa_dialogo->nombre = $request->nombre;        
            $mesa_dialogo->tipo_dialogo_id = $request->tipo_dialogo_id;
            $mesa_dialogo->organizador_id = $request->organizador_id;
            $mesa_dialogo->consejo_sectorial_id = $request->consejo_sectorial_id;
            $mesa_dialogo->lider = $request->lider;
            $mesa_dialogo->coordinador = $request->coordinador;
            $mesa_dialogo->sistematizador = $request->sistematizador;
            $mesa_dialogo->zona_id = $request->zona_id;
            $mesa_dialogo->provincia_id = $request->provincia_id;
            $mesa_dialogo->canton_id = $request->canton_id;
            $mesa_dialogo->parroquia_id = $request->parroquia_id;
            $mesa_dialogo->lugar = $request->lugar;
            $mesa_dialogo->organizacion = $request->organizacion;
            $mesa_dialogo->fecha = $request->fecha;
            $mesa_dialogo->sector_id = $request->sector_id;
            $mesa_dialogo->descripcion = $request->descripcion;
            $mesa_dialogo->user_id = $user->id;
          
            $mesa_dialogo->save();

            Flash::success("La mesa de dialogo ha sido creada exitosamente.");

            return redirect('/admin/mesadialogo');
        }// Guarda la información de la matriz Excel
        else{
            try{
                DB::beginTransaction();

                $aux = json_decode($request->mesa_dialogo, true);

               // dd($aux);
                
                //Toma el objeto de la mesa validado y guarda en la bdd    
                $mesa_dialogo = new MesaDialogo;
                $mesa_dialogo->nombre = $aux['nombre'];        
                $mesa_dialogo->tipo_dialogo_id = $aux['tipo_dialogo_id'];
                $mesa_dialogo->organizador_id = $aux['organizador_id'];
                if(isset($aux['consejo_sectorial_id'])){
                    $mesa_dialogo->consejo_sectorial_id = $aux['consejo_sectorial_id'];
                }
                if(isset($aux['lider'])){
                    $mesa_dialogo->lider = $aux['lider'];
                }
                if(isset($aux['coordinador'])){
                    $mesa_dialogo->coordinador = $aux['coordinador'];
                }
                if(isset($aux['sistematizador'])){
                    $mesa_dialogo->sistematizador = $aux['sistematizador'];
                }
                if(isset($aux['zona_id'])){
                    $mesa_dialogo->zona_id = $aux['zona_id'];
                }
                if(isset($aux['provincia_id'])){
                    $mesa_dialogo->provincia_id = $aux['provincia_id'];
                }
                if(isset($aux['canton_id'])){
                    $mesa_dialogo->canton_id = $aux['canton_id'];
                }
                if(isset($aux['parroquia_id'])){
                    $mesa_dialogo->parroquia_id = $aux['parroquia_id'];
                }
                $mesa_dialogo->lugar = $aux['lugar'];
                if(isset($aux['organizacion'])){
                    $mesa_dialogo->organizacion = $aux['organizacion'];
                }
                $mesa_dialogo->fecha = $aux['fecha'];
                if(isset($aux['sector_id'])){
                    $mesa_dialogo->sector_id = $aux['sector_id'];
                }
                if(isset($aux['descripcion'])){
                    $mesa_dialogo->descripcion = $aux['descripcion'];
                }
                $mesa_dialogo->user_id = $user->id;
                
                $mesa_dialogo->save();
                
                //Toma la lista de objetos de participates y guarda en la bdd 
                $datos_participante = $request->datos_participante;
                if(isset($datos_participante)){
                    $datos_participante = Collection::make(json_decode($datos_participante, true));
                    foreach ($datos_participante as $participanteAux) {
                        $participante = new Participante;
                        $participante->mesa_dialogo_id = $mesa_dialogo->id;
                        if(isset($participanteAux['sector_id'])){
                            $participante->sector_id = $participanteAux['sector_id'];
                        }
                        if(isset($participanteAux['tipo_participante_id'])){
                            $participante->tipo_participante_id = $participanteAux['tipo_participante_id'];
                        }
                        if(isset($participanteAux['sector_empresa_id'])){
                            $participante->sector_empresa_id = $participanteAux['sector_empresa_id'];
                        }
                        $participante->nombres = $participanteAux['nombres'];
                        $participante->apellidos = $participanteAux['apellidos'];
                        $participante->email = $participanteAux['email'];
                        if(isset($participanteAux['celular'])){
                            $participante->celular = $participanteAux['celular'];
                        }
                        if(isset($participanteAux['telefono_ext'])){
                            $participante->telefono_ext = $participanteAux['telefono_ext'];
                        }
                        if(isset($participanteAux['empresa'])){
                            $participante->empresa = $participanteAux['empresa'];
                        }
                        if(isset($participanteAux['cargo'])){
                            $participante->cargo = $participanteAux['cargo'];
                        }
                        $participante->save();
                    }
                }

                //Toma la lista de objetos de propuestas (soluciones) y guarda en la bdd 
                $datos_solucion = $request->datos_solucion;
                if(isset($datos_solucion)){
                    $datos_solucion = Collection::make(json_decode($datos_solucion, true));
                   // dd($datos_solucion);
                    foreach ($datos_solucion as $solucionAux) {
                        $solucion = new Solucion;
                        $solucion->mesa_id = $mesa_dialogo->id;

                        if(isset($solucionAux['sipoc_id'])){
                            $solucion->sipoc_id = $solucionAux['sipoc_id'];
                        }
                        
                        $solucion->instrumento_id = $solucionAux['instrumento_id'];

                        $solucion->tipo_empresa_id = $solucionAux['tipo_empresa_id'];
                        $solucion->ambit_id = $solucionAux['ambit_id'];
                        $solucion->responsable_solucion = $solucionAux['responsable_solucion'];
                        if(isset($solucionAux['corresponsable_solucion'])){
                            $solucion->corresponsable_solucion = $solucionAux['corresponsable_solucion'];
                        }
                        if(isset($solucionAux['fecha_cumplimiento'])){
                            $solucion->fecha_cumplimiento = $solucionAux['fecha_cumplimiento'];
                        }
                        $solucion->problema_solucion= $solucionAux['problema_solucion'];
                        $solucion->verbo_solucion = $solucionAux['verbo_solucion'];
                        $solucion->sujeto_solucion = $solucionAux['sujeto_solucion'];
                        $solucion->complemento_solucion = $solucionAux['complemento_solucion'];
                        if(isset($solucionAux['plazo_cumplimiento'])){
                            $solucion->plazo_cumplimiento = $solucionAux['plazo_cumplimiento'];
                        }
                        if(isset($solucionAux['riesgos_cumplimiento'])){
                            $solucion->riesgos_cumplimiento = $solucionAux['riesgos_cumplimiento'];
                        }
                        if(isset($solucionAux['supuestos_cumplimientos'])){
                            $solucion->supuestos_cumplimientos = $solucionAux['supuestos_cumplimientos'];
                        }
                        $solucion->pajustada = $solucionAux['pajustada'];
                        $solucion->palabras_clave = $solucionAux['palabras_clave'];

                        $solucion->evento_id =  $solucionAux['evento_id'];
                        $solucion->lider_mesa_solucion = $solucionAux['lider_mesa_solucion'];
                        $solucion->sistematizador_solucion = $solucionAux['sistematizador_solucion'];
                        $solucion->provincia_id = $solucionAux['provincia_id'];
                        $solucion->coordinador_zonal_solucion = $solucionAux['coordinador_zonal_solucion'];
                        $solucion->tipo_fuente = $solucionAux['tipo_fuente'];
                        $solucion->pajustada_id= $solucionAux['pajustada_id'];
                        $solucion->thematic_id= $solucionAux['thematic_id'];
                        $solucion->vsector_id = $solucionAux['vsector_id'];
                        $solucion->solucion_ccpt = $solucionAux['solucion_ccpt'];
                        $solucion->estado_id = $solucionAux['estado_id'];
                        $solucion->ponderacion = $solucionAux['ponderacion'];
                        $solucion->propuesta_solucion = $solucionAux['propuesta_solucion'];
                        $solucion->zona_id = $solucionAux['zona_id'];
                        $solucion->lugar_solucion = $solucionAux['lugar_solucion'];
                        if(isset($solucionAux['fecha_solucion'])){
                            $solucion->fecha_solucion = $solucionAux['fecha_solucion'];
                        }
                        $solucion->indice_competitividad_id = $solucionAux['indice_competitividad_id'];
                        $solucion->politica_id = $solucionAux['politica_id'];
                        $solucion->plan_nacional_id = $solucionAux['plan_nacional_id'];
                        //dd($aux['organizador_id']);
                        
                        $InstitucionResponsableSiglas = DB::table('institucions')
                                                      ->where('siglas_institucion', $solucionAux['responsable_solucion'])
                                                      ->select('id', 'siglas_institucion')
                                                      ->first();
                        //echo date_format($date, 'Y-m-d H:i:s');

                        
                        $codigo_solucions = $InstitucionResponsableSiglas->siglas_institucion."-".$solucion->fecha_solucion.'-'.date('H'.'i'.'s');

                        //dd($codigo_solucions);

                        $solucion->cod_solucions = $codigo_solucions;

                        $solucion->save();

                       

                        //dd($codigo_solucions);
                        
                        /*RESPONSABLE*/
                        $InstitucionResponsableID = DB::table('institucions')
                                                      ->where('siglas_institucion', $solucionAux['responsable_solucion'])
                                                      ->select('id')
                                                      ->first();
                                                      //var_dump($InstitucionCoResponsableID->id);
                                    
                                    $institucionSolucion= new ActorSolucion;
                                    $institucionSolucion-> user_id = 0;
                                    $institucionSolucion-> institucion_id = $InstitucionResponsableID->id;
                                    $institucionSolucion-> solucion_id = $solucion->id;
                                    $institucionSolucion-> tipo_actor = 1;
                                    $institucionSolucion-> tipo_fuente = 0;
                                    $institucionSolucion-> save();

                        /*CORRESPONSABLES*/
                        if(isset($solucionAux['corresponsable_solucion'])){
                         $cadena = $solucionAux['corresponsable_solucion'];

                                $array = explode(","." ", $cadena);
                                
                                foreach ($array as $array) {
                                    //var_dump($array);
                                    
                                    $InstitucionCoResponsableID = DB::table('institucions')
                                                      ->where('siglas_institucion', $array)
                                                      ->select('id')
                                                      ->first();
                                                      //var_dump($InstitucionCoResponsableID->id);
                                    
                                    $institucionSolucion= new ActorSolucion;
                                    $institucionSolucion-> user_id = 0;
                                    $institucionSolucion-> institucion_id = $InstitucionCoResponsableID->id;
                                    $institucionSolucion-> solucion_id = $solucion->id;
                                    $institucionSolucion-> tipo_actor = 2;
                                    $institucionSolucion-> tipo_fuente = 0;
                                    $institucionSolucion-> save();

                                }
                            }

                        /*PALABRAS CLAVES*/
                        $cadenaPalabras = $solucionAux["palabras_clave"];
                            $arrayPalabras = explode(","." ", $cadenaPalabras);
                            
                            foreach ($arrayPalabras as $arrayPalabras) {
                               
                                
                                $solucionPalabraClave= new PalabrasClave;
                                $solucionPalabraClave-> nombre = $arrayPalabras;
                                $solucionPalabraClave-> solucion_id = $solucion->id;
                                $solucionPalabraClave-> save();

                                }


                    }
                  

                    

                }


                DB::commit();
                Flash::success("La información de la matriz ha sido guardada exitosamente.");
                //Consulta las mesas de dialogo y presenta la lista
                $mesas_dialogo = MesaDialogo::search($request->parametro)->orderBy('id','DESC')->paginate(15);
                return view('admin.mesadialogo.home')->with(["mesasdialogo"=>$mesas_dialogo]);

            } catch(\Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }
        }//fin del else
    }
    public function obtenerProvincias(Request $request, $id){
        return Provincia::provincias($id);
    }
    public function obtenerParroquias(Request $request, $id){
        return Parroquia::parroquias($id);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function matrizCarga()
    {      
        return view('admin.mesadialogo.matrizCarga');
    }
    /**
    * Valida el archivo de la matriz de mesa de dialogo
    * El formato de la matriz Excel a validar tiene tres hojas válidas para procesar:
        Hoja 0 - Indicaciones: No se debe procesar ya que es informativa
        Hoja 1 - Datos de la Mesa: Contiene la información a registrar en la tabla mesa_dialogo
        Hoja 2 - Participantes: Contiene la información de los participantes a regiatrar en la tabla participante
        Hoja 3 - Propuestas: Contiene las propuestas o soluciones a regiatrar en la tabla solucions
        Hoja 4 - Insumos: Son valores de catálogos de ejemplo necesarios para el proceso (tomados de las diferentes tablas de la bdd)
        Hoja 5 - Listado de Instituciones: Lista de instituciones de ejemplo (tomar de la tabla institucions)
        Hoja 6 - Zonas: Datos de las zonas, se debe tomar de la tabla zona
    * En caso de cambio en el formato de la matriz se deberá revisar la función
    */
    public function vistaPreviaMesas(Request $request)
    {
        try{
            $errores[] = array();
            $errores_participante[] = array();
            $errores_solucion[] = array();

            $file = $request->file('archivo_mesa');   //obtenemos el campo file definido en el formulario
            $nombreArchivo = $file->getClientOriginalName();   //obtenemos el nombre del archivo
            $nombreArchivo = strtotime("now")."-".$nombreArchivo;     // agregamos la fecha actual unix al inicio del nombre del archivo
            \Storage::disk('local')->put($nombreArchivo,  \File::get($file));   //indicamos que queremos guardar un nuevo archivo en el disco local
            
            $objPHPExcel = PHPExcel_IOFactory::load( storage_path('app').'/storage/'.$nombreArchivo ); 
            
            //Obtenemos la Hoja 1 - Datos de la Mesa
            $objPHPExcel->setActiveSheetIndexByName('Datos de la Mesa');
            $objWorksheet = $objPHPExcel->getActiveSheet();        
            //Obtenemos todos los campos que requieren validación posterior
            $nombre_mesa = trim($objWorksheet->getCell("B1")->getCalculatedValue());
            $tipo_dialogo = trim($objWorksheet->getCell("B2")->getCalculatedValue());
            $organizador = trim($objWorksheet->getCell("B3")->getCalculatedValue());
            $consejo_sectorial = trim($objWorksheet->getCell("B4")->getCalculatedValue());
            $lider = trim($objWorksheet->getCell("B5")->getCalculatedValue());
            $coordinador = trim($objWorksheet->getCell("B6")->getCalculatedValue());
            $sistematizador = trim($objWorksheet->getCell("B7")->getCalculatedValue());       
            $zona = trim($objWorksheet->getCell("B8")->getCalculatedValue());
            $provincia = trim($objWorksheet->getCell("B9")->getCalculatedValue());
            $canton = trim($objWorksheet->getCell("B10")->getCalculatedValue());
            $parroquia = trim($objWorksheet->getCell("B11")->getCalculatedValue());
            $lugar = trim($objWorksheet->getCell("B12")->getCalculatedValue());
            $organizacion = trim($objWorksheet->getCell("B13")->getCalculatedValue());
            $fecha = trim($objWorksheet->getCell("B14")->getCalculatedValue());
            $sector = trim($objWorksheet->getCell("B15")->getCalculatedValue());
            $descripcion = trim($objWorksheet->getCell("B16")->getCalculatedValue());

            $valido = true;
            $mesa_dialogo = new MesaDialogo;
            //seteamos los valores en el objeto conforme las validaciones requeridas
            $mesa_dialogo->nombre = $nombre_mesa;
            if($mesa_dialogo->nombre == null || $mesa_dialogo->nombre == ""){
                $error = "El nombre de la mesa es obligatorio.";
                array_push($errores, $error);
                $valido = false;
            }
            $mesa_dialogo->lider = $lider; 
            $mesa_dialogo->coordinador = $coordinador;
            $mesa_dialogo->sistematizador = $sistematizador;        
            if($lugar == null || $lugar == ""){
                $error = "El lugar es obligatorio.";
                array_push($errores, $error);
                $valido = false;
            }else{
                $mesa_dialogo->lugar = $lugar;
            }
            $mesa_dialogo->organizacion = $organizacion;
            $mesa_dialogo->descripcion = $descripcion;

            if(PHPExcel_Shared_Date::isDateTime($objWorksheet->getCell("B14"))) {    
                $fecha = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecha));
                $mesa_dialogo->fecha = $fecha;
            }else{
                $error = "La fecha no es v&aacute;lida.";
                array_push($errores, $error);
                $valido = false;
            }

            $tipo_dialogo = DB::table('tipo_dialogo')->where('nombre', $tipo_dialogo)->first();
            if( $tipo_dialogo == null){
                $error = "El tipo de dialogo no es v&aacute;lido.";
                array_push($errores, $error);
                $valido = false;
            }else{
                $mesa_dialogo->tipo_dialogo_id=$tipo_dialogo->id;
            }
            $organizador = DB::table('institucions')->where('siglas_institucion', $organizador)->first();
            if( $organizador == null){
                $error = "El organizador no es v&aacute;lido.";
                array_push($errores, $error);
                $valido = false;
            }else{
                $mesa_dialogo->organizador_id=$organizador->id;
            }

            if(!is_null($consejo_sectorial)){ 
                $consejo_sectorial = DB::table('consejo_sectorials')->where('nombre_consejo', $consejo_sectorial)->first();
                if( $consejo_sectorial == null){
                    $error = "El consejo sectorial no es v&aacute;lido.";
                    array_push($errores, $error);
                    $valido = false;
                }else{
                    $mesa_dialogo->consejo_sectorial_id=$consejo_sectorial->id;
                }
            }        
            
            if(!is_null($zona)){
                $zona = DB::table('zona')->where('id', $zona)->first();
                if( $zona == null){
                    $error = "La zona no es v&aacute;lida.";
                    array_push($errores, $error);
                    $valido = false; 
                }else{
                    $mesa_dialogo->zona_id=$zona->id;
                }
            }

            if(!is_null($provincia)){
                $provincia = DB::table('provincias')->where('nombre_provincia', $provincia)->first();
                if( $provincia == null){
                    $error = "La provincia ingresada no es v&aacute;lida.";
                    array_push($errores, $error);
                    $valido = false;
                }else{
                    $mesa_dialogo->provincia_id=$provincia->id;
                }
            }
            if(!is_null($canton)){
                $canton = DB::table('cantons')->where('nombre_canton', $canton)->first();
                if( $canton == null){
                    $error = "El cantón ingresado no es v&aacute;lido.";
                    array_push($errores, $error);
                    $valido = false;
                }else{
                    $mesa_dialogo->canton_id=$canton->id;
                }
            }
            // if( !is_null($parroquia) && $parroquia != 'N/A' ){
            //     $parroquia = DB::table('parroquia')->where('nombre_parroquia', $parroquia)->first();
            //     if( $parroquia == null){
            //         $error = "La parroquia ingresada no es v&aacute;lida.";
            //         array_push($errores, $error);
            //         $valido = false;
            //     }else{
            //         $mesa_dialogo->parroquia_id=$parroquia->id;
            //     }
            // }
            if(!is_null($sector)){
                $sector = DB::table('sectors')->where('nombre_sector', $sector)->first();
                if( $sector == null){
                    $error = "El sector ingresado no es v&aacute;lido.";
                    array_push($errores, $error);
                    $valido = false;
                }else{
                    $mesa_dialogo->sector_id=$sector->id;
                }
            }

            if($valido === true){
                //Valida que el nombre de la mesa con la misma fecha no haya sido registrado
                $mesaAux = DB::table('mesa_dialogo')->where('nombre', $mesa_dialogo->nombre )
                                                    ->where('fecha', $mesa_dialogo->fecha)
                                                    ->first();
                if( $mesaAux != null){
                    $error = "El nombre de la mesa ya ha sido registrado: ".$mesaAux->nombre." con fecha: ".date('Y-m-d', strtotime($mesaAux->fecha));
                    array_push($errores, $error);
                }
            }

            //******** PARTICIPANTES
            //Obtenemos la Hoja 2 - Participantes
            $objPHPExcel->setActiveSheetIndexByName('Participantes');  
            $objWorksheet = $objPHPExcel->getActiveSheet();   
            //obtenemos el número total de filas
            $highestRow = $objWorksheet->getHighestRow();


            $participantes[] = array();
            //Obtiene la información de los participantes (descarta la cabecera)
            if($highestRow > 1){
                //Recorremos todas los registros, empiezan desde la fila 2
                for ($i = 2; $i <= $highestRow; $i++) {
                    //en una variable recogemos los registro agrupandolos dentro de un array
                    $informacion_participantes[] = array(                     
                        'numFila' => $i,
                        'nombres' => trim($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()),
                        'apellidos' => trim($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue()),
                        'email' => trim( $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue()),
                        'celular' => trim($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue()),
                        'telefono_ext' => trim($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue()),
                        'sector' => trim($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue()),
                        'tipo' => trim($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue()),
                        'empresa' => trim($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue()),
                        'cargo' => trim($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue()),
                        'sector_empresa' => trim($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue()),
                    );
                }

                //recorremos todos los registros recogidos de participantes
                foreach ($informacion_participantes as $fila) { 
                   if( $fila["nombres"] != "" && $fila["apellidos"] != "" && $fila["email"] ){ 
                        $valido = true;
                        $participante = new Participante;

                        if(!is_null($fila["sector"])){
                            $sector = DB::table('sectors')->where('nombre_sector', $fila["sector"])->first();
                            if( $sector == null){
                                $error = "Celda F". $fila['numFila'].": No se encontró el sector.";
                                array_push($errores_participante, $error);
                                $valido = false;
                            }else{
                                $participante->sector_id = $sector->id;
                            }
                        }
                        
                        if(!is_null($fila["tipo"])){
                            $tipo_participante = DB::table('tipo_participante')->where('nombre', $fila["tipo"])->first();
                            if( $tipo_participante == null){
                                $error = "Celda G". $fila['numFila'].": No se encontró el tipo de participante.";
                                array_push($errores_participante, $error);
                                $valido = false;
                            }else{
                                $participante->tipo_participante_id = $tipo_participante->id;
                            }
                        }

                        if( !is_null($fila["sector_empresa"]) && !empty($fila["sector_empresa"]) ){
                            $sector_empresa = DB::table('sectors')->where('nombre_sector', $fila["sector_empresa"])->first();
                            if( $sector_empresa == null){
                                $error = "Celda J". $fila['numFila'].": No se encontró el sector de la empresa.";
                                array_push($errores_participante, $error);
                                $valido = false;
                            }else{
                                $participante->sector_empresa_id = $sector_empresa->id;
                            }
                        }
                        
                        if($valido === true){  
                            $participante->nombres = $fila["nombres"];
                            $participante->apellidos = $fila["apellidos"];
                            $participante->email = $fila["email"];
                            $participante->celular = $fila["celular"];
                            $participante->telefono_ext = $fila["telefono_ext"];
                            $participante->empresa = $fila["empresa"];
                            $participante->cargo = $fila["cargo"];

                            array_push($participantes, $participante);
                        }
                    }else{
                        $error = "Fila ". $fila['numFila'].": Se encontraron campos obligatorios vacios.";
                        array_push($errores_participante, $error); 
                    }
                }//fin foreach
            }//fin if

            //PROPUESTAS
            //Obtenemos la Hoja 3 - Propuestas
            $objPHPExcel->setActiveSheetIndexByName('Propuestas');  
            $objWorksheet = $objPHPExcel->getActiveSheet();   
            $highestRow = $objWorksheet->getHighestRow();
            

            $soluciones[] = array();
            if($highestRow > 2){
                //recorremos todas los registros, empiezan desde la fila 3 (se descarta la cabecera)
                for ($i = 3; $i <= $highestRow; $i++) {
                    //en una variable recogemos los registro agrupandolos dentro de un array     
                    $informacion_propuestas[] = array(                     
                        'numFila' => $i,
                        'eslabonCP' => trim($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()),
                        'problema_solucion' => trim($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue()),
                        'propuesta_solucion' => trim($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue()),
                        'pajustada' => trim($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue()),
                        'palabras_clave' => trim($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue()),
                        'ambito' => trim($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue()),
                        'instumentos' => trim($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue()),
                        'responsable' => trim($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue()),
                        'coresponsables' => trim($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue()),
                        'fecha' => trim($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue()),
                        'plazo' => trim($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue()),
                        'riesgos' => trim($objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue()),
                        'supuestos' => trim($objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue()),
                        'ponderacion' => trim($objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue()),
                        'zona' => trim($objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue()),
                        'lugar_solucion' => trim($objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue()),
                        'fecha_solucion' => trim($objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue()),
                        'indice_competitividad' => trim($objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue()),
                        'politica' => trim($objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue()),
                        'plan_nacional' => trim($objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue()),
                    );
                    //dd($informacion_propuestas);
                }        
     
                //recorremos todos los registros recogidos de propuestas (soluciones)
                foreach ($informacion_propuestas as $fila) {   
                    if( $fila["propuesta_solucion"] != "" && $fila["pajustada"] != "" && $fila["palabras_clave"] != "" && $fila["ambito"] != "" && $fila["responsable"] != "" && $fila["indice_competitividad"] != "" && $fila["politica"] != "" && $fila["plan_nacional"] != "" ) 
                    {    //validamos que todos los campos de cada registro no se encuentren vacios
                        $valido = true;
                        $solucion = new Solucion;

                        //Validacion SIPOC (Eslabón de la cadena Productiva)
                        if( !is_null($fila["eslabonCP"]) ){
                            $sipoc = DB::table('sipocs')->where('nombre_sipoc', $fila["eslabonCP"] )->first();
                            //dd($sipoc);
                            if( !is_null($sipoc) ){
                                $solucion->sipoc_id = $sipoc-> id;
                            }else{
                                $error = "Celda A". $fila['numFila'].": No se encontró el sipoc.";
                                array_push($errores_solucion, $error);
                                $solucion->sipoc_id = 0;
                                $valido = false;
                            }
                        }

                        //Validacion AMBITO
                        $ambito = DB::table('ambits')->where('nombre_ambit', $fila["ambito"] )->first();
                        if( !is_null($ambito) ){
                            $solucion->ambit_id = $ambito-> id;
                        }else{
                            $error = "Celda F". $fila['numFila'].": No se encontró el &aacute;mbito.";
                            array_push($errores_solucion, $error);
                            $solucion->ambit_id = 0;
                            $valido = false;
                        }

                        //Validacion INSTRUMENTO

                        if(!is_null($fila["instumentos"]) && !empty($fila["instumentos"])){
                            
                            $instrumento = DB::table('instrumentos')->where('nombre_instrumento', $fila["instumentos"] )->first();
                            if( !is_null($instrumento) ){
                            $solucion->instrumento_id = $instrumento-> id;
                            }else{
                                $error = "Celda G". $fila['numFila'].": No se encontró el instrumento.";
                                array_push($errores_solucion, $error);
                                $solucion->instrumento_id = 0;
                                $valido = false;

                            }
                            
                        }else{
                            $solucion->instrumento_id = 0;
                        }
                            
                        //Validacion RESPONSABLE
                        $responsable = DB::table('institucions')->where('siglas_institucion', $fila["responsable"])->first();
                        if( !is_null($responsable) ){
                            $solucion->responsable_solucion = $fila["responsable"];
                        }else{
                            $error = "Celda H". $fila['numFila'].": No se encontró el responsable -> ".$fila["responsable"];
                            array_push($errores_solucion, $error);
                            $solucion->responsable_solucion = $fila["responsable"];
                            $valido = false;
                        }

                        //Validacion CORESPONSABLE
                        if(!is_null($fila["coresponsables"]) && !empty($fila["coresponsables"])){
                            $arrayCoresponsables = explode(",", $fila["coresponsables"]);
                            foreach ($arrayCoresponsables as $coresponsableAux) {
                                $coresponsable = DB::table('institucions')->where('siglas_institucion', trim($coresponsableAux))->first();
                                if( !is_null($coresponsable) ){
                                    $solucion->corresponsable_solucion = $fila["coresponsables"];
                                }else{
                                    $error = "Celda I". $fila['numFila'].": No se encontró el corresponsable -> ".$coresponsableAux;
                                    array_push($errores_solucion, $error);
                                    $solucion->corresponsable_solucion = $fila["coresponsables"];
                                    $valido = false;
                                }
                            }
                        }
                        //FECHA DE CUMPLIMIENTO
                        if(!is_null($fila['fecha']) && !empty($fila['fecha'])){    
                            $fecha = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fila["fecha"]));
                            $solucion->fecha_cumplimiento = $fecha;
                        }

                        //FECHA DE solucion
                        if(!is_null($fila['fecha_solucion']) && !empty($fila['fecha_solucion'])){    
                            $fecha_solucion = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fila["fecha_solucion"]));
                            $solucion->fecha_solucion = $fecha_solucion;
                        }

                        //Validacion INSTRUMENTO

                        if(!is_null($fila["zona"]) && !empty($fila["zona"])){
                            
                            $zona = DB::table('zona')->where('id', $fila["zona"] )->first();
                            if( !is_null($zona) ){
                            $solucion->zona_id = $zona-> id;
                            }else{
                                $error = "Celda G". $fila['numFila'].": No se encontró la Zona.";
                                array_push($errores_solucion, $error);
                                $solucion->zona_id = 0;
                                $valido = false;

                            }
                            
                        }else{
                            $solucion->zona_id = 0;
                        }

                        //Validacion INDICE COMPETITIVIDAD

                        if( !is_null($fila["indice_competitividad"]) ){
                            
                            $indice_competitividad = DB::table('indice_competitividads')->where('nombre_indice_competitividad', $fila["indice_competitividad"] )->first();
                            
                            if( !is_null($sipoc) ){
                                $solucion->indice_competitividad_id = $indice_competitividad-> id;
                            }else{
                                $error = "Celda A". $fila['numFila'].": No se encontró el sipoc.";
                                array_push($errores_solucion, $error);
                                $solucion->indice_competitividad_id = 0;
                                $valido = false;
                            }
                        }
                        

                        //Validacion POLITICA

                        if( !is_null($fila["politica"]) ){
                            
                            $politica = DB::table('politicas')->where('nombre_politica', $fila["politica"] )->first();
                            //dd($politica);
                            
                            if( !is_null($politica) ){
                                $solucion->politica_id = $politica -> id;
                            }else{
                                $error = "Celda S". $fila['numFila'].": No se encontró el politica.";
                                array_push($errores_solucion, $error);
                                $solucion->indice_competitividad_id = 0;
                                $valido = false;
                            }
                        }


                        //Validacion PLAN NACIONAL

                        if( !is_null($fila["plan_nacional"]) ){
                            
                            $plan_nacional = DB::table('plan_nacionals')->where('nombre_plan_nacional', $fila["plan_nacional"] )->first();
                            
                            if( !is_null($plan_nacional) ){
                                $solucion->plan_nacional_id = $plan_nacional -> id;
                            }else{
                                $error = "Celda T". $fila['numFila'].": No se encontró el plan nacional.";
                                array_push($errores_solucion, $error);
                                $solucion->plan_nacional_id = 0;
                                $valido = false;
                            }
                        }
                        

                        if($valido === true){
                                      
                            $solucion->verbo_solucion = ''; 
                            $solucion->sujeto_solucion = ''; 
                            $solucion->complemento_solucion = ''; 

                            $solucion->plazo_cumplimiento = $fila["plazo"];
                            $solucion->riesgos_cumplimiento = $fila["riesgos"];
                            $solucion->supuestos_cumplimientos = $fila["supuestos"];
                            $solucion->problema_solucion = $fila["problema_solucion"];

                            $solucion->pajustada = $fila["pajustada"];
                            $solucion->propuesta_solucion = $fila["propuesta_solucion"];
                            $solucion->palabras_clave = $fila["palabras_clave"];
                            $pajustada_aux = DB::table('pajustadas')->where('nombre_pajustada', $fila["pajustada"])->first();
                            if( !is_null($pajustada_aux) ){
                                $solucion->pajustada_id = $pajustada_aux->id;
                            }else{
                                $solucion->pajustada_id= 0;
                            }
                            

                            $solucion->evento_id =  0;
                            $solucion->lider_mesa_solucion = $lider;
                            $solucion->sistematizador_solucion = $sistematizador;
                            $solucion->provincia_id= $provincia-> id;

                            //valores por defecto (quemados)
                            $solucion->coordinador_zonal_solucion= $coordinador;
                            // Corresponde al tipo de dialogo de la mesa.
                            $solucion->tipo_fuente= $mesa_dialogo->tipo_dialogo_id;
                              
                            $solucion->thematic_id= 0;     // 0 porque esta columna es para consejo consultivo 
                            $solucion->vsector_id = 0;     // sin utilizar por el momento
                            $solucion->solucion_ccpt = "";
                            $solucion->mesa_id = 0;
                            $solucion->estado_id = 1;
                            $solucion->lugar_solucion = $fila["lugar_solucion"];
                            $solucion->tipo_empresa_id = 0;
                            if( !is_null($fila["ponderacion"])  && !empty($fila["ponderacion"])){
                            $solucion->ponderacion = $fila["ponderacion"]; 
                            }else{
                            $solucion->ponderacion = 0;
                            }
                            



                            array_push($soluciones, $solucion);                        
                        }    

                    }else{
                        $error = "Fila ". $fila['numFila'].": Se encontraron campos vacios.";
                        array_push($errores_solucion, $error); 
                    }      
                }//Fin del foreach
            }// fin if
            
            
            unset($soluciones[0]);            
            unset($participantes[0]);
            unset($errores[0]);
            unset($errores_participante[0]);
            unset($errores_solucion[0]);

            if(count($errores) > 0 || count($errores_participante) > 0 || count($errores_solucion) > 0){
                File::delete( storage_path('app').'/storage/'.$nombreArchivo);
                $total_errores = count($errores) + count($errores_participante) + count($errores_solucion);
                Flash::error("Se han encontrado ". $total_errores ." errores detallados a continuaci&oacute;n:");
            }else{
                $totalErrorParticipantes = 0;
                if(isset($informacion_participantes)){
                    $totalErrorParticipantes =count($informacion_participantes);
                }
                $totalErrorPropuestas = 0;
                if(isset($informacion_propuestas)){
                    $totalErrorPropuestas =count($informacion_propuestas);
                }
                Flash::info("Se encontraron ".$totalErrorParticipantes." participantes y ".$totalErrorPropuestas." propuestas para la mesa: ".$mesa_dialogo->nombre.".". "Haga click en <b>\"Guardar\"</b> para almacenar la información de la matriz.");
            }

            $datos_participante = Collection::make($participantes);
            $datos_solucion = Collection::make($soluciones);
            //dd($datos_solucion);
            $errores = Collection::make($errores);
            $errores_participante = Collection::make($errores_participante);
            $errores_solucion = Collection::make($errores_solucion);

            //dd($datos_solucion);
            
            return view('admin.mesadialogo.vistaPreviaMesas')->with(["mesa_dialogo"=> $mesa_dialogo, "datos_participante"=>$datos_participante, "datos_solucion"=>$datos_solucion, "errores"=>$errores, "errores_participante"=>$errores_participante, "errores_solucion"=>$errores_solucion, "nombreArchivo"=>$nombreArchivo]);

        } catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage().". Por favor valide que el formato de la matriz de mesa de dialogo, participantes y propuestas sean correctos.";
        }
        
    }
}
