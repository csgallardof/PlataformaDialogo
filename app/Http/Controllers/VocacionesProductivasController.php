<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;
use File;
use Laracasts\Flash\Flash;

class VocacionesProductivasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $provincias = Provincia::orderBy('nombre_provincia','ASC')->get();
        return view('admin.vproductivas.home', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.ambits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idProvincia = $request-> provincia;
        if($idProvincia > 0 && $idProvincia <= 24){
            
            $detalleProvincias=array(
                1=>"azuay",
                2=>"bolivar",
                3=>"canar",
                4=>"carchi",
                5=>"chimborazo",
                6=>"cotopaxi",
                7=>"eloro",
                8=>"esmeraldas",
                9=>"galapagos",
                10=>"guayas",
                11=>"imbabura",
                12=>"loja",
                13=>"losrios",
                14=>"manabi",
                15=>"moronasantigo",
                16=>"napo",
                17=>"orellana",
                18=>"pastaza",
                19=>"pichincha",
                20=>"santaelena",
                21=>"santodomingo",
                22=>"sucumbios",
                23=>"tungurahua",
                24=>"zamorachinchipe",

                // "azuay","bolivar","cañar","carchi","chimborazo","cotopaxi",
                // "eloro","esmeraldas","galapagos","guayas","imbabura","loja",
                // "losrios","manabi","moronasantigo","napo","orellana","pastaza",
                // "pichincha","santaelena","santodomingo","sucumbios","tunguraha","zamorachinchipe",
            );

            $nombreArchivo = "vocaciones_productivas_".$detalleProvincias[$idProvincia].".jpg";
            $file = $request->file('imagen');   //obtenemos el campo file definido en el formulario
             \Storage::disk('local2')->put($nombreArchivo,  \File::get($file)); 
        }else{

        }

        $provincia = Provincia::find($idProvincia);

        Flash::success("Se edit&oacute; la vocaci&oacute;n productiva de ".$provincia-> nombre_provincia." correctamente.");
        return redirect('admin/vocaciones_productivas');
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
        $item = ambit::find($id);

        return view('admin.ambits.edit', compact('item'));
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
    }
}
