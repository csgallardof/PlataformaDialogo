<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sipoc;

class SipocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sipocs = sipoc::all();
        return view('admin.sipocs.home', compact('sipocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sipocs.create');
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
        //return $request->all();

        $sipoc = new Sipoc;
        $this ->validate($request,[
            'nombre_sipoc' =>'required|unique:sipocs'
        ]);
        $sipoc->nombre_sipoc = $request->nombre_sipoc;
        $sipoc->save();
        return redirect('admin/sipocs');

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
       
        $item = sipoc::find($id);

        return view('admin.sipocs.edit', compact('item'));
       //return $id;
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
        $sipoc = sipoc::find($id);
        $this ->validate($request,[
            'nombre_sipoc' =>'required'
        ]);
        $sipoc->nombre_sipoc = $request->nombre_sipoc;
        $sipoc->save();
        return redirect('sipocs');
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
