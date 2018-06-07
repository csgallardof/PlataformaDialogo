<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel; 
use PHPExcel_IOFactory; 
use PHPExcel_Shared_Date;
use App\Solucion;
use App\Evento;
use App\ActorSolucion;
use App\Actividad;
use App\Ambit;
use App\Sipoc;
use File;
use DB;
use Illuminate\Support\Collection as Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Laracasts\Flash\Flash;

class SolucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $soluciones = Solucion::search($request-> parametro)->where('tipo_fuente','=','1')
        ->orderBy('id','DESC')->paginate(15);

        return view('admin.soluciones.home')->with(["soluciones"=>$soluciones]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.soluciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store($nombreArchivo, $flash1)
    {        
        //
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
        $item = solucion::find($id);

        return view('admin.soluciones.edit', compact('item'));
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
        /*
        $sector = sector::find($id);
        $this ->validate($request,[
            'nombre_sector' =>'required'
        ]);
        $sector->nombre_sector = $request->nombre_sector;
        $sector->save();
        return redirect('sectors');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solucion = solucion::find($id)->delete();
        
        //$categoria= DB::table('categoria')->where('path','LIKE','%/'.$id.'%')->delete();

        //Flash::error("La categor&iacute;a '".$nombreCategoria."' ha sido borrada de forma exitosa!");
        return redirect('soluciones');
    }



    public function vistaPreviaMesas(Request $request)
    {
        $errores[] = array();

        $file = $request->file('archivo');   //obtenemos el campo file definido en el formulario
        $nombreArchivo = $file->getClientOriginalName();   //obtenemos el nombre del archivo
        $nombreArchivo = strtotime("now")."-".$nombreArchivo;     // agregamos la fecha actual unix al inicio del nombre del archivo
        \Storage::disk('local')->put($nombreArchivo,  \File::get($file));   //indicamos que queremos guardar un nuevo archivo en el disco local
        
        $objPHPExcel = PHPExcel_IOFactory::load( storage_path('app').'/storage/'.$nombreArchivo ); 
        
        $objPHPExcel->setActiveSheetIndex(0);   //indicamos que vamos a trabajar en la hoja 0 que es la de registro
        $objWorksheet = $objPHPExcel->getActiveSheet();  //
        
        $coordinador= $objWorksheet->getCell("B2")->getValue();     //obtenemos el coordinador    

        $objPHPExcel->setActiveSheetIndex(1);   //indicamos que vamos a trabajar en la hoja 0 que es la de mesas
        $objWorksheet = $objPHPExcel->getActiveSheet();  //

        $provincia= $objWorksheet->getCell("B4");   //obtenemos el nombre de la provincia
        $provincia = DB::table('provincias')->where('nombre_provincia', $provincia)->first();
        if( $provincia == null){
            $error = "Ingrese una provincia v&aacute;lida";
            array_push($errores, $error); 
        }
        
        $nombreEvento= $objWorksheet->getCell("B1")."-".$provincia-> nombre_provincia;   

        $liderMesa= $objWorksheet->getCell("B2")->getValue();     //obtenemos al lider de mesa
        
        $sistematizador= $objWorksheet->getCell("B3")->getValue();     //obtenemos al lider de mesa
        
        /*$InvDate= $objWorksheet->getCell("B5")->getValue();   //obtenemos el valor de la fecha, pero esta en entero, que es el resultado de restar la fecha actual menos la fecha 01/01/1990
        $timestamp = PHPExcel_Shared_Date::ExcelToPHP($InvDate);  //transformamos el valor obtenido a timestamp
        $fecha_php = date("Y-d-m",$timestamp);                    //formateamos el timestamp a solo Y-d-m  
        */
        $sector= $objWorksheet->getCell("B6");   //obtenemos el grupo 
        $sector = DB::table('sectors')->where('nombre_sector', $sector)->first();

        $highestRow = $objWorksheet->getHighestRow();   //obtenemos el número total de filas
        
        
        for ($i = 9; $i <= $highestRow; $i++) {         //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
            $informacion2[] = array(                     //en una variable recogemos los registro agrupandolos dentro de un array
                'numFila' => $i,
                'eslabonCP' => $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                'problematica' => $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                'problematicaValidacion' => str_replace(" ", "", strtoupper( $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue() )),
                'pverbo' => $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue(),
                'psujeto' => $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                'pcomplemento' => $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(),
                'instrumentos' => $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                'clasificacionEmpresa' => $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                'ambito' => $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue(),
                'responsable' => $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue(),
                'coresponsables' => $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue(),
            );
        }

        
        $soluciones[] = array(); 
        $arrayProblemas[] = array(); 
        $arrayValProblemas[] = array(); 


        foreach ($informacion2 as $fila) {   //recorremos todos los registros recogidos
            if( $fila["eslabonCP"] != "" && $fila["problematica"] != "" && $fila["pverbo"] != "" && $fila["psujeto"] != "" && $fila["pcomplemento"] != "" && $fila["instrumentos"] != "" && $fila["clasificacionEmpresa"] != "" && $fila["ambito"] != "" && $fila["responsable"] != "" && $fila["coresponsables"] != "") 
            {    //validamos que todos los campos de cada registro no se encuentren vacios
                $valido = true;
                $solucion = new Solucion;
                $solucion-> problema_solucion= $fila["problematica"];

                //Validacion SIPOC
                $sipoc = DB::table('sipocs')->where('nombre_sipoc', $fila["eslabonCP"] )->first();
                if( !is_null($sipoc) ){
                    $solucion-> sipoc_id = $sipoc-> id;   // Id Eslabón de la cadena Productiva
                }else{
                    $error = "Celda A". $fila['numFila'].": No se encontro el sipoc.";
                    array_push($errores, $error);
                    $solucion-> sipoc_id = 0;   // Id Eslabón de la cadena Productiva
                    $valido = false;
                }
                
                //Validacion INSTRUMENTO
                $instrumento = DB::table('instrumentos')->where('nombre_instrumento', $fila["instrumentos"] )->first();
                if( !is_null($instrumento) ){
                    $solucion-> instrumento_id = $instrumento-> id;
                }else{
                    $error = "Celda F". $fila['numFila'].": No se encontro el instrumento.";
                    array_push($errores, $error);
                    $solucion-> instrumento_id = 0;
                    $valido = false;
                }

                //Validacion TIPO_EMPRESA
                $tipoEmpresa = DB::table('tipo_empresa')->where('nombre_tipo_empresa', $fila["clasificacionEmpresa"] )->first();
                if( !is_null($tipoEmpresa) ){
                    $solucion-> tipo_empresa_id = $tipoEmpresa-> id;
                }else{
                    $error = "Celda G". $fila['numFila'].": No se encontro el tipo de empresa.";
                    array_push($errores, $error);
                    $solucion-> tipo_empresa_id = 0;
                    $valido = false;
                }

                //Validacion AMBITO
                $ambito = DB::table('ambits')->where('nombre_ambit', $fila["ambito"] )->first();
                if( !is_null($ambito) ){
                    $solucion-> ambit_id = $ambito-> id;
                }else{
                    $error = "Celda H". $fila['numFila'].": No se encontro el &aacute;mbito.";
                    array_push($errores, $error);
                    $solucion-> ambit_id = 0;
                    $valido = false;
                }


                if($valido === true){

                
                    $solucion-> verbo_solucion = $fila["pverbo"];
                    $solucion-> sujeto_solucion = $fila["psujeto"];
                    $solucion-> complemento_solucion = $fila["pcomplemento"];
                    
                    $solucion-> responsable_solucion = $fila["responsable"];
                    $solucion-> corresponsable_solucion = $fila["coresponsables"];

                    $solucion-> evento_id =  0;
                    $solucion-> lider_mesa_solucion = $liderMesa;
                    $solucion-> sistematizador_solucion = $sistematizador;
                    $solucion-> provincia_id= $provincia-> id;
                    //$solucion-> sector_id= $sector-> id;   
                    
                    //Hoja -- registros
                    $solucion-> coordinador_zonal_solucion= $coordinador;
                    
                    //quemados
                    $solucion-> tipo_fuente= 1;     // 1 = despliegue territorial
                    $solucion-> pajustada_id= 0;    // 0 porque esta columna es para consejo consultivo   
                    $solucion-> thematic_id= 0;     // 0 porque esta columna es para consejo consultivo 
                    $solucion-> vsector_id = 0;     // sin utilizar por el momento
                    $solucion-> solucion_ccpt = "";
                    $solucion-> mesa_id = 0;
                    $solucion-> estado_id = 0;

                    $solucion-> problema_validar_solucion = $fila["problematicaValidacion"]; 
                    if (!in_array( $fila["problematicaValidacion"] , $arrayValProblemas)) {
                        $solucion-> problema_solucion= $fila["problematica"];
                        array_push($arrayProblemas, $fila["problematica"] );
                        array_push($arrayValProblemas, $fila["problematicaValidacion"] );
                    }
                    else{
                        $posicion = array_search($fila["problematicaValidacion"], $arrayValProblemas);
                        $solucion-> problema_solucion= $arrayProblemas[$posicion];
                    }   
                    
                    $solucionAuxiliar = DB::table('solucions')->where('problema_validar_solucion', $fila["problematicaValidacion"] )->first();
                   if( $solucionAuxiliar != null){                        
                        $error = "Celda B". $fila['numFila'].": La problem&aacute;tica: \"".$fila['problematica']."\"  ya se encuentra registrada.";
                        array_push($errores, $error);   
                    }else{
                        array_push($soluciones, $solucion); 
                    }
                }    

            }else{
                $error = "Fila ". $fila['numFila'].": Se encontraron campos vacios.";
                array_push($errores, $error); 
            }      
        }//FIN del foreach
        
        unset($soluciones[0]);
        unset($errores[0]);
        if(count($errores) > 0){
            File::delete( storage_path('app').'/storage/'.$nombreArchivo);
            Flash::error("Se han encontrado ". count($errores)." errores detallados a continuaci&oacute;n:");
        }else{
            Flash::info("Se encontraron ". count($informacion2)." soluciones. Haga click en <b>\"Siguiente\"</b> para ir a la vista previa de los participantes.");
        }

        $datos = Collection::make($soluciones);
        $errores = Collection::make($errores);

        return view('admin.soluciones.vistaPreviaMesas')->with(["datos"=>$datos, "errores"=>$errores, "nombreArchivo"=>$nombreArchivo, "nombreEvento"=>$nombreEvento, "sector"=>$sector]); 
        
    } 

    public function getSolucionesByTipoFuente(Request $request, $tipo_fuente){
        if($request->ajax() ){
            if($tipo_fuente == 1){
                $soluciones = DB::table('solucions')
                            ->select('id','verbo_solucion','sujeto_solucion','complemento_solucion')
                            ->where('tipo_fuente','=',1)
                            ->orderBy('verbo_solucion')->get();
            }
            if($tipo_fuente == 2){
                $soluciones = DB::table('pajustadas') //SOLUCIONES AJUSTADAS
                                ->distinct()
                                ->select('pajustadas.id','nombre_pajustada')
                                ->join('solucions','solucions.pajustada_id','=','pajustadas.id')
                                ->where('solucions.tipo_fuente','=',2)
                                ->orderBy('nombre_pajustada')->get();
            }
            
            return response()->json($soluciones);
        }
    }

    public function reporte1(){
    
        
        $soluciones = Solucion::where('tipo_fuente','=',1)->get();

        $ambits = Ambit::all();
        $sipocs = Sipoc::all();

        return view('publico.reportes.reporte1')->with(["soluciones"=>$soluciones,"ambits"=>$ambits,"sipocs"=>$sipocs]);

    }

    public function buscar(Request $request){

        $ambits = Ambit::all(); 

        $sipocs= Sipoc::all();

        $paramAmbit = Ambit::find($request-> ambito);

        $paramSipoc = Sipoc::find($request-> sipoc);

        $paramFuente = $request-> tipo_fuente;

        
        if($request-> tipo_fuente == 1){ 
            
            if( $request->ambito > 0 && $request->sipoc > 0){
                $soluciones = Solucion::where('ambit_id','=',$request->ambito)
                                    ->where('sipoc_id','=',$request->sipoc)
                                    ->where('tipo_fuente','=',$request->tipo_fuente)->get();
            }else{
                if($request->ambito > 0 ){
                    $soluciones = Solucion::where('ambit_id','=',$request->ambito)
                                    ->where('tipo_fuente','=',$request->tipo_fuente)->get();
                }else{
                    if($request->sipoc > 0 ){
                        $soluciones = Solucion::where('sipoc_id','=',$request->sipoc)
                                    ->where('tipo_fuente','=',$request->tipo_fuente)->get();
                    }
                }
            }
        }

        if($request-> tipo_fuente == 2){ 
            
            if( $request->ambito > 0 && $request->sipoc > 0){
                $soluciones = Solucion::where('tipo_fuente','=',$request->tipo_fuente)
                        ->where('sipoc_id','=',$request->sipoc)
                        ->where('ambit_id','=',$request->ambito)->get();
            }else{
                if($request->ambito > 0 ){
                    $soluciones = Solucion::where('tipo_fuente','=',$request->tipo_fuente)
                       ->where('ambit_id','=',$request->ambito)->get();
                }else{
                    if($request->sipoc > 0 ){
                    $soluciones = Solucion::where('tipo_fuente','=',$request->tipo_fuente)
                        ->where('sipoc_id','=',$request->sipoc)->get(); 
                    }
                }
            }
        }
    
            
        return view('publico.reportes.reporte1')->with([
                                                    "ambits"=>$ambits,
                                                    "sipocs"=>$sipocs,
                                                    "paramSipoc"=>$paramSipoc,
                                                    "paramAmbit"=>$paramAmbit,
                                                    "paramFuente"=>$paramFuente,
                                                    "soluciones"=>$soluciones
                                                ]);



    }



}