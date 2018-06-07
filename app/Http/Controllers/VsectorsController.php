<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vsector;

class VsectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vsectors = Vsector::all();
        return view('admin.vsectors.home', compact('vsectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.vsectors.create');
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
        $vsector = new Vsector;
        $this ->validate($request,[
            'nombre_vsector' =>'required|unique:vsectors'
        ]);
        $vsector->nombre_vsector = $request->nombre_vsector;
        $vsector->save();
        return redirect('admin/vsectors');

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
        $item = sector::find($id);

        return view('admin.vsectors.edit', compact('item'));
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
        $vsector = vsector::find($id);
        $this ->validate($request,[
            'nombre_vsector' =>'required'
        ]);
        $vsector->nombre_vsector = $request->nombre_vsector;
        $vsector->save();
        return redirect('vsectors');
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
