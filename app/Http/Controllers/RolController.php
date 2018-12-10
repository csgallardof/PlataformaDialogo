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
    public function index() {

        $roles = role::all();
        return view('admin.rol.home', compact('roles'));
    }


    public function create(){
        return view('admin.rol.create');
    }    

    public function store(Request $request)
    {      
        
        $rol = new Role;
        $this ->validate($request,[
            'nombre_role' =>'required|unique:roles'
        ]);
        $rol->nombre_role = $request->nombre_role;
        $rol->save();
        return redirect('admin/roles');
    }

    public function edit($id)
    {
        //
        $item = role::find($id);

        return view('admin.rol.edit', compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        $item = role::find($id);
        $item->nombre_role= $request->nombre_role;
        $item->save();

        return redirect()->route('roles.index');
    }

  
}
