<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\InstitucionUsuario;
use App\Institucion;
use DB;
use App\RoleUser;
use App\Role;
use Illuminate\Support\Facades\Auth;


class RolUsuarioController extends Controller
{

     /*public function index() {
        $listaRolUsuario =   RoleUser::all()->sortBy('user_id');

        $listaRoles = Role::all();

        $listaUsuarios = User::all();
      
    
        //dd($rolUsuario);
        return view('admin.rolusuario.home')->with( ["listaRolUsuario" => $listaRolUsuario
                                                      ,"listaRoles" => $listaRoles
                                                      ,"listaUsuarios" => $listaUsuarios]);
}*/
public function index(Request $request) {

     //$listaRolUsuario =   RoleUser::all()->sortBy('user_id')->simplePaginate(10);

     $listaRolUsuario =   DB::table('role_user')->paginate(10);


     $listaRoles = Role::all();

     $listaUsuarios = User::all();


       /* $listaRoles = Role::where('nombre_role', 'like', '%' . $request->input('search') . '%')->paginate(10);
        
        $listaUsuarios = User::where('name', 'like', '%' . $request->input('search') . '%')
                        ->orwhere('apellidos', 'like', '%' . $request->input('search') . '%')->paginate(10);
    */

        return view('admin.rolusuario.home')->with( ["listaRolUsuario" => $listaRolUsuario
                                                      ,"listaRoles" => $listaRoles
                                                      ,"listaUsuarios" => $listaUsuarios]);
    }

public function create() {
        $usuario = User::all()->sortBy('apellidos');
        $rol = Role::all()->sortBy('nombre_role');
        return view('admin.rolusuario.create')->with(["usuario" => $usuario, "rol" => $rol]);
    }

  public function store(Request $request) {
        $rolusuario = new RoleUser;
        $rolusuario->user_id = $request->usuario_id;
        $rolusuario->role_id = $request->rol_id;
       // dd($request->rol_id);
         $rolUsuarios = DB::table('role_user')
                        ->select('role_user.id','users.name', 'users.apellidos', 'users.email')
                        ->join('roles', 'roles.id', '=', 'role_user.role_id')
                        ->join('users', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', '=', $request->role_id)
                        ->where('role_user.user_id', '=', $request->user_id)->get();
         
        //dd($rolusuario->user_id);
                  $rolusuario->save();

         
        return redirect("/admin/listar-rol-usuarios");
    }

public function edit($id) {
        $usuario = User::all();
        $rol = Role::all();
        $item = RoleUser::find($id);
        return view('admin.rolusuario.edit')->with(['item' => $item, "usuario" => $usuario, "rol" => $rol]);
    }

}
