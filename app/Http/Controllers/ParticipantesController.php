<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel; 
use PHPExcel_IOFactory; 
use PHPExcel_Shared_Date;
use DB;
use App\Evento;

use App\Solucion;
use File;
use App\User;
use Illuminate\Support\Collection as Collection;
use Laracasts\Flash\Flash;


class ParticipantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
   	    $rol = DB::table('roles')->where('nombre_role', "Participante")->first();  //Obtener id rol de participante
    	
        $participantes = User::search($request-> parametro)->where('tipo_fuente','=','1')
                            ->whereHas('roles', function ($q) use ($rol) {
                                    $q->where('roles.id', $rol-> id);
                            })
        ->orderBy('apellidos','ASC')->paginate(25);
        return view('admin.participantes.home')->with(["participantes"=>$participantes]);    
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.participantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countOK = 0;
        /*
         *
         * Cargamos el  Archivo Excel para trabajarlo 
         *
        */ 
        $objPHPExcel = PHPExcel_IOFactory::load( storage_path('app').'/storage/'.$request-> nombreArchivo ); 
        
        
        /*
         *
         * Hoja REGISTRO
         *
        */

        //PRINCIPALES

        $objPHPExcel->setActiveSheetIndex(1);    //HOJA Mesas
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $provincia= $objWorksheet->getCell("B4")->getValue();   //obtenemos el nombre de la provincia
        $provincia = DB::table('provincias')->where('nombre_provincia', $provincia)->first();

        $nombreEvento= $objWorksheet->getCell("B1")."-".$provincia-> nombre_provincia;    //obtenemos el nombre del evento
        $evento= DB::table('eventos')->where([  ['nombre_evento', '=', $nombreEvento],/* ['provincia_id', '=', $provincia->id] */])->first();
        if( is_null($evento) ){
            $evento = new Evento;
            $evento-> nombre_evento = $nombreEvento;
            $evento-> provincia_id = $provincia-> id;
            $evento-> save();    
        }

       

        //FIN DE PRINCIPALES
        
        $objPHPExcel->setActiveSheetIndex(0);   //indicamos que vamos a trabajar en la hoja 0 que es la de registro
        $objWorksheet = $objPHPExcel->getActiveSheet();  //

        $coordinador= $objWorksheet->getCell("B2");     //obtenemos el coordinador
        
        /*$InvDate= $objWorksheet->getCell("B3")->getValue();   //obtenemos el valor de la fecha, pero esta en entero, que es el resultado de restar la fecha actual menos la fecha 01/01/1990
        $timestamp = PHPExcel_Shared_Date::ExcelToPHP($InvDate);  //transformamos el valor obtenido a timestamp
        $fecha_php = date("Y-d-m",$timestamp);                    //formateamos el timestamp a solo Y-d-m  
        */
        
        $highestRow = $objWorksheet->getHighestRow();   //obtenemos el número total de filas
        
        if($highestRow >= 7){ 

            for ($i = 7; $i <= $highestRow; $i++) {         //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
                
                $cedula = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                if( strlen($cedula) < 10 && $cedula != "" ){
                    $cedula= "0".$cedula;
                }

                $celular = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                if( strlen($celular) < 10 && $celular != "" && strlen($celular) > 1){
                    $celular= "0".$celular;
                }

                $informacion[] = array(                     //en una variable recogemos los registro agrupandolos dentro de un array
                    'numFila' => $i,
                    'nombre' => $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                    'apellidos' => $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                    'cedula' => $cedula,
                    'email' => $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                    'celular' => $celular,
                    'telefonoExtension' => $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                    'grupo' => $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                    'tipo' => $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue(),
                );
            }

            foreach ($informacion as $registro) {   //recorremos todos los registros recogidos
                if( $registro["nombre"] != "" && $registro["apellidos"] != "" && $registro["cedula"] != "" && $registro["email"] != ""  && $registro["grupo"] != "" && $registro["tipo"] != "")
                {    //validamos que todos los campos de cada registro no se encuentren vacios
                    $userAux = DB::table('users')->where('cedula', $registro['cedula'])->first();
                    if( is_null($userAux) ) {
                    
                        $user = new user;

                        $sector = DB::table('sectors')->where('nombre_sector', $registro['grupo'])->first();
                        if($sector == null ){
                            $error = "Fila ".$registro['numFila'].": Ingrese un grupo v&aacute;lido";
                            array_push($errores, $error); 
                        }

                        $vsector = DB::table('vsectors')->where('nombre_vsector', $registro['tipo'])->first();
                        if($vsector == null ){
                            $error = "Fila ".$registro['numFila'].": Ingrese un tipo de participante v&aacute;lido";
                            array_push($errores, $error); 
                        }
                        
                        $user-> name  = $registro["nombre"];   // Id Eslabón de la cadena Productiva
                        $user-> apellidos = $registro["apellidos"];
                        $user-> cedula = $registro["cedula"];
                        $user-> password = bcrypt($registro["cedula"]);
                        $user-> email = $registro["email"];

                        $user-> telefono = $registro['telefonoExtension'];
                        $user-> celular = $registro['celular'];
                        
                        $user-> sector_id = $sector-> id;
                        $user-> vsector_id =  $vsector-> id;

                        $user-> tipo_fuente= 1;     // 1 = despliegue territorial

                        $user-> save(); 
                        $rol = DB::table('roles')->where('nombre_role', "Participante")->first();

                        $user->roles()-> attach($rol-> id);
                        $user->evento()-> attach($evento-> id);

                        
                        $countOK++ ;    
                        
                    }    

                }
                      
            }
            //FIN del foreach

        }    
        

     

        $flash1 = "Se registraron ".$countOK." participantes.";
        //Flash::success("Se registraron ".$countOK." participantes.");
        //return redirect('participantes');
        

        /*
         *
         * Hoja :: MESAS
         *
        */

        $objPHPExcel->setActiveSheetIndex(1);   //indicamos que vamos a trabajar en la hoja 0 que es la de mesas
        $objWorksheet = $objPHPExcel->getActiveSheet();  //

        $evento = DB::table('eventos')->where('nombre_evento', $nombreEvento )->first();

        $liderMesa= $objWorksheet->getCell("B2");     //obtenemos al lider de mesa
        
        $sistematizador= $objWorksheet->getCell("B3");     //obtenemos al lider de mesa
        
        /*$InvDate= $objWorksheet->getCell("B5")->getValue();   //obtenemos el valor de la fecha, pero esta en entero, que es el resultado de restar la fecha actual menos la fecha 01/01/1990
        $timestamp = PHPExcel_Shared_Date::ExcelToPHP($InvDate);  //transformamos el valor obtenido a timestamp
        $fecha_php = date("Y-d-m",$timestamp);                    //formateamos el timestamp a solo Y-d-m  
        */
        $sector= $objWorksheet->getCell("B6");   //obtenemos el grupo 
        $sector = DB::table('sectors')->where('nombre_sector', $sector)->first();

        $highestRow = $objWorksheet->getHighestRow();   //obtenemos el número total de filas
        
        //return "archivo guardado";

        for ($i = 9; $i <= $highestRow; $i++) {         //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
            $informacion2[] = array(                     //en una variable recogemos los registro agrupandolos dentro de un array
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

        
        $countError = $countOK = 0;
        $arrayValProblemas[] = array(); 
        foreach ($informacion2 as $fila) {   //recorremos todos los registros recogidos
            if( $fila["eslabonCP"] != "" && $fila["problematica"] != "" && $fila["pverbo"] != "" && $fila["psujeto"] != "" 
                && $fila["pcomplemento"] != "" && $fila["instrumentos"] != "" && $fila["clasificacionEmpresa"] != "" 
                && $fila["ambito"] != "" && $fila["responsable"] != "" && $fila["coresponsables"] != ""){    //validamos que todos los campos de cada registro no se encuentren vacios

                $sipoc = DB::table('sipocs')->where('nombre_sipoc', $fila["eslabonCP"] )->first();
                $instrumento = DB::table('instrumentos')->where('nombre_instrumento', $fila["instrumentos"] )->first();
                $tipoEmpresa = DB::table('tipo_empresa')->where('nombre_tipo_empresa', $fila["clasificacionEmpresa"] )->first();
                $ambito = DB::table('ambits')->where('nombre_ambit', $fila["ambito"] )->first();
                
                
                $solucion = new Solucion;
                $solucion-> sipoc_id = $sipoc-> id;   // Id Eslabón de la cadena Productiva
                $solucion-> problema_validar_solucion = $fila["problematicaValidacion"];     
                if (!in_array($fila["problematicaValidacion"], $arrayValProblemas)) {
                    $solucion-> problema_solucion= $fila["problematica"];
                }
                else{
                    $solucionAuxiliar = DB::table('solucions')->where('problema_validar_solucion', $fila["problematicaValidacion"] )->first();
                    $solucion-> problema_solucion= $solucionAuxiliar-> problema_solucion;
                }                                             
                $solucion-> verbo_solucion = $fila["pverbo"];
                $solucion-> sujeto_solucion = $fila["psujeto"];
                $solucion-> complemento_solucion = $fila["pcomplemento"];
                $solucion-> instrumento_id = $instrumento-> id;
                $solucion-> ambit_id = $ambito-> id;
                $solucion-> responsable_solucion = $fila["responsable"];
                $solucion-> corresponsable_solucion = $fila["coresponsables"];

                $solucion-> evento_id = $evento-> id;
                $solucion-> lider_mesa_solucion = $liderMesa;
                $solucion-> sistematizador_solucion = $sistematizador;
                $solucion-> provincia_id= $provincia-> id;
                $solucion-> sector_id= $sector-> id; 

                $solucion-> tipo_empresa_id = $tipoEmpresa-> id;  
                
                //Hoja -- registros
                $solucion-> coordinador_zonal_solucion= $coordinador;
                
                //quemados
                $solucion-> tipo_fuente= 1;     // 1 = despliegue territorial
                $solucion-> pajustada_id= 0;    // 0 porque esta columna es para consejo consultivo   
                $solucion-> thematic_id= 0;     // 0 porque esta columna es para consejo consultivo    

                $solucion-> vsector_id = 0;     // sin utilizar por el momento
                $solucion-> solucion_ccpt = "";
                $solucion-> mesa_id = 0;
                $solucion-> estado_id = 1;    //  1 = Sin asignar responsables
                
                $solucion-> save(); 
                array_push($arrayValProblemas, $fila["problematicaValidacion"]); 
                $countOK++ ;  
                                    
            }else{
                $countError++;
            }           
        }
        Flash::success("<ul>
                            <li>Se registradon ".$countOK." soluciones.</li>
                            <li>".$flash1."</li>
                        </ul>");
        
        return redirect('admin/soluciones');

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
       
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function vistaPreviaRegistro($nombreArchivo)
    {
        $errores[] = array();
        $users[] = array(); 
        $countUserExists = 0;
         
        $objPHPExcel = PHPExcel_IOFactory::load( storage_path('app').'/storage/'.$nombreArchivo); 
        
        /*
         *
         * Hoja REGISTRO
         *
        */
        
        $objPHPExcel->setActiveSheetIndex(0);   //indicamos que vamos a trabajar en la hoja 0 que es la de registro
        $objWorksheet = $objPHPExcel->getActiveSheet();  //

        $provincia= $objWorksheet->getCell("B4")->getValue();   //obtenemos el nombre de la provincia
        $provincia = DB::table('provincias')->where('nombre_provincia', $provincia)->first();
        
        if( is_null($provincia) ){
            $error = "Ingrese una provincia v&aacute;lida";
            array_push($errores, $error); 
        }
        
        $nombreEvento= $objWorksheet->getCell("B1")."-".$provincia->nombre_provincia;    //obtenemos el nombre del evento
        
        $coordinador= $objWorksheet->getCell("B2");     //obtenemos el coordinador
        
        //formateamos el timestamp a solo Y-d-m  
        
        $highestRow = $objWorksheet->getHighestRow();   //obtenemos el número total de filas
        
        if($highestRow >= 7){  //Comprueba si la hoja contiene participantes
        
                for ($i = 7; $i <= $highestRow; $i++) {         //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas

                    $cedula = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                    if( strlen($cedula) < 10 && $cedula != "" ){
                        $cedula= "0".$cedula;
                    }

                    $celular = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                    if( strlen($celular) < 10 && $celular != "" && strlen($celular) > 1){
                        $celular= "0".$celular;
                    }
                    
                    $informacion[] = array(                     //en una variable recogemos los registro agrupandolos dentro de un array
                        'numFila' => $i,
                        'nombre' => $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                        'apellidos' => $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                        'cedula' => $cedula,
                        'email' => $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                        'celular' => $celular,
                        'telefonoExtension' => $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                        'grupo' => $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                        'tipo' => $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue(),
                    );
                }

                foreach ($informacion as $registro) {   //recorremos todos los registros recogidos
                    if( $registro["nombre"] != "" && $registro["apellidos"] != "" && $registro["cedula"] != "" && $registro["grupo"] != "" && $registro["tipo"] != "")
                    {    //validamos que todos los campos de cada registro no se encuentren vacios
                        
                        $userAux = DB::table('users')->where('cedula', $registro['cedula'])->first();
                        if( is_null($userAux) ) {
                            $user = new user;

                            $sector = DB::table('sectors')->where('nombre_sector', $registro['grupo'])->first();
                            if($sector == null ){
                                $error = "Fila ".$registro['numFila'].": Ingrese un grupo v&aacute;lido";
                                array_push($errores, $error); 
                            }

                            $vsector = DB::table('vsectors')->where('nombre_vsector', $registro['tipo'])->first();
                            if($vsector == null ){
                                $error = "Fila ".$registro['numFila'].": Ingrese un tipo de participante v&aacute;lido";
                                array_push($errores, $error); 
                            }

                            
                            if( strlen($registro['email']) < 7 || strpos( $registro['email'], '@') === false ){
                               $error = "Fila ".$registro['numFila'].": El correo electr&oacute;nico no es v&aacute;lido. Elimine la fila";
                                array_push($errores, $error);
                            }else{

                                $user-> name  = $registro["nombre"];   // Id Eslabón de la cadena Productiva
                                $user-> apellidos = $registro["apellidos"];
                                $user-> cedula = $registro["cedula"];
                                $user-> email = $registro["email"];

                                $user-> telefono = $registro['telefonoExtension'];
                                $user-> celular = $registro['celular'];
                                
                                $user-> sector_id = $sector-> id;
                                $user-> vsector_id =  $vsector-> id;

                                $user-> tipo_fuente= 1;     // 1 = despliegue territorial

                                array_push($users, $user); 
                            }
                            
                        }else{
                            $countUserExists++;
                            if( strlen($registro['email']) < 7 || strpos( $registro['email'], '@') === false ){
                            $error = "Fila ".$registro['numFila'].": El correo electr&oacute;nico no es v&aacute;lido. Elimine la fila";
                            array_push($errores, $error);
                        }
                        }    

                    }else{
                        $error = "Fila ". $registro['numFila'].": Se encontraron campos vacios. Elimine la fila.";
                        array_push($errores, $error); 
                    }      
                }//FIN del foreach
        }
        
        unset($users[0]);
        unset($errores[0]);
        
        if(count($errores) > 0){
            File::delete( storage_path('app').'/storage/'.$nombreArchivo);
            Flash::error("Se encontraron ". count($errores)." error(es) detallados a continuaci&oacute;n, por favor siga las instrucciones.");
        }else{
            Flash::info("<ul>
                            <li>Participantes nuevos: ". count($users) ."</li>
                            <li>Participantes existentes: ".$countUserExists ."</li>
                        </ul>
                        <br> Haga click en <b>\"Cargar datos \"</b> para confirmar.");
        }

        $datos = Collection::make($users);
        $errores = Collection::make($errores);

        return view('admin.participantes.vistaPreviaRegistro')->with(["datos"=>$datos, "errores"=>$errores, "nombreArchivo"=>$nombreArchivo, "nombreEvento"=>$nombreEvento]); 
        
    } 


}
