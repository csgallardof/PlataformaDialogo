<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institucion;
use App\User;
use App\InstitucionUsuario;
use DB;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Mail;

class InstitucionUsuarioController extends Controller
{

     public function index() {
        $institucionUsuario =   InstitucionUsuario::all();
        
        //dd($institucionUsuario);

        return view('admin.institucionusuario.home')->with(["institucionUsuarios" => $institucionUsuario]); 
    }
    
     public function create() {
        $usuario = User::all()->sortBy('apellidos');
        $institucion = Institucion::all()->sortBy('nombre_institucion');
        return view('admin.institucionusuario.create')->with(["usuario" => $usuario, "institucion" => $institucion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function institucionesUsuariosLista($institucion_id) {

        //$consejosInstitucions = ConsejoInstitucion::where("consejo_id", "=", $consejo_id)->get();

        $institucionUsuarios = DB::table('institucion_usuarios')
                        ->select('institucion_usuarios.id','users.name', 'users.apellidos', 'users.email')
                        ->join('institucions', 'institucions.id', '=', 'institucion_usuarios.institucion_id')
                        ->join('users', 'users.id', '=', 'institucion_usuarios.usuario_id')
                        ->where('institucion_usuarios.institucion_id', '=', $institucion_id)->get();
        return json_encode($institucionUsuarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $institucionusuario = new InstitucionUsuario;
        $institucionusuario->usuario_id = $request->usuario_id;
        $institucionusuario->institucion_id = $request->institucion_id;
        
         $institucionUsuarios = DB::table('institucion_usuarios')
                        ->select('institucion_usuarios.id','users.name', 'users.apellidos', 'users.email')
                        ->join('institucions', 'institucions.id', '=', 'institucion_usuarios.institucion_id')
                        ->join('users', 'users.id', '=', 'institucion_usuarios.usuario_id')
                        ->where('institucion_usuarios.institucion_id', '=', $request->institucion_id)
                        ->where('institucion_usuarios.usuario_id', '=', $request->usuario_id)->get();
         if ($institucionUsuarios == null){
                  $institucionusuario->save();
         
         }
        return redirect("/admin/listar-institucion-usuarios");
    }

    /*

     * Lista todos los archivos de la tabla */

    /**
     * Display the specified resource.
     *
     * @param  \App\institucion_usuario  $institucion_usuario
     * @return \Illuminate\Http\Response
     */
    public function show(institucion_usuario $institucion_usuario) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\institucion_usuario  $institucion_usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $usuario = User::all();
        $institucion = Institucion::all();
        $item = ConsejoInstitucion::find($id);
        return view('admin.institucionusuario.edit')->with(['item' => $item, "usuario" => $usuario, "institucion" => $institucion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\institucion_usuario  $institucion_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $institucionusuario = consejoInstitucion::find($id);

        $institucionusuario->usuario_id = $request->usuario_id;
        $institucionusuario->institucion_id = $request->institucion_id;
        $institucionusuario->save();
        return redirect("editar-institucion-usuarios/" . $institucionusuario->consejo_id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\institucion_usuario  $institucion_usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      
        $institucionusuario = institucionUsuario::find($id);
        $institucionusuario->delete();
       
        return redirect("/admin/listar-institucion-usuarios");
    }

}
