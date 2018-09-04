<?php

namespace App\Http\Controllers; 
use App\ActorSolucion;
use App\Solucion;
use App\User;
use App\Pajustada;
use DB;
use Laracasts\Flash\Flash;
use Mail; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $rol = DB::table('roles')->where('nombre_role', "Institución")->first();  //Obtener id rol de participante
        
        $instituciones = User::where('tipo_fuente','=','3')
                            ->whereHas('roles', function ($q) use ($rol) {
                                    $q->where('roles.id', $rol-> id);
                            })
        ->orderBy('name','ASC')->paginate(25);

        //dd($rol);
        return view('admin.institucion.home')->with(["instituciones"=>$instituciones]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.institucion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $institucion = new User;
        $this ->validate($request,[
            'nombre_user' =>'required',
            'email' =>'min:15|max:250|required|unique:users',
            'cedula' =>'min:8|max:30|required|unique:users',
        ]);
        $institucion->name = $request->nombre_user;
        $institucion->apellidos = "";
        $institucion->cedula = $request->cedula;
        $institucion->email = $request->email;
        $password = str_split($request->nombre_user,3)[0].
                    str_split($request->email,3)[0].
                    substr($request->cedula, -4);  
        $institucion->password = bcrypt($password);
        $institucion->tipo_fuente = 3;
        $institucion->sector_id = 0;
        $institucion->vsector_id = 0;
        
        $institucion-> save(); 
        $rol = DB::table('roles')->where('nombre_role', "Institución")->first();
        $institucion->roles()-> attach($rol-> id);

        /*$this->enviarCorreoRegistro($institucion , $password);*/

        return redirect('/admin/instituciones');
        
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
        $item = User::find($id);

        return view('admin.institucion.edit', compact('item'));
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
        $institucion = user::find($id);
        $this ->validate($request,[
            'nombre_user' =>'required',
            'email' =>'min:15|max:250|required|unique:users',
            'cedula' =>'min:8|max:30|required|unique:users',
        ]);
        $institucion->name = $request->nombre_user;
        $institucion->apellidos = "";
        $institucion->cedula = $request->cedula;
        $institucion->email = $request->email;
        $institucion->password = bcrypt("acdc");
        $institucion->tipo_fuente = 3;
        $institucion->sector_id = 0;
        $institucion->vsector_id = 0;
        $institucion-> save(); 
       
        return redirect()->route('instituciones.index');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $usuario_id = Auth::user()->id;
        //dd($usuario_id);
        $tipo_fuente = Auth::user()->tipo_fuente;
       

        $totalDespliegue = Solucion::where('tipo_fuente','=',1)->count();
        $totalConsejo = Solucion::where('tipo_fuente','=',2)->count();

        $totalResponsable = ActorSolucion::where('user_id','=',$usuario_id)
                                         ->where('tipo_actor','=','1')->count();
        $totalCorresponsable = ActorSolucion::where('user_id','=',$usuario_id)
                                         ->where('tipo_actor','=','2')->count();

        $solucionesDespliegue= DB::select('SELECT solucions.id, solucions.propuesta_solucion, actor_solucion.tipo_actor, estado_solucion.nombre_estado
                                    from solucions
                                    inner join actor_solucion on actor_solucion.solucion_id = solucions.id
                                    inner join institucions on institucions.id = actor_solucion.institucion_id
                                    inner join user_institucions on user_institucions.institucion_id = institucions.id
                                    inner join users on user_institucions.user_id = users.id
                                    INNER JOIN estado_solucion ON estado_solucion.id = solucions.estado_id
                                    where users.id ='.$usuario_id);
       
       
        $notificaciones = DB::select("SELECT actividades.* FROM actividades
                                                    INNER JOIN solucions ON solucions.id = actividades.solucion_id
                                                    INNER JOIN actor_solucion ON actor_solucion.solucion_id = solucions.id
                                                    WHERE actor_solucion.user_id = ".$usuario_id." 
                                                    AND actividades.ejecutor_id = ".$usuario_id."
                                                    AND actividades.fecha_inicio >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)
                                                    ORDER BY actividades.fecha_inicio DESC; ");

        //dd($tipo_fuente);
        return view('institucion.home')->with([ "solucionesDespliegue"=>$solucionesDespliegue,
                                                "totalDespliegue"=>$totalDespliegue,
                                                "totalConsejo"=>$totalConsejo,
                                                "totalResponsable"=>$totalResponsable,
                                                "totalCorresponsable"=>$totalCorresponsable,
                                                "notificaciones"=>$notificaciones,
                                                "tipo_fuente"=>$tipo_fuente     
                                                 ]);   
        
    }

    //ASIGNACION DE ACTOR SOLUCION



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActorSolucion()
    {
        //dd($request);              
        //$actoresSoluciones = ActorSolucion::all();

        $actoresSoluciones = DB::SELECT("SELECT solucions.tipo_fuente,actor_solucion.tipo_actor,users.name, solucions.verbo_solucion,solucions.sujeto_solucion,solucions.complemento_solucion FROM actor_solucion
            JOIN users ON users.id=actor_solucion.user_id
            JOIN solucions ON solucions.id=actor_solucion.solucion_id");
        //dd($actoresSoluciones);


       return view('admin.actores.homeActores')->with(["actoresSoluciones"=>$actoresSoluciones]); 
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForm2(Request $request)
    {
        $instituciones = DB::table('users')
                        ->select('users.id','name')
                        ->join('role_user','users.id','=','role_user.user_id')
                        ->where('role_user.role_id','=',3)
                        ->orderBy('name')->get();

        return view('admin.actores.asignar')->with(["instituciones"=>$instituciones]);
    }

    public function asignarActorSolucionAll(Request $request)
    {
        dd($request);
        
        if( $request->tipo_actor_id == 1){   //Para registrar Responsable a una solucion
            $validacion = ActorSolucion::where('solucion_id','=',$request->solucion_id)
                                    ->where('tipo_actor','=', 1 )->get();

            $validacion2 = ActorSolucion::where('solucion_id','=',$request->solucion_id)
                                    ->where('user_id','=', $request->institucion)
                                    ->where('tipo_actor','=', 2 )->get();

            if( count($validacion) == 0 && count($validacion2) == 0){

                $actorSolucion = new ActorSolucion;
                $actorSolucion->user_id = $request->institucion;
                $actorSolucion->solucion_id = $request->solucion_id;
                $actorSolucion->tipo_actor = 1;
                $actorSolucion->tipo_fuente = $request->tipo_fuente_id;
                $actorSolucion->save();    
                Flash::success("Asignación exitosa");

                $user = User::find($request-> institucion);

                
                    $solucion = Solucion::find($request-> solucion_id);
                    $solucion-> estado_id = 2; // 2 = Propuesta con responsable asignado
                    $solucion->save();

                    /*$this->enviarCorreoAsignacion($user, 'Responsable', $solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion );*/
                
                               
                
            }else{
                if(count($validacion) > 0) {
                    Flash::error("La solucion ya tiene un responsable"); 
                    //dd('nose guardo');   
                }
                if(count($validacion2) > 0) {
                    Flash::error("La institucion ya es actor de la solucion seleccionada");
                    //dd('nose guardo');
                }
                
            }

        }

        if( $request->tipo_actor_id == 2){    

            $validacion = DB::select("SELECT * FROM actor_solucion WHERE
                                     ( user_id =".$request->institucion." AND solucion_id =".$request->solucion_id." AND tipo_actor = 1 ) OR
                                     ( user_id =".$request->institucion." AND solucion_id =".$request->solucion_id." AND tipo_actor = 2 )
                                     " );
            
            if( count($validacion)== 0 ){
                $actorSolucion = new ActorSolucion;
                $actorSolucion->user_id = $request->institucion;
                $actorSolucion->solucion_id = $request->solucion_id;
                $actorSolucion->tipo_actor = 2;
                $actorSolucion->tipo_fuente = $request->tipo_fuente_id;
                $actorSolucion->save();    
                Flash::success("Asignacion exitosa");

                $user = User::find($request-> institucion);

               
                    //$solucion = Solucion::find($request-> solucion_id);
                    /*$this->enviarCorreoAsignacion($user, 'Corresponsable', $solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion );*/
                
                
            }else{
                Flash::error("La institucion ya es actor de la solucion seleccionada");


            }

        }
        //dd("Si llegue");
        
        $actoresSoluciones = DB::SELECT("SELECT solucions.tipo_fuente,actor_solucion.tipo_actor,users.name, solucions.verbo_solucion,solucions.sujeto_solucion,solucions.complemento_solucion FROM actor_solucion
            JOIN users ON users.id=actor_solucion.user_id
            JOIN solucions ON solucions.id=actor_solucion.solucion_id");
        
        return view('admin.actores.homeActores')->with(["actoresSoluciones"=>$actoresSoluciones]); 


    }

    // FIN ASIGNACION DE ACTOR SOLUCION


    public function obtenerPropuestas(Request $request, $id){
        
        
        return Solucion::propuestas($id);

    }



    public function enviarCorreoRegistro($institucion, $password){
        $correo= $institucion-> email;
        Mail::send('emails.correoRegistro',["institucion"=>$institucion, "password"=>$password], function($msj) use ($correo) {
            $msj->subject('Inteligencia Productiva - Notificación de registro en Inteligencia Productiva');
            //$msj->to( $correo);
            $msj->to( 'js-arcos@hotmail.com');
        });
    }
    
    public function enviarCorreoAsignacion($institucion, $responsabilidad, $txt_solucion){
        $correo= $institucion-> email;
        Mail::send('emails.correoAsignacion',["institucion"=>$institucion, "responsabilidad"=>$responsabilidad, "txt_solucion"=>$txt_solucion], function($msj) use ($correo){
            $msj->subject('Inteligencia Productiva - Notificación de asignacion de Responsabilidad');
            $msj->to( $correo);
        });
    }

    public function homeActoresAsignados(Request $request){


        $actoresSoluciones = DB::SELECT("SELECT solucions.id, solucions.propuesta_solucion,
        solucions.estado_id, estado_solucion.nombre_estado, actor_solucion.tipo_actor, institucions.nombre_institucion
        from  solucions
        join actor_solucion
        on solucions.id = actor_solucion.solucion_id
        join institucions
        on institucions.id = actor_solucion.institucion_id
        join estado_solucion
        on estado_solucion.id = solucions.estado_id");
        //dd($actoresSoluciones);
        return view('admin.actores.homeActoresAsignados')->with(["actoresSoluciones"=>$actoresSoluciones]); 

    }

    public function homeActoresPorAsignar(Request $request){


        $actoresSolucionesPorAsignar = DB::SELECT("SELECT solucions.id, solucions.responsable_solucion, solucions.corresponsable_solucion, estado_solucion.nombre_estado, solucions.propuesta_solucion
from solucions
JOIN estado_solucion on estado_solucion.id = solucions.estado_id
join mesa_dialogo on mesa_dialogo.id = solucions.mesa_id
where solucions.id not in (SELECT DISTINCT actor_solucion.solucion_id from actor_solucion)");

        return view('admin.actores.homeActoresPorAsignar')->with(["actoresSolucionesPorAsignar"=>$actoresSolucionesPorAsignar]); 

    }

    public function createAsignar(Request $request, $idSolucion )
    {
        
        

        $instituciones = DB::table('institucions')
                        ->select('id','nombre_institucion','siglas_institucion')
                        ->orderBy('nombre_institucion')->get();
                        //dd($instituciones);
        $soluciones =  Solucion::find($idSolucion);

        //dd($soluciones);



        return view('admin.actores.createAsignar')->with(["instituciones"=>$instituciones,
                                                           "soluciones" =>$soluciones ]);
    }

    public function transferirActorSolucion($solucion_id){

        $instituciones = DB::table('institucions')
                        ->select('id','nombre_institucion','siglas_institucion')
                        ->orderBy('nombre_institucion')->get();

        

        $actorSolucion= DB::table('solucions')
                        ->join('actor_solucion','actor_solucion.solucion_id','=','solucions.id')
                        ->join('institucions','institucions.id','=','actor_solucion.institucion_id')
                        ->join('estado_solucion','estado_solucion.id','=','solucions.estado_id')
                        ->select('solucions.*','institucions.nombre_institucion','actor_solucion.tipo_actor','estado_solucion.nombre_estado','actor_solucion.id as actorSolucionID')
                        ->where('solucions.id', $solucion_id )
                        ->first();
        //dd($actorSolucion);


         return view('admin.actores.actualizarActorSolucion')->with(["instituciones"=>$instituciones,
                                                           "actorSolucion" =>$actorSolucion ]);

    }

    public function ActualizarActorSolucion(Request $request,$actorSolucion_id)
    {
        
        $actorSolucion = ActorSolucion::find($actorSolucion_id);
        //dd($actorSolucion);
        $actorSolucion->institucion_id = $request->institucion;
        $actorSolucion->tipo_actor = $request->tipo_actor_id;
        $actorSolucion->save();    
        Flash::success("Transferencia de Institucion Responsable exitosa");
        return redirect('/admin/actores/asignados');
    }



    public function asignarActorSolucion(Request $request)
    {
        //dd($request);
        
        //dd($request->tipo_actor_id);

        $actorSolucion = new ActorSolucion;
        $actorSolucion->user_id = 0;
        $actorSolucion->institucion_id = $request->institucion;
        $actorSolucion->solucion_id = $request->solucion_id;
        $actorSolucion->tipo_actor = $request->tipo_actor_id;
        $actorSolucion->tipo_fuente = 0;
        //dd($actorSolucion);
        $actorSolucion->save();    
        Flash::success("Asignación exitosa");

        $solucion = Solucion::find($request-> solucion_id);
                    $solucion-> estado_id = 2; // 2 = Propuesta con responsable asignado
                    $solucion->save();

        $user = User::find($request-> institucion);

        /*
        // $solucion = Solucion::find($request-> solucion_id);
        // $solucion-> estado_id = 2; // 2 = Propuesta con responsable asignado
        // $solucion->save();

     $actoresSolucionesPorAsignar = DB::SELECT("SELECT solucions.id, solucions.tipo_fuente ,solucions.verbo_solucion, solucions.sujeto_solucion, solucions.complemento_solucion, solucions.estado_id, estado_solucion.nombre_estado
        from  solucions
        join estado_solucion
        on estado_solucion.id = solucions.estado_id
        where solucions.estado_id = 1");

        return view('admin.actores.homeActoresPorAsignar')->with(["actoresSolucionesPorAsignar"=>$actoresSolucionesPorAsignar]); */
        return redirect('/admin/actores/asignados');


    }


 public function cambiarClave($id) {
   // dd("cambiarClave");
        $usuario = User::find($id);
        $usuario->save();
        return view('institucion.clave', compact('usuario'));
     }


     public function updateClave(Request $request, $id) {
     //    dd("updateClave");
        $usuario = User::find($id);
       
        $this->validate($request, [
            'clave1' => 'required',
            'clave2' => 'required'
                  ]
                , [
            'clave1.required' => 'Debe ingresar la clave',
            'clave2.required' => 'Debe ingresar la clave'
        ]);

         if( $request->clave1 !=  $request->clave2){
              Flash::error("Debe ingresar la misma clave");
              return redirect('institucion/cambiar-clave/'.$id);
        }else{
             $usuario->password = bcrypt($request->clave1);
             $usuario->save();
             Flash::success("Clave actualizada correctamente");
             return redirect('institucion/cambiar-clave/'.$id);
        }
    
    }

}

