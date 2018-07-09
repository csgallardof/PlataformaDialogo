<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institucion;
use App\User;
use App\InstitucionUsuario;
use DB;
use Illuminate\Support\Facades\Auth;

class InstitucionUsuarioController extends Controller
{

     public function index() {
        $institucionUsuario =   InstitucionUsuario::all();
        return view('admin.institucionusuario.home')->with(["institucionUsuarios" => $institucionUsuario]);
    }
    
     public function create() {
        $usuario = User::all();
        $institucion = Institucion::all();
        return view('admin.institucionusuario.create')->with(["usuario" => $usuario, "institucion" => $institucion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function institucionesSectoresLista($id) {

        //$consejosInstitucions = ConsejoInstitucion::where("consejo_id", "=", $consejo_id)->get();

        $consejosInstitucions = DB::table('institucion_usuario')
                        ->select('institucion_usuario.id','institucions.nombre_institucion')
                        ->join('institucions', 'institucions.id', '=', 'institucion_usuario.institucion_id')
                        ->join('user', 'user.id', '=', 'institucion_usuario.usuario_id')
                        ->where('institucion_usuario.institucion_id', '=', $id)->get();
        return json_encode($consejosInstitucions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $institucionusuario = new InstitucionUsuario();
        $institucionusuario->usuario_id = $request->usuario_id;
        $institucionusuario->institucion_id = $request->institucion_id;
        $institucionusuario->save();
        return redirect("/admin/listar-institucion-usuario");
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
