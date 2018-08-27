<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\ActorSolucion;
use App\Solucion;
use App\User;
use App\Pajustada;
use DB;
use Laracasts\Flash\Flash;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

          return redirect('admin/listar-usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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
     // dd($id);

     /*    $rolUsuario = RoleUser::find($id);

         $usuario = User::find( $rolUsuario -> user_id);

        $rol = Role::find($rolUsuario -> role_id);

        $roles = Role::all();
         return view('admin.rolusuario.edit')->with(['rolUsuario' => $rolUsuario, "usuario" => $usuario, "rol" => $rol,
            "roles" => $roles]);

*/
        $usuario = User::find($id);
      // dd($usuario);
       /* $this->validate($request, [
            'clave' => 'required'
                  ]
                , [
            'clave.required' => 'Debe ingresar la contraseña'
        ]);


        $usuario->name = $request->clave;*/
        $usuario->save();

    //  return redirect('admin/listar-usuario');


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
          // dd( "diferentes");
           // $this-> 'La clave debe ser la misma';
            //Flash::success("Mensaje de prueba1");
            //flash('Message1')->error()->important();

            //flash('mensaje', 'Este es el mensaje');


             flash('mensaje')->important;
             dd(flash('mensaje')->important);
        }else{
            Flash::success("Mensaje de prueba2");
        }

//dd( $request->clave1);
        $usuario->password = bcrypt($request->clave1);

         $usuario->save();

        return redirect('admin/listar-usuario');
    }


}
