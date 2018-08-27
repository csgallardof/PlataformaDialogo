<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;

use DB;
use Laracasts\Flash\Flash;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller {
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $roles = Role::all();
        //dd($roles);
        return view('admin.rol.home')->with( ["roles" => $roles] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request) {
        
        return view('admin.rol.home');
    }

   
  
}
