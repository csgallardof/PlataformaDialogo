<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thematic;


class ThematicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $thematics = Thematic::all();
        return view('admin.thematics.home', compact('thematics'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.thematics.create');

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
        $thematic = new Thematic;
        $this ->validate($request,[
            'nombre_thematic' =>'required|unique:thematics'
        ]);
        $thematic->nombre_thematic = $request->nombre_thematic;
        $thematic->save();
        //dd($thematic);
        return redirect('admin.thematics');
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
         $item = thematic::find($id);

        return view('admin.thematics.edit', compact('item'));
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
        $thematic = thematic::find($id);
        $this ->validate($request,[
            'nombre_thematic' =>'required'
        ]);
        $thematic->nombre_thematic = $request->nombre_thematic;
        $thematic->save();
        return redirect('thematics');
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
