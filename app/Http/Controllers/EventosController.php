<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Provincia;

use App\User;
use App\Role;
use Laracasts\Flash\Flash;
use DB;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;


    
use App\Auth\Login;
class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::all();
        return view('admin.eventos.home', compact('eventos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request->nombre_evento);
        $eventos = new Evento;
        $this ->validate($request,[
            'nombre_evento' =>'required|unique:eventos'
        ]);
        
        $eventos->nombre_evento = $request->nombre_evento;
        $eventos->created_at   = $request->calendar;
        $eventos->provincia_id   = $request->provincia_id;
        $eventos->save();
        return redirect('/listar-eventos/');
    }


    public function recuperarEventos(){

        //$eventos = Evento::all()->sortByDesc("created_at")->paginate(20);
        $eventos = Evento::where('id','>',0)->orderBy('created_at', 'DESC')->paginate(20);
        
        //$eventos = Evento::where('created_at', '<', 'now()')->orderBy('created_at', 'DESC')->paginate(20);
        //$eventos=DB::SELECT("SELECT * from eventos where created_at < now() order by created_at DESC")->paginate(20);

        
        $provincias = Provincia::all();
        return view('admin.eventos.listareventos')->with(["eventos"=>$eventos, "provincias"=>$provincias]);

    }

  public function nuevoEvento(){

    $provincias = Provincia::all();

     return view('admin.eventos.create')->with(["provincias"=>$provincias]);

  }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = evento::find($id);

        $provincias = Provincia::all();
        //dd(\Carbon\Carbon::parse($item->from_date)->format('m-d-Y'));
        $fecha = \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        return view('admin.eventos.edit', compact('item'))->with(["provincias"=>$provincias,"fecha"=>$fecha]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

         $evento = Evento::find($id);
         $this ->validate($request,[
             'nombre_evento' =>'required'
         ]);
        $evento->nombre_evento = $request->nombre_evento;
        $evento->created_at   = $request->calendar;
        $evento->provincia_id   = $request->provincia_id;
        $evento->save();
        Flash::success("Se ha actualizado el evento exitosamente");
        return redirect('/listar-eventos/');         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $evento = Evento::find($id);
        $evento->delete();
        Flash::success("Se ha eliminado el evento exitosamente");
        return redirect('/listar-eventos/');   
    }
}
