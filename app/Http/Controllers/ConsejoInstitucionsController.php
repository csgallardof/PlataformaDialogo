<?php

namespace App\Http\Controllers;

use App\ConsejoInstitucion;
use App\Institucion;
use App\ConsejoSectorial;
use DB;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsejoInstitucionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $consejosInstitucions = ConsejoInstitucion::all();
        return view('admin.consejoinstitucion.home')->with(["consejoInstituciones" => $consejosInstitucions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $consejo = ConsejoSectorial::all();
        $institucion = Institucion::all();
        return view('admin.consejoinstitucion.create')->with(["consejo" => $consejo, "institucion" => $institucion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function institucionesSectoresLista($consejo_id) {

        //$consejosInstitucions = ConsejoInstitucion::where("consejo_id", "=", $consejo_id)->get();

        $consejosInstitucions = DB::table('consejo_institucions')
                        ->join('institucions', 'institucions.id', '=', 'consejo_institucions.institucion_id')
                        ->join('consejo_sectorials', 'consejo_sectorials.id', '=', 'consejo_institucions.consejo_id')
                        ->where('consejo_institucions.consejo_id', '=', $consejo_id)->get();
        return json_encode($consejosInstitucions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $consejoInstitucion = new ConsejoInstitucion();
        $consejoInstitucion->consejo_id = $request->consejo_id;
        $consejoInstitucion->institucion_id = $request->institucion_id;
        $consejoInstitucion->save();
    }

    /*

     * Lista todos los archivos de la tabla */

    /**
     * Display the specified resource.
     *
     * @param  \App\consejo_institucions  $consejo_institucions
     * @return \Illuminate\Http\Response
     */
    public function show(consejo_institucions $consejo_institucions) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\consejo_institucions  $consejo_institucions
     * @return \Illuminate\Http\Response
     */
    public function edit(consejo_institucions $consejo_institucions) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\consejo_institucions  $consejo_institucions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consejo_institucions $consejo_institucions) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\consejo_institucions  $consejo_institucions
     * @return \Illuminate\Http\Response
     */
    public function destroy(consejo_institucions $consejo_institucions) {
        //
    }

}
