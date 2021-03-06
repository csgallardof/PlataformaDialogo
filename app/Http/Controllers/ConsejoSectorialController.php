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
use App\User;

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

        //dd(Auth::user()->id);

        // Añadir tabla para relacionar obtener el id del consejo sectorial
        $resultados_propuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where consejo_sectorials.id = 4 order by solucions.estado_id desc');

        $evaluaciones = DB::select("SELECT count(1) as total, ev_semaforo, ev_solicitud_id 
                                      FROM `evaluacion_ciudadano` 
                                      GROUP BY ev_semaforo, ev_solicitud_id order by ev_solicitud_id; ");        



         $totalPropuestas = count($resultados_propuestas);

                $resultadosPropuestaFinalizada= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 4
                                and consejo_sectorials.id =4  order by solucions.estado_id desc');

        //dd($resultados_propuestas);

        $totalPropuestaFinalizada = count($resultadosPropuestaFinalizada);

        $resultadosPropuestaDesestimada= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 5
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaDesestimada = count($resultadosPropuestaDesestimada);

        $resultadosPropuestaConflicto= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 6
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaConflicto = count($resultadosPropuestaConflicto);

        
        return view('consejosectorial.home')->with(["resultados_propuestas"=>$resultados_propuestas,
                                                    "evaluaciones"=>$evaluaciones,
                                                    "totalPropuestas"=>$totalPropuestas,
                                                    "totalPropuestaFinalizada"=>$totalPropuestaFinalizada,
                                                    "totalPropuestaDesestimada"=>$totalPropuestaDesestimada,
                                                    "totalPropuestaConflicto"=>$totalPropuestaConflicto
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
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaDesestimada = count($resultados_propuestas);


         $resultadosPropuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where consejo_sectorials.id = 4 order by solucions.estado_id desc');

         $totalPropuestas = count($resultadosPropuestas);

  
         $resultadosPropuestaConflicto= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 6
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaConflicto = count($resultadosPropuestaConflicto);

        $resultadosPropuestaFin= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 4
                                and consejo_sectorials.id =4  order by solucions.estado_id desc');

        //dd($resultados_propuestas);

        $totalPropuestaFinalizada = count($resultadosPropuestaFin);         
        //dd($resultados_propuestas);
        
        return view('consejosectorial.propuestas-desestimadas')
                                ->with(["resultados_propuestas"=>$resultados_propuestas,
                                        "totalPropuestaDesestimada"=>$totalPropuestaDesestimada,
                                        "totalPropuestas"=>$totalPropuestas,
                                        "totalPropuestaConflicto"=>$totalPropuestaConflicto,
                                        "totalPropuestaFinalizada"=>$totalPropuestaFinalizada
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
                                and consejo_sectorials.id =4  order by solucions.estado_id desc');

        //dd($resultados_propuestas);

        $totalPropuestaFinalizada = count($resultados_propuestas);


              $resultadosPropuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where consejo_sectorials.id = 4 order by solucions.estado_id desc');

         $totalPropuestas = count($resultadosPropuestas);

    $resultadosPropuestaDesestimada= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 5
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaDesestimada = count($resultadosPropuestaDesestimada);    

         $resultadosPropuestaConflicto= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
                                from institucions
                                inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
                                inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
                                inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
                                inner join solucions on solucions.id = actor_solucion.solucion_id
                                inner join estado_solucion on estado_solucion.id = solucions.estado_id
                                where estado_solucion.id = 6
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaConflicto = count($resultadosPropuestaConflicto);
        
        return view('consejosectorial.propuestas-finalizadas')
                                ->with(["resultados_propuestas"=>$resultados_propuestas,
                                    "totalPropuestaFinalizada"=>$totalPropuestaFinalizada,
                                    "totalPropuestas"=>$totalPropuestas,
                                    "totalPropuestaDesestimada"=>$totalPropuestaDesestimada,
                                    "totalPropuestaConflicto"=>$totalPropuestaConflicto

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
                                and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaConflicto = count($resultados_propuestas);


         $resultadosPropuestas= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
            from institucions
            inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
            inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
            inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
            inner join solucions on solucions.id = actor_solucion.solucion_id
            inner join estado_solucion on estado_solucion.id = solucions.estado_id
            where consejo_sectorials.id = 4 order by solucions.estado_id desc');

         $totalPropuestas = count($resultadosPropuestas);

         $resultadosPropuestaDesestimada= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
            from institucions
            inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
            inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
            inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
            inner join solucions on solucions.id = actor_solucion.solucion_id
            inner join estado_solucion on estado_solucion.id = solucions.estado_id
            where estado_solucion.id = 5
            and consejo_sectorials.id = 4 order by solucions.estado_id desc');
         $totalPropuestaDesestimada = count($resultadosPropuestaDesestimada); 

         
         $resultadosPropuestaFin= DB::select('SELECT solucions.cod_solucions, solucions.propuesta_solucion, institucions.siglas_institucion, actor_solucion.tipo_actor, solucions.estado_id, estado_solucion.nombre_estado, estado_solucion.id, actor_solucion.tipo_actor,solucions.id 
            from institucions
            inner join consejo_institucions on consejo_institucions.institucion_id = institucions.id
            inner join consejo_sectorials on consejo_institucions.consejo_id = consejo_sectorials.id
            inner join actor_solucion  on actor_solucion.institucion_id = institucions.id
            inner join solucions on solucions.id = actor_solucion.solucion_id
            inner join estado_solucion on estado_solucion.id = solucions.estado_id
            where estado_solucion.id = 4
            and consejo_sectorials.id =4  order by solucions.estado_id desc');

        //dd($resultados_propuestas);

         $totalPropuestaFinalizada = count($resultadosPropuestaFin);                 

        //dd($resultados_propuestas);
        
        return view('consejosectorial.propuestas-en-conflicto')
                                ->with(["resultados_propuestas"=>$resultados_propuestas,
                                    "totalPropuestaConflicto"=>$totalPropuestaConflicto,
                                    "totalPropuestas"=>$totalPropuestas,
                                    "totalPropuestaDesestimada"=>$totalPropuestaDesestimada,
                                    "totalPropuestaFinalizada"=>$totalPropuestaFinalizada
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





public function cambiarClave($id) {
   // dd("cambiarClave");
        $usuario = User::find($id);
        $usuario->save();
        return view('consejosectorial.clave', compact('usuario'));
     }


     public function updateClave(Request $request, $id) {
     //    dd("updateClave");
        $usuario = User::find($id);

        $this->validate($request, [
            'clave1' => 'required',
            'clave2' => 'required'
                  ]
                , [
            'clave1.required' => 'Debe ingresar la clave',
            'clave2.required' => 'Debe ingresar la clave'
        ]);

         if( $request->clave1 !=  $request->clave2){
              Flash::error("Debe ingresar la misma clave");
              return redirect('institucion/cambiar-clave/'.$id);
        }else{
             $usuario->password = bcrypt($request->clave1);
             $usuario->save();
             Flash::success("Clave actualizada correctamente");
             return redirect('institucion/cambiar-clave/'.$id);
        }

    }


    

}
