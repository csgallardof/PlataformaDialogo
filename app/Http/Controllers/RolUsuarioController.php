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

public function index(Request $request) {

    

//dd($request->input('search'));
if($request->input('search') == null){
$listaRolUsuario = DB::table('role_user')
                ->select('role_user.*')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->paginate(10); 
}else{ 
   $listaRolUsuario = DB::table('role_user')
                 ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->select('role_user.*')
                 ->where('users.name', 'LIKE',  '%'.$request->input('search').'%' )
                 ->paginate(10); 
}
    


     $listaRoles = Role::all();

     $listaUsuarios = User::all();

  // dd($listaRolUsuario);

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
                        ->orwhere('role_user.user_id', '=', $request->user_id)->get();
         
        //dd($rolusuario->user_id);
                  $rolusuario->save();

         
        return redirect("/admin/listar-rol-usuarios");
    }

public function edit($id) {
         $rolUsuario = RoleUser::find($id);

         $usuario = User::find( $rolUsuario -> user_id);

        $rol = Role::find($rolUsuario -> role_id);

        $roles = Role::all();
      //dd($rol );
        return view('admin.rolusuario.edit')->with(['rolUsuario' => $rolUsuario, "usuario" => $usuario, "rol" => $rol,
            "roles" => $roles]);

    }

 public function update(Request $request, $id) {
        $rolusuario = RoleUser::find($id);
        $rolusuario->role_id = $request->rol_id;
        $rolusuario->save();
        return redirect("admin/rolUsuario" );
    }

}