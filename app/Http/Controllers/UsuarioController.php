<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\ActorSolucion;
use App\Solucion;
use App\User;
use App\Pajustada;
use App\RoleUser;
use App\InstitucionUsuario;
use DB;
use Laracasts\Flash\Flash;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuditoriaController;

class UsuarioController extends Controller {
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $instituciones = Institucion::where('nombre_institucion', 'like', '%' . $request->input('search') . '%')
                        ->orwhere('siglas_institucion', 'like', '%' . $request->input('search') . '%')->paginate(10);
        $usuarios = User::where('name', 'like', '%' . $request->input('search') . '%')
                        ->orwhere('apellidos', 'like', '%' . $request->input('search') . '%')->paginate(10);
    
        return view('admin.usuario.home')->with(["instituciones" => $instituciones
                                                  ,"usuarios" => $usuarios]  );
    }

    public function create() {
        return view('admin.usuario.create');
    }

    public function store(Request $request) {
        
        
        $usuario = new User;
        $this->validate($request, [
            'nombre_usuario' => 'required',
            'apellidos_usuario' => 'required',
            'cedula' => 'required|unique:users',
            'email' => 'required|unique:users'
                  ]
                , [
            'nombre_usuario.required' => 'Debe ingresar el nombre',
            'apellidos_usuario.required' => 'Debe ingresar los apellidos',
            'cedula.unique' => 'Ya existe un usuario con esta cédula',
            'email.unique' => 'Ya existe un usuario con ese email'
        ]);


        $usuario->name = $request->nombre_usuario;
        $usuario->apellidos = $request->apellidos_usuario;
        $usuario->cedula = $request->cedula;
        $usuario->email = $request->email;
       
        $password = str_split($request->nombre_usuario,3)[0].
                    str_split($request->email,3)[0].
                    substr($request->cedula, -4);  
        $usuario->password = bcrypt($password);

        $usuario->telefono = $request->telefono;
        $usuario->celular = $request->celular;
        $usuario->institucion_id = 0;//por verificar si debe ser ingresada informacion o no en este campo

        $usuario->save();

      
        if($request->crear_usuario_consejo =1 ){

           //dd('institucion_id'.$request->institucion_id);

         
           $usuario_consejo = DB::table('users')
                        ->select('*')
                        ->join('institucion_usuarios', 'institucion_usuarios.usuario_id', '=', 'users.id')
                        ->join('institucions', 'institucions.id', '=', 'institucion_usuarios.institucion_id')
                        ->where('institucions.id', '=', $request->institucion_id)
                        ->get();


            if ($usuario_consejo->isEmpty()){

                //dd('uno');
                $usuario->save();

               $usuarioGuardado = DB::select('SELECT * from users where name ="'.$request->nombre_usuario.'" and cedula = "'.$request->cedula.'"');
               $idTabla = $usuarioGuardado[0] ->id;  
               $nombreTabla = "users";
               $proceso = "insert";
               $usuario = Auth::user()->name;
               $cedula = Auth::user()->cedula;
               $observacion = "Ninguna";
               AuditoriaController::guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion);


             // insert en la tabla institucion usuario

                $institucion_usuario_sql= DB::select('SELECT MAX(users.id) as UltimoUsuario from users');
                //dd($usuario_institucion_sql[0]->UltimoUsuario);
                

                $institucion_usuario = new InstitucionUsuario;
                $institucion_usuario->institucion_id = $request->institucion_id; 
                $institucion_usuario->usuario_id = $institucion_usuario_sql[0]->UltimoUsuario;
                $institucion_usuario->save();

                

                $role = new RoleUser;
                //dd('llego');
                $role->user_id = $institucion_usuario_sql[0]->UltimoUsuario;
                $role->role_id = 2;
                $role->save();

                
                Flash::success("El usuario se registró exitosamente");
                return redirect('consejo-sectorial/listar-usuario');

           }else{

                Flash::success("La institucion ya cuenta con un usuario asigando");
                return redirect('consejo-sectorial/listar-usuario');
           }



           }


        return redirect('admin/listar-usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardarUsuarioConsejo(Request $request) { 
         $usuario = new User;
         $institucionusuario = new InstitucionUsuario;
         $roleUser = new RoleUser;

         $this->validate($request, [
            'nombre_usuario' => 'required',
            'apellidos_usuario' => 'required',
            'cedula' => 'required|unique:users',
            'email' => 'required|unique:users'
                  ]
                , [
            'nombre_usuario.required' => 'Debe ingresar el nombre',
            'apellidos_usuario.required' => 'Debe ingresar los apellidos',
            'cedula.unique' => 'Ya existe un usuario con esta cédula',
            'email.unique' => 'Ya existe un usuario con ese email'
        ]);

        $usuario->name = $request->nombre_usuario;
        $usuario->apellidos = $request->apellidos_usuario;
        $usuario->cedula = $request->cedula;
        $usuario->email = $request->email;
        $usuario->institucion_id = $request->institucion_id;
        $usuario->remember_token = $request->_token;
       
        $password = str_split($request->nombre_usuario,3)[0].
                    str_split($request->email,3)[0].
                    substr($request->cedula, -4);  
        $usuario->password = bcrypt($password);

        $usuario->telefono = $request->telefono;
        $usuario->celular = $request->celular;
        $usuario->estado = 1; // 1 estado activo
     
      $institucionUsuariosUnico =  DB::select('SELECT * from institucion_usuarios where institucion_id ='.$request->institucion_id.' and activo = 1 limit 1');
               
       if(empty($institucionUsuariosUnico)){
        $usuario->save(); 


        $usuarioGuardado = DB::select('SELECT * from users where email ="'.$request->email.'" and cedula = "'.$request->cedula.'" limit 1');
 

       if (!empty($usuarioGuardado)){
           $institucionusuario->institucion_id = $request->institucion_id; 
           $institucionusuario->usuario_id = $usuarioGuardado[0]->id;
           $institucionusuario->activo = 1;
         
             $institucionUsuariosquery =  DB::select('SELECT * from institucion_usuarios where institucion_id ='.$request->institucion_id.' and usuario_id = '.$usuarioGuardado[0]->id.' limit 1');
     
              if (empty($institucionUsuariosquery)){//para verificar que no este duplicado

                $institucionusuario->save();
                   // return redirect('consejo-sectorial/listar-usuario');
                  
                                  
              }else{
                   Flash::error("El usuario ya se encuentra asignado a una institución");
                   return redirect('consejo-sectorial/listar-usuario');
                 
               }

             $roleUser ->role = 2;//2 rol como institución
             $roleUser ->user = $usuarioGuardado[0]->id; 
              $roleUserQuery =  DB::select('SELECT * from role_user where role_id = 2 and user_id = '.$usuarioGuardado[0]->id.' limit 1');
     
              if (empty($roleUserQuery)){
                    $roleUser->save();
                  //  return redirect('consejo-sectorial/listar-usuario');
                  
              }else{
                   Flash::error("El usuario ya se encuentra asignado a una institución");
                   return redirect('consejo-sectorial/listar-usuario');
                 
               }
         

               return redirect('consejo-sectorial/listar-usuario');
              }else{ 
                   Flash::error("El usuario ya se encuentra asignado a una institución");
                   return redirect('consejo-sectorial/listar-usuario');
                 
            }

       }else{
               Flash::error("Ya se encuentra registrado un usuario para esta institución");
               //return redirect('consejo-sectorial/listar-usuario');
               return redirect('consejo-sectorial/nuevo-usuario-institucion');
             }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = User::find($id);
        return view('admin.usuario.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
         $usuario = User::find($id);
       
        $this->validate($request, [
            'nombre_usuario' => 'required',
            'apellidos_usuario' => 'required',
            'cedula' => 'required',
            'email' => 'required'
                  ]
                , [
            'nombre_usuario.required' => 'Debe ingresar el nombre',
            'apellidos_usuario.required' => 'Debe ingresar los apellidos',
            'cedula.required' => 'Debe ingresar la cédula',
            'email.required' => 'Debe ingresar el email'
        ]);


        $usuario->name = $request->nombre_usuario;
        $usuario->apellidos = $request->apellidos_usuario;
        $usuario->cedula = $request->cedula;
        $usuario->email = $request->email;
        $usuario->password = $request->password;//falta la encriptacion de la clave
        $usuario->telefono = $request->telefono;
        $usuario->celular = $request->celular;
      //  $usuario->institucion_id = 0;//por verificar si debe ser ingresada informacion o no en este campo


         $usuario->save();

   $usuarioGuardado = DB::select('SELECT * from users where name ="'.$request->nombre_usuario.'" and cedula = "'.$request->cedula.'"');
   $idTabla = $usuarioGuardado[0] ->id;  
   $nombreTabla = "users";
   $proceso = "update";
   $usuario = Auth::user()->name;
   $cedula = Auth::user()->cedula;
   $observacion = "Ninguna";
   AuditoriaController::guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion );

        return redirect('admin/listar-usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request) {
        
        return view('admin.usuario.home');
    }

   
    public function enviarCorreoRegistro($institucion, $password) {
        $correo = $institucion->email;
        Mail::send('emails.correoRegistro', ["institucion" => $institucion, "password" => $password], function($msj) use ($correo) {
            $msj->subject('Inteligencia Productiva - Notificación de registro en Inteligencia Productiva');
            //$msj->to( $correo);
            $msj->to('csgallardof@gmail.com');
        });
    }

    public function enviarCorreoAsignacion($institucion, $responsabilidad, $txt_solucion) {
        $correo = $institucion->email;
        Mail::send('emails.correoAsignacion', ["institucion" => $institucion, "responsabilidad" => $responsabilidad, "txt_solucion" => $txt_solucion], function($msj) use ($correo) {
            $msj->subject('Inteligencia Productiva - Notificación de asignacion de Responsabilidad');
            $msj->to($correo);
        });
    }

    public function cambiarClave($id) {
        $usuario = User::find($id);
        $usuario->save();
        return view('admin.usuario.clave', compact('usuario'));
     }


     public function updateClave(Request $request, $id) {
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
              return redirect('admin/cambiar-clave/'.$id);
        }else{
             $usuario->password = bcrypt($request->clave1);
             $usuario->save();
             Flash::success("Clave actualizada correctamente");
               return redirect('admin/listar-usuario');
        }
    
    }

    public function usuarios_cs( ) {
        
        $usuarios= DB::select('SELECT *,users.id as id_usuario, institucions.siglas_institucion        
        from users
        inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
        inner join institucions on institucions.id = institucion_usuarios.institucion_id
        inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
        inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
        where consejo_sectorials.id=(select consejo_sectorials.id
        from users
        inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
        inner join institucions on institucions.id = institucion_usuarios.institucion_id
        inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
        inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
        where users.id ='.Auth::user()->id.') order by users.id desc');
   
        return view('admin.usuario.home-cs')->with(["usuarios"=>$usuarios]);
    }

    public function editarUsuarioConsejo($id) { 
        $usuario = User::find($id);
        $usuarios_consejo= DB::select('SELECT institucions.id, institucions.nombre_institucion, institucions.siglas_institucion from institucions
        inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
        inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
        where consejo_sectorials.id=(select consejo_sectorials.id
        from users
        inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
        inner join institucions on institucions.id = institucion_usuarios.institucion_id
        inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
        inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
        where users.id ='.Auth::user()->id.') order by institucions.id desc');   
//dd($usuarios_consejo);
        $institucion_usuario= DB::select('SELECT institucion_id, usuario_id      
        from institucion_usuarios 
        where usuario_id ='.$usuario ->id.'');

  
        return view('admin.usuario.edit-cs')->with(["usuarios_consejo" => $usuarios_consejo,
                                                    "usuario" =>$usuario, "institucion_usuario" => $institucion_usuario]);
        
    }


    public function nuevo_usuario_institucion() {

        $usuario_consejo= DB::select('SELECT institucions.id , institucions.nombre_institucion, institucions.siglas_institucion        
        from institucions
        inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
        inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
        where consejo_sectorials.id=(select consejo_sectorials.id
        from users
        inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
        inner join institucions on institucions.id = institucion_usuarios.institucion_id
        inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
        inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
        where users.id ='.Auth::user()->id.') order by institucions.id desc');


        return view('admin.usuario.create-cs')->with(["usuario_consejo" => $usuario_consejo]);
    }


    public function updateUsuarioConsejo(Request $request,$id) {
        $institucionUsuario = new InstitucionUsuario;
        $usuario = User::find($id);
        $estado = $_REQUEST['estado'];
               
        $this->validate($request, [
            'nombre_usuario' => 'required',
            'apellidos_usuario' => 'required',
            'cedula' => 'required',
            'email' => 'required'
                  ]
                , [
            'nombre_usuario.required' => 'Debe ingresar el nombre',
            'apellidos_usuario.required' => 'Debe ingresar los apellidos',
            'cedula.required' => 'Debe ingresar la cédula',
            'email.required' => 'Debe ingresar el email'
        ]);


        $usuario->name = $request->nombre_usuario;
        $usuario->apellidos = $request->apellidos_usuario;
        $usuario->cedula = $request->cedula;
        $usuario->email = $request->email;
        //$usuario->password = $request->password;//falta la encriptacion de la clave
        $usuario->telefono = $request->telefono;
        $usuario->celular = $request->celular;
        if($estado=='Inactivo'){           
            $usuario->estado = 0;
            $estadoUsuarioInstitucion = 0;
        }else{
          $usuario->estado = 1;
          $estadoUsuarioInstitucion = 1;
        }
        
      //  $usuario->institucion_id = 0;//por verificar si debe ser ingresada informacion o no en este campo

     //dd($usuario->estado );

         $usuario->save();

 $institucionUsuario =  DB::select('SELECT * from institucion_usuarios where institucion_id ='.$request->institucion_id.' and usuario_id ='.$usuario->id.' limit 1');
 $idUsuario = $institucionUsuario[0]->usuario_id;
 $idInstitucion = $institucionUsuario[0]->institucion_id;

$institucionusuario = new  InstitucionUsuario;
  
   $institucionusuario->institucion_id = $idInstitucion; 
           $institucionusuario->usuario_id = $idUsuario;
           $institucionusuario->activo = $estadoUsuarioInstitucion;
        //$institucionUsuario[0]->activo =  $estadoUsuarioInstitucion;
       
        $institucionusuario->save();


   $usuarioGuardado = DB::select('SELECT * from users where name ="'.$request->nombre_usuario.'" and cedula = "'.$request->cedula.'"');
   $idTabla = $usuarioGuardado[0] ->id;  
   $nombreTabla = "users";
   $proceso = "update";
   $usuario = Auth::user()->name;
   $cedula = Auth::user()->cedula;
   $observacion = "Actualización desde consejo sectorial";
   AuditoriaController::guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion );
   return redirect('consejo-sectorial/listar-usuario');
      }

}
