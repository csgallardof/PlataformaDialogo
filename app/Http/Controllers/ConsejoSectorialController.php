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

use App\Actividad;
use App\EstadoSolucion;
use App\Institucion;
use App\Solucion;
use App\ActorSolucion;

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


    public function RolConsejoSectorialindex(){

       // dd(Auth::user()->id);
        $resultados_propuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where consejo_sectorials.id = ( select consejo_sectorials.id
                                from users
                                inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
                                inner join institucions on institucions.id = institucion_usuarios.institucion_id
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                where estado_solucion.id <= 4
                                and users.id ='.Auth::user()->id.') order by solucions.estado_id desc');

        //dd($resultados_propuestas);
        
        return view('consejosectorial.home')->with(["resultados_propuestas"=>$resultados_propuestas

                                            ]);
    }

    public function RolConsejoSectorialDesestimadas(){

       // dd(Auth::user()->id);
        $resultados_propuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 5
                                and consejo_sectorials.id = ( select consejo_sectorials.id
                                from users
                                inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
                                inner join institucions on institucions.id = institucion_usuarios.institucion_id
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                where users.id ='.Auth::user()->id.') order by solucions.estado_id desc');

        //dd($resultados_propuestas);
        
        return view('consejosectorial.propuestas-desestimadas')
                                ->with(["resultados_propuestas"=>$resultados_propuestas
                                ]);
    }


    public function RolConsejoSectorialFinalizadas(){

       // dd(Auth::user()->id);
        $resultados_propuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 4
                                and consejo_sectorials.id = ( select consejo_sectorials.id
                                from users
                                inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
                                inner join institucions on institucions.id = institucion_usuarios.institucion_id
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                where users.id ='.Auth::user()->id.') order by solucions.estado_id desc');

        //dd($resultados_propuestas);
        
        return view('consejosectorial.propuestas-finalizadas')
                                ->with(["resultados_propuestas"=>$resultados_propuestas
                                ]);
    }


    public function RolConsejoSectorialConflicto(){

       // dd(Auth::user()->id);
        $resultados_propuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 6
                                and consejo_sectorials.id = ( select consejo_sectorials.id
                                from users
                                inner join institucion_usuarios on institucion_usuarios.usuario_id = users.id
                                inner join institucions on institucions.id = institucion_usuarios.institucion_id
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                where users.id ='.Auth::user()->id.') order by solucions.estado_id desc');

        //dd($resultados_propuestas);
        
        return view('consejosectorial.propuestas-finalizadas')
                                ->with(["resultados_propuestas"=>$resultados_propuestas
                                ]);
    }





    public function activarSolucion(Request $request, $solucion_id) {

         $intentos = DB::select("select * from solucions_reactivacion where solucion_id=".$solucion_id);
         $max_intentos = DB::select("select * from parametros_generales where param_cod='max_react'");

         if(!$intentos){

            $res= DB::select("insert into solucions_reactivacion values(".$solucion_id.",1);");

            //$intentos[0]->solucion_id=$solucion_id;
            //$intentos[0]->intentos_react =1;
            //$intentos[0]->save();
         }else{

            if($intentos[0]->intentos_react==(int)$max_intentos[0]->param_valor){
                Flash::error("Número de reactivaciones excedido");
                return redirect('consejo-sectorial/home');

            }else{
                $res= DB::select("update solucions_reactivacion set intentos_react= ".($intentos[0]->intentos_react+1)." where solucion_id=".$solucion_id.";");
                //$intentos->solucion_id=$solucion_id;
                //$intentos->intentos_react =$intentos->intentos_react+1;
                //$intentos->save();

            }
         }

        $soluciones = Solucion::where('id','=',$solucion_id)
                                 ->first();


        $soluciones->estado_id=1;

        $soluciones->save();

        Flash::success("Propuesta actualizada correctamente");
        return redirect('consejo-sectorial/home');
    }


    

}
