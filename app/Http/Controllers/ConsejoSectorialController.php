<?php

/* * *****************************************************************************
 * * Dialogo Nacional 2018                                                      **
 * * Módulo de Adminsitración de Consejos sectoriales                           **
 * * Funcionalidad: Controlador para realizar CRUD                              **
 * * Desarrollado por: Fabian Quinatoa                                          **
 * * Modificado por:                                                            **
 * ***************************************************************************** */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ConsejoSectorial;
use DB;
use Laracasts\Flash\Flash;

class ConsejoSectorialController extends Controller {

    public function create() {
        return view('admin.consejosectorial.create');
    }

    public function edit($id) {
        $item = ConsejoSectorial::find($id);
        return view('admin.consejosectorial.edit', compact('item'));
    }

    public function index(Request $request) {
        $consejosSectoriales = ConsejoSectorial::where('nombre_consejo', 'like', '%' . $request->input('search') . '%')
                ->paginate(5);
        return view('admin.consejosectorial.home')->with(["consejosSectoriales" => $consejosSectoriales]);
    }

    public function store(Request $request) {
        $consejoSectorial = new ConsejoSectorial;
         $this->validate($request, [
            'nombre_consejo' => 'required|unique:consejo_sectorials' 
                ]
                , [
            'nombre_consejo.unique' => 'Ya existe el consejo sectorial' 
            
        ]);

        $consejoSectorial->nombre_consejo = $request->nombre_consejo;
        $consejoSectorial->save();
        return redirect('admin/listar-consejo-sectorial');
    }

    public function update(Request $request, $id) {
        $consejoSectorial = ConsejoSectorial::find($id);
        $consejoSectorial->nombre_consejo = $request->nombre_consejo;
        $consejoSectorial->save();
        return redirect('admin/listar-consejo-sectorial');
    }

}
