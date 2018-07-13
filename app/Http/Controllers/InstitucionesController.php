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

class InstitucionesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $instituciones = Institucion::where('nombre_institucion', 'like', '%' . $request->input('search') . '%')
                        ->orwhere('siglas_institucion', 'like', '%' . $request->input('search') . '%')->paginate(10);
        return view('admin.instituciones.home')->with(["instituciones" => $instituciones]);
    }

    public function create() {
        return view('admin.instituciones.create');
    }

    public function store(Request $request) {
        $institucion = new Institucion;
        $this->validate($request, [
            'nombre_institucion' => 'required|unique:institucions',
            'siglas_institucion' => 'required|unique:institucions'
                ]
                , [
            'nombre_institucion.unique' => 'Ya existe otra institucion con este nombre',
            'siglas_institucion.unique' => 'Ya existe un nombre con estas siglas'
        ]);


        $institucion->nombre_institucion = $request->nombre_institucion;
        $institucion->siglas_institucion = $request->siglas_institucion;
        $institucion->save();
        return redirect('admin/listar-institucion');
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
        $item = Institucion::find($id);
        return view('admin.instituciones.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $institucion = Institucion::find($id);
        $this->validate($request, [
            'nombre_institucion' => 'required',
            'siglas_institucion' => 'required'
        ]);
        $institucion->nombre_institucion = $request->nombre_institucion;
        $institucion->siglas_institucion = $request->siglas_institucion;
        $institucion->save();
        //return redirect()->route('instituciones.index');


        return redirect('admin/listar-institucion');
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
        
        return view('admin.instituciones.home');
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

}
