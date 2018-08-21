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

     public function index() {
        $rolUsuario =   RoleUser::all()->sortBy('user_id');
      
      
         // $rolUsuario = RoleUser::all();
        //dd($rolUsuario);
        return view('admin.rolusuario.home')->with( ["rolUsuario" => $rolUsuario] );
}

}
