<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pajustada;

class PajustadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pajustadas = pajustada::all();
        return view('admin.pajustadas.home', compact('pajustadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pajustadas.create');
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
        $pajustada = new Pajustada;
        $this ->validate($request,[
            'nombre_pajustada' =>'required|unique:pajustadas'
        ]);
        $pajustada->nombre_pajustada = $request->nombre_pajustada;
        $pajustada->save();
        return redirect('admin/pajustadas');
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
        $item = pajustada::find($id);

        return view('admin.pajustadas.edit', compact('item'));
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
         //
        $pajustada = pajustada::find($id);
        $this ->validate($request,[
            'nombre_pajustada' =>'required'
        ]);
        $pajustada->nombre_pajustada = $request->nombre_pajustada;
        $pajustada->save();
        return redirect('pajustadas');
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




