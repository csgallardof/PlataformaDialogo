<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::post('/enviarCorreoNotificacion/', ['uses'=>'NotificacionQuincenalController@enviarCorreo','as'=>'envioNotificacionQuincenal']);
Route::post('/enviarCorreoNotificacionCiudadano/', ['uses'=>'NotificacionCiudadanoController@enviarCorreo','as'=>'envioNotificacionCiudadano']);

Route::post('/enviaCorreoCiudadano/{idSolucion}', ['uses'=>'NotificacionCiudadanoController@enviarCorreoEvCd','as'=>'evaluacion.correoCiudadano']);

/*PLATAFORMA DIALOGO NACIONAL BEGIN IPIALESO 20181104 */


/*
Route::get('usurioss/{id}',function($id){
  return "Mostrando el detalle del usuario {$id}";
})->where('id','[0-9]+');

*/


Route::get('usurioss/{id}','TestOneController@show')->where('id','[0-9]+');


Route::get('usurioss/nuevo',function(){
  return "Creando usuario nuevo";

});

Route::get('userss','TestOneController@testone');

Route::get('greentings/{name}/{nickname?}',function($name,$nickname=null){
  if ($nickname) {
      return "Bienvenido {$name} y tu alias {$nickname}";
  }
else {
  return "Bienvenido {$name} y no tienes alias";
}


});

/*PLATAFORMA DIALOGO NACIONAL END IPIALESO 20181104 */




Route::post('/registrarCorreoNotificacion/{idSolucion}',['uses'=>'NotificacionCiudadanoController@saveCiudadanoEmail','as'=>'notificacion.saveCiudadano']);

Route::post('/registrarEvaluacionC/{idSolucion}',['uses'=>'NotificacionCiudadanoController@saveCiudadanoEval','as'=>'ciudadano.saveCiudadanoEval']);
//Route::post('/lista-propuesta/{tipo}',['uses'=>'PaginasController@crearReportePropuestas','as'=>'reportePropuestas']);

Route::get('/prueba', 'NotificacionQuincenalController@prueba');

Route::get('/','PaginasController@homeDialogo');
Route::get('/calendario-dialogo-nacional','PaginasController@calendarioDialogo');

// Route::get('/', function () {
//      return view('dialogo.home-dialogo');
// });



/************************************Rutas nueva imagen******************************/
Route::get('/busqueda-ejes/{id}','PaginasController@busquedaEjes');
/**************************************************************************************/

Route::get('test','TestController@test');

Route::get('/inicio2', function () {
     return view('inicio2');
});


Route::get('/inicio3', function () {
     return 'Hello.Willo';
});


 /*Route::get('/busquedaAvanzada',[
      'uses'=>'PaginasController@busquedaAvanzada',
      'as'=>'nuevaBusqueda2'
 ]);*/

Route::get('/mail','PaginasController@enviarmail');

Route::get('/busquedaAvanzadaDialogo',[
     'uses'   =>'PaginasController@busquedaAvanzadaDialogo',
     'as'     =>'nuevaBusquedaDialogo'
]);


Route::get('/busquedaAvanzadaDialogoFiltro/',['uses'=>'PaginasController@busquedaAvanzadaDialogoFiltro','as'=>'reportePropuestasFiltro']);



Route::post('/lista-propuesta/{tipo}',['uses'=>'PaginasController@crearReportePropuestas','as'=>'reportePropuestas']);

Route::get('/reporte-home/lista-propuesta/{idEstado}/{tipo}','PaginasController@crearReportePropuestasHome');


Route::get('/listar-eventos/',['uses'=>'EventosController@recuperarEventos','as'=>'recuperarEventos']);
Route::get('/nuevo-evento/',['uses'=>'EventosController@nuevoEvento','as'=>'nuevoEvento']);
Route::get('/eliminar-evento/{id}',['uses'=>'EventosController@destroy','as'=>'eliminarEvento']);
Route::get('/editar-evento/{id}',['uses'=>'EventosController@edit','as'=>'editarEvento']);
Route::post('/actualiza-evento/{id}',['uses'=>'EventosController@update','as'=>'updateEvento']);
Route::post('/insert-evento/',['uses'=>'EventosController@store','as'=>'eventos.store']);
Route::post('/delete-evento/{id}',['uses'=>'EventosController@destroy','as'=>'eventos.delete']);





// Route::post('/reporte',[
//      'uses'=>'SolucionesController@buscar',
//      'as'=>'reporte1.resultado'
// ]);

Route::get('/reporte-graficos','ReportePublicoController@listaReportes');

Route::post('/reporte-graficos','ReportePublicoController@listaReportes');



Route::get('/propuesta-detallada/descargar-excel/{idPropuesta}','ExcelController@exportarPropuestaDetallada');

Route::get('/propuesta-detallada/descargar-pdf/{idPropuesta}/{tipo}','PdfController@crearReportePropuestaDetallada');

Route::post('/propuesta-dialogo-nacional/descargar-excel','ExcelController@exportarPropuestasDialogoNacional');

Route::post('/propuesta-dialogo-nacional/descargar-pdf/{tipo}','PdfController@exportarPropuestasDialogoNacional');



Route::get('/detalle-despliegue-dialogo/{id}','PaginasController@detalledespliegue2');


Route::get('/foro-de-la-produccion-impulso-innovacion', 'PaginasController@foroproduccion');

Route::get('/visorgeneral', 'PaginasController@visorgeneral');

Route::get('/despliegueterritorial', 'PaginasController@despliegueterritorial');

Route::get('/reportegeneralccpt', 'PaginasController@reportegeneralccpt');

Route::get('/cifras', 'PaginasController@cifrasccpt');

Route::get('/vocaciones', 'PaginasController@vocaciones');

Route::get('/indice', 'PaginasController@indices');

Route::get('/por-que-invertir-en-ecuador', 'PaginasController@contratosinversion');

Route::get('/zonas-especiales-de-desarrollo-economico ', 'PaginasController@zedes');

Route::get('/asociaciones-publico-privadas','PaginasController@asociacionesPublicoPrivada');


Route::get('/invertir_en_el_ecuador', 'PaginasController@invertir_en_el_ecuador');

Route::get('/estructura-promedio-costos-gastos-empresas', 'PaginasController@estructuraCostosGastos');

Route::get('/dialogo-nacional-estadisticas','PaginasController@ReporteDialogoGrafico');


Route::get('/usuarios','PaginasController@usuarios');

Route::get('/EventosParticipantes','PaginasController@UsuariosEvento');

//Route::get('/EventosParticipantes','PaginasController@participantes');

Route::post('/despliegueterritorial',['uses'=>'PaginasController@buscar','as'=>'despliegue.resultado']);

Route::get('/detalle-despliegue/{id}','PaginasController@detalledespliegue');

Route::get('/detalle-ccpt/{pajustada_id}/{sector_id}/{ambit_id}/{sipoc_id}','PaginasController@detalleccpt');

Route::get('/indice/indicadoresProvincia', 'PaginasController@indicadoresProvincia');

Route::get('/consejoconsultivo', 'ConsejoConsultivoController@consejoconsultivo');

Route::post('/consejoconsultivo',[
     'uses'=>'ConsejoConsultivoController@buscar',
     'as'=>'consejo.resultado'
]);


Route::get('/busqueda',[
     'uses'=>'PaginasController@busquedaGeneral',
     'as'=>'nuevaBusqueda'
]);


Route::get('storage/{archivo}', function ($archivo) {
     $storage_path = storage_path('app').'/storage/archivos_actividades';
     $url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::disk('local3')->exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);

})->name('descargarArchivo');

Route::get('/descargar/Mesas', 'ExcelController@exportMesas');

Route::get('/descargar/CCPT', 'ExcelController@exportConsejo');



/*
*
* ADMINISTRACION
*
*/
Route::group(['prefix' => 'admin','middleware'=>['auth','admin'] ], function(){

     Route::get('/actividad/create/{idSolucion}',['uses'=>'ActividadesController@createDespliegueAdmin','as'=>'actividades.createDespliegue']);
     Route::post('/actividad/save-admin/{tipo_fuente}/{idSolucion}',['uses'=>'ActividadesController@saveActividadAdmin','as'=>'actividades.saveAdminActividad']);

     Route::get('/home', 'HomeController@index')->name('home');

     Route::resource('sipocs','SipocsController');

     Route::resource('instrumentos','InstrumentosController');

     Route::resource('thematics','ThematicsController');

     Route::resource('sectors','SectorsController');

     Route::resource('vsectors','VsectorsController');

     Route::resource('ambits','AmbitsController');

     Route::resource('provincias','ProvinciasController');

     Route::resource('eventos','EventosController');

     Route::resource('pajustadas','PajustadasController');

     Route::resource('pajustadas','PajustadasController');

     Route::resource('soluciones','SolucionesController');

     Route::resource('instituciones','InstitucionController');

     Route::resource('institucioness','InstitucionesController');

     Route::resource('consejoSectorial','ConsejoSectorialController');

     Route::resource('consejoInstitucions','ConsejoInstitucionsController');

     //Route::get('soluciones','SolucionesController@create');
     //Route::post('soluciones/guardar','SolucionesController@store');

     Route::resource('participantes','ParticipantesController');  //J. Arcos -- rutas para UsersController

     Route::post('/soluciones/vistaPreviaMesas',[
          'uses'    =>   'SolucionesController@vistaPreviaMesas',
          'as'      =>   'soluciones.vistaPreviaMesas'
     ]);  //J. Arcos -- vista Previa Matriz Mesas

     Route::get('participantes/vistaPrevia/{nombreArchivo}',[
          'uses'    =>   'ParticipantesController@vistaPreviaRegistro',
          'as' =>   'admin.participantes.vistaPrevia'
     ]);

     Route::post('/participantes/vistaPreviaRegistro',[
          'uses'=>'ParticipantesController@vistaPreviaRegistro',
          'as'=>'participantes.vistaPreviaRegistro'
     ]);  //J. Arcos -- vista Previa Matriz Registro Participante

     Route::post('/ccpt/vistaPrevia',[
          'uses'=>'ConsejoConsultivoController@vistaPreviaCCPT',
          'as'=>'ccpt.vistaPrevia'
     ]);



     Route::resource('vocaciones_productivas','VocacionesProductivasController');  //J. Arcos -- rutas para UsersController

     Route::resource('ccpt','ConsejoConsultivoController');  //J. Arcos -- rutas para UsersController


     Route::get('actor_solucion','InstitucionController@indexActorSolucion');  //admin cruds

     Route::get('actor_solucion/create',[
          'uses'=>'InstitucionController@createForm2',
          'as'=>'actorSolucion.create'
     ]);  //admin cruds

     // Route::get('actor_solucion/create',[
     //      'uses'=>'InstitucionController@createForm2',
     //      'as'=>'actorSolucion.create'
     // ]);

     Route::post('actores/porasignar',[
          'uses'=>'InstitucionController@asignarActorSolucion',
          'as'=>'actorSolucion.asignar'
     ]);  //admin cruds

     Route::get('actores','InstitucionController@indexActorSolucion');  //admin cruds

     Route::get('soluciones_por_tipo/{tipo_fuente}','SolucionesController@getSolucionesByTipoFuente');

     // vista actores

     Route::get('actores/asignados','InstitucionController@homeActoresAsignados');  //admin cruds

     Route::get('actores/porasignar','InstitucionController@homeActoresPorAsignar');

     //Route::get('actores/asignar-responsable','InstitucionController@vistaCrearResponsable');

     //Route::get('/editar-reporte-alerta/{id}','CspReportesController@vistaEditarReporteAlerta');


     // Route::get('actores/asignar-responsable/{idSolucion}',[
     //      'uses'=>'InstitucionController@createAsignar',
     //      'as'=>'actorSolucion.create'
     // ]);


     //  Route::get('/mesadialogo/matrizCarga',[
     //      'uses'    =>   'MesaDialogoController@matrizCarga',
     //      'as'      =>   'mesadialogo.matrizCarga'
     // ]);

     // Route::post('/mesadialogo/vistaPreviaMesas',[
     //      'uses'    =>   'MesaDialogoController@vistaPreviaMesas',
     //      'as'      =>   'mesadialogo.vistaPreviaMesas'
     // ]);

     // Route::resource('mesadialogo','MesaDialogoController');

//Administrar Consejo Sectorial
Route::get('/crear-consejo-sectorial', 'ConsejoSectorialController@create');
Route::get('/editar-consejo-sectorial/{id}/edit', 'ConsejoSectorialController@edit');
Route::get('/listar-consejo-sectorial', 'ConsejoSectorialController@index');
Route::resource('consejosSectoriales', 'ConsejoSectorialController');
//Administrar Instituciones
Route::get('/crear-institucion', 'InstitucionesController@create');
Route::get('/editar-institucion/{id}/edit', 'InstitucionesController@edit');
Route::get('/listar-institucion', 'InstitucionesController@index');
Route::resource('instituciones', 'InstitucionesController');

//Administrar Instituciones
Route::get('/crear-institucion-usuarios', 'InstitucionUsuarioController@create');
Route::get('/editar-institucion-usuarios/{id}/edit', 'InstitucionUsuarioController@edit');
Route::get('/delete-institucion-usuarios/{id}/delete', 'InstitucionUsuarioController@destroy');
Route::get('/listar-institucion-usuarios', 'InstitucionUsuarioController@index');
Route::get('institucionUsuariosListar/{institucion_id}','InstitucionUsuarioController@institucionesUsuariosLista');

//Administrar Usuarios
Route::resource('usuario','UsuarioController');
Route::resource('/crear-usuario','UsuarioController@store');
Route::get('/editar-usuario/{id}/edit', 'UsuarioController@edit');
Route::get('/listar-usuario', 'UsuarioController@index');
Route::get('/cambiar-clave/{id}', 'UsuarioController@cambiarClave');
Route::post('/cambiar-clave/{id}', 'UsuarioController@updateClave');


//Administrar Roles
Route::resource('rol','RolController');
//Route::get('/listar-rol', 'RolController@index');

//Administrar Rol Usuario
Route::resource('rolUsuario','RolUsuarioController');
Route::get('/listar-rol-usuarios', 'RolUsuarioController@index');
Route::get('/editar-rol-usuario/{id}', 'RolUsuarioController@edit');
Route::post('/editar-rol-usuario/{id}', 'RolUsuarioController@update');


//Administrar Instituciones por Consejos
Route::get('/crear-consejo-institucions', 'ConsejoInstitucionsController@create');
Route::get('/editar-consejo-institucions/{id}/edit', 'ConsejoInstitucionsController@edit');
Route::get('/delete-consejo-institucions/{id}/delete', 'ConsejoInstitucionsController@destroy');
Route::get('/listar-consejo-institucions', 'ConsejoInstitucionsController@index');

Route::resource('consejoInstituciones', 'ConsejoInstitucionsController');
Route::resource('institucionUsuarios','InstitucionUsuarioController');
Route::get('consejoInstitucionesListar/{sector_id}','ConsejoInstitucionsController@institucionesSectoresLista');

     Route::get('/actor/editar-actor-solucion/{solucion_id}','InstitucionController@transferirActorSolucion');

     Route::post('/actor/editar-actor-solucion/{actorSolucionID}','InstitucionController@ActualizarActorSolucion');



});



     Route::group(['prefix' => 'institucion','middleware'=>['auth'] ], function(){

     Route::get('home','InstitucionController@home');  //página dashboard para las instituciones

     Route::get('propuestas-en-conflicto','InstitucionController@conflicto');  //página dashboard para las instituciones

     Route::get('propuestas-desestimadas','InstitucionController@desestimadas');  //página dashboard para las instituciones

     Route::get('verSolucion/despliegue/{tipo_actor}/{idSolucion}',['uses'=>'ActividadesController@verActividadesDespliegue','as'=>'verSolucion.despliegue']);

     Route::get('detalle-propuesta/{idSolucion}',['uses'=>'PaginasController@detallepropuesta','as'=>'detallepropuesta']);

     Route::get('parametros-cumplimiento/create/{idSolucion}',['uses'=>'ActividadesController@vistaParametrosCumplimiento','as'=>'solucion.parametrosCumplimiento']);

     Route::post('/crear-parametros-cumplimiento/{id}',['uses'=>'ActividadesController@crearParametrosCumplimiento','as'=>'crear.ParametrosCumplimiento']);

     Route::get('verSolucion/consejo/{tipo_actor}/{idSolucion}',['uses'=>'ActividadesController@verActividadesConsejo','as'=>'verSolucion.consejo']);

     Route::get('despliegue/actividad/create/{idSolucion}',['uses'=>'ActividadesController@createDespliegue','as'=>'actividades.createDespliegue']);

     Route::get('finalizar/actividad/create/{idSolucion}',['uses'=>'ActividadesController@vistaFinalizarPropuesta','as'=>'cierre.Propuesta']);

     Route::get('desestimada/actividad/create/{idSolucion}',['uses'=>'ActividadesController@vistaDesestimarPropuesta','as'=>'desestimar.Propuesta']);

     Route::get('conflico/actividad/create/{idSolucion}',['uses'=>'ActividadesController@vistaConflictoPropuesta','as'=>'conflicto.Propuesta']);

     Route::post('actividad-conflicto-propuesta/save/{tipo_fuente}/{idSolucion}',['uses'=>'ActividadesController@conflictoPropuestaSolucion','as'=>'actividadConflicto.saveActividad']);

     Route::post('actividad-desestimada-propuesta/save/{tipo_fuente}/{idSolucion}',['uses'=>'ActividadesController@desestimarPropuestaSolucion','as'=>'actividadDesestimar.saveActividad']);

     Route::post('actividad-Finalizado-propuesta/save/{tipo_fuente}/{idSolucion}',['uses'=>'ActividadesController@finalizarPropuestaSolucion','as'=>'actividadCierre.saveActividad']);

     Route::get('consejo/actividad/create/{idSolucion}',['uses'=>'ActividadesController@createConsejo','as'=>'actividades.createConsejo']);

     Route::post('actividad/save/{tipo_fuente}/{idSolucion}',['uses'=>'ActividadesController@saveActividad','as'=>'actividades.saveActividad']);




//VISTA DE LOS REPORTES DEL CSP
     Route::get('/consejo-sectorial-produccion','CspReportesController@mostrarReportes');

     Route::get('/consejo-sectorial-produccion/reportes-hechos','CspReportesController@homeReportesHechos');

     Route::get('/consejo-sectorial-produccion/reportes-alertas','CspReportesController@homeReportesAlertas');

     //CREAR REPORTE HECHOS CSP
     Route::get('/consejo-sectorial-produccion-createReportesHecho','CspReportesController@vistaCrearReporteHecho');

     //CREAR REPORTE HECHOS
     Route::get('/consejo-sectorial-produccion-createReportesAlerta','CspReportesController@vistaCrearReporteAlerta');

     //guardar reporte hechos
     Route::post('/guardarReporteHechoCsp',['uses'=>'CspReportesController@guardarReporteHecho','as'=>'guardarReporteHechoCsp']);

     //guardar reportes alertas
     Route::post('/guardarReporteAlertaCsp',['uses'=>'CspReportesController@guardarReporteAlerta','as'=>'guardarReporteAlertaCsp']);

     // ACCIONES REPORTES ALERTAS
     Route::get('/acciones-alertas/{id}','CspReportesController@AccionesAlertas');
     Route::post('/crear-acciones-alertas',['uses'=>'CspReportesController@crearAccionesAlerta','as'=>'guardarAccionesAlertaCsp']);

     //Visualizar acciones de reportes alertas
     Route::get('/visualizar-acciones-alertas/{id}','CspReportesController@visualizarAccionesAlertas');

     //Visualizar acciones de reportes alertas general
     Route::get('/visualizar-acciones-alertas-general/{id}','CspReportesController@visualizarAccionesAlertasGeneral');

     // VISUALIZAR REPORTES CSP
     Route::get('/visualizar-reporte-hechos/{id}','CspReportesController@visualizarReporteHecho');
     Route::get('/visualizar-detalle-reporte-hechos/{id}','CspReportesController@visualizarDetalleReporteHecho');
     Route::get('/visualizar-reporte-Alertas/{id}','CspReportesController@visualizarReporteAlerta');
     Route::get('/visualizar-detalle-reporte-Alertas/{id}','CspReportesController@visualizarDetalleReporteAlerta');

     //EDITAR REPORTES HECHO CSP
     Route::get('/editar-reporte-hechos/{id}','CspReportesController@vistaEditarReporteHecho');
     Route::post('/modificar-reporte-hechos/{id}',['uses'=>'CspReportesController@editarReporteHechoCsp','as'=>'modificarReporteHecho']);

     //EDITAR REPORTES ALERTAS CSP
     Route::get('/editar-reporte-alerta/{id}','CspReportesController@vistaEditarReporteAlerta');
     Route::post('/modificar-reporte-alerta/{id}',['uses'=>'CspReportesController@editarReporteAlertaCsp','as'=>'modificarReporteAlerta']);
     Route::post('/modificar-reporte-alerta-estado/{id}',['uses'=>'CspReportesController@editarReporteAlertaEstadoCsp','as'=>'modificarReporteAlertaEstado']);

     //EDITAR REPORTES ACCIONES ALERTAS CSP
     Route::get('/editar-acciones-alerta/{id}','CspReportesController@vistaEditaraccionesAlerta');
     Route::post('/modificar-acciones-alerta/{id}',['uses'=>'CspReportesController@editarAccionesAlertaCsp','as'=>'modificarAccionesAlerta']);

     //Reportes csp
     Route::get('/lista-reportes-csp','PdfCspReportesController@listaReportesCsp');
     //Generar Reporte
    // Route::get('/crear_reporte_porpais/{tipo}','PdfCspReportesController@crear_reporte_porpais');
     //Route::post('/guardarIdReporteHechoCsp','PdfCspReportesController@obtenerReportesHechos');
     Route::post('/guardarIdReporteHechoCsp/{tipo}',['uses'=>'PdfCspReportesController@crearReporteHechosRelevantes','as'=>'guardarIdReporteHechoCsp']);

     Route::get('/reportes-lineas-discursivas-csp','PdfCspReportesController@listaLineasDiscursivasCsp');
     Route::post('/guardarIdReporteHechoLineasDiscursivasCsp/{tipo}',['uses'=>'PdfCspReportesController@crearReporteHechosLineasDiscursivas','as'=>'guardarIdReporteHechoLineasDiscurisvasCsp']);

     Route::get('/reportes-alertas-csp','PdfCspReportesController@listaReportesAlertasCsp');
     Route::post('/guardarIdReporteAlertasCsp/{tipo}',['uses'=>'PdfCspReportesController@crearReporteAlerta','as'=>'guardarIdReporteAlertasCsp']);
     //Router::get('//lista-reportes-csp/buscarReportesHechos',;
     //BUSQUEDAS DE HECHOS RELEVANTES
     Route::get('/busquedaReporteHechos',['uses'=>'PdfCspReportesController@buscarReportesHechos','as'=>'nuevaBusquedaReportesHechos']);
     Route::get('/busquedaReporteHechosLineasDiscursivas',['uses'=>'PdfCspReportesController@buscarReportesHechosLineasDiscursivas','as'=>'nuevaBusquedaReportesHechosLineasDiscursivas']);
     //DESCARGAR ARCHIVO HECHO CSP
     Route::get('/busquedaReporteAlertas',['uses'=>'PdfCspReportesController@buscarReportesAlertas','as'=>'nuevaBusquedaReportesAlertas']);
     Route::get('storageHechoCsp/{archivo}', function ($archivo) {
     $storage_path = storage_path('app').'/storage/CspReportesHechos';
     $url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::disk('CspReportesHechos')->exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);

     })->name('descargarArchivoHechosCsp');


     //DESCARGAR ARCHIVO ACCION ALERTA CSP
     Route::get('storageAccioAlertaCsp/{archivo}', function ($archivo) {
     $storage_path = storage_path('app').'/storage/CspReportesAlerta';
     $url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::disk('CspReportesAlerta')->exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);

     })->name('descargarAccionAlertaCsp');

     //DESCARGAR ARCHIVO ALERTA CSP
     Route::get('storageAlertaCsp/{archivo}', function ($archivo) {
     $storage_path = storage_path('app').'/storage/CspReportesAlerta';
     $url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::disk('CspReportesAlerta')->exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);

     })->name('descargarArchivoAlertaCsp');

     Route::get('/crear-agenda-territorial', 'CspAgendaTerritorialController@vistaCrearAgenda');

     Route::get('/ver-agenda-territorial', 'CspAgendaTerritorialController@mostrarAgendaTerritorial');

     Route::post('/guardar-agenda-territorial',['uses'=>'CspAgendaTerritorialController@crearAgenda','as'=>'guardarAgendaTerritorialCsp']);

     Route::get('/editar-agenda-territorial/{id}', 'CspAgendaTerritorialController@vistaEditarAgendaTerritorial');

     Route::post('/modificar-agenda-territorial/{id}',['uses'=>'CspAgendaTerritorialController@editarReporteAlertaCsp','as'=>'modificarAgendaTerritorial']);

     Route::get('/lista-agenda-territorial-csp','CspPdfReportesAgendaController@listaAgendaTerritorialCsp');

     Route::post('/guardarIdAgendaTerritorial/{tipo}',['uses'=>'CspPdfReportesAgendaController@crearReporteAgendaTerritorial','as'=>'guardarIdReporteHechoCsp']);

     Route::get('/tabla-excel','CspPdfReportesAgendaController@mostrarTabla');

     Route::get('/unificar-propuestas','PropuestasUnificadasController@mostrarPropuestas');

     Route::post('/seleccion-propuestas-unificadas',['uses'=>'PropuestasUnificadasController@obtenerPropuestasUnificadas','as'=>'guardarIdPropuestas']);

     Route::post('/seleccion-propuestas-unificadas/create-pajustada-unificar',['uses'=>'PropuestasUnificadasController@guardarPajustadaUnificar','as'=>'guardarPajustadaUnificar']);

     Route::post('/seleccion-propuestas-unificadas/create-pajustada-unificar/pajustadas',['uses'=>'PropuestasUnificadasController@definirPajustada','as'=>'definirPajustada']);


    Route::get('/ver-propuestas-unificadas','PropuestasUnificadasController@verPropuestasUnificadas');
    Route::get('/detalle-propuestas-unificadas/{id}','PropuestasUnificadasController@detallePropuestasUnificadas');
   // Route::get('/ver-propuestas-unificadas/{idPropuesta}','PropuestasUnificadasController@post')->name('post');
    Route::post('/ver-propuestas-unificadas/{idPropuesta}',['uses'=>'PropuestasUnificadasController@detallePropuestasUnificadas','as'=>'detallePropuestasUnificadas']);


   //Cambio de contraseña
   Route::get('/cambiar-clave/{id}', 'InstitucionController@cambiarClave');
   Route::post('/cambiar-clave/{id}', 'InstitucionController@updateClave');


//REPORTES
 //Route::get('/reportes','ReportesController@listaMinisterio');
 //Route::post('/reporte-institucional/descargar-excel','ReportesController@exportarExcelReporteMinisterio');
 //Route::post('/reporte-institucional/descargar-pdf/{tipo}','ReportesController@exportarPdfReporteMinisterio');
 Route::get('/reportes/',['uses'=>'ReportesController@listaMinisterio','as'=>'reporteInstitucion.institucion']);
 Route::get('/reporteMinisterio/',['uses'=>'ReportesController@listaMinisterio','as'=>'reporteInstitucion.institucion']);
 Route::get('/reporteMinisterioEstadistico',['uses'=>'ReportesController@reporteEstadisticoInstitucion','as'=>'reporteGraficoInstitucion.institucion']);  


 Route::get('/reporte-institucional/descargar-excel/{fechaInicial}/{fechaFinal}',['uses'=>'ReportesController@exportarExcelReporteMinisterio','as'=>'exportarExcel.ReporteMinisterio']);
 Route::get('/reporte-institucional/descargar-pdf/{fechaInicial}/{fechaFinal}',['uses'=>'ReportesController@exportarPdfReporteMinisterio','as'=>'exportarPdf.ReporteMinisterio']);


   //Mesas de Dialogo



      Route::get('/mesadialogo/matrizCarga',[
          'uses'    =>   'MesaDialogoController@matrizCarga',
          'as'      =>   'mesadialogo.matrizCarga'
     ]);

     Route::post('/mesadialogo/vistaPreviaMesas',[
          'uses'    =>   'MesaDialogoController@vistaPreviaMesas',
          'as'      =>   'mesadialogo.vistaPreviaMesas'
     ]);

     Route::resource('mesadialogo','MesaDialogoController');

});


Route::get('/reporte','ReportePublicoController@listaReportes');
Route::post('/reporte','ReportePublicoController@listaReportes');

// Consejo Sectorial

Route::group(['prefix' => 'consejo-sectorial','middleware'=>['auth'] ], function(){


     Route::get('/consejo-sectorial-propuestas','ConsejoSectorialController@cs_propuestas');
     Route::get('/home','ConsejoSectorialController@RolConsejoSectorialindex');
     Route::get('/propuestas-desestimadas','ConsejoSectorialController@RolConsejoSectorialDesestimadas');
     Route::get('/propuestas-finalizadas','ConsejoSectorialController@RolConsejoSectorialFinalizadas');
     Route::get('/propuestas-en-conflicto','ConsejoSectorialController@RolConsejoSectorialConflicto');

     Route::post('actores/porasignar',[
          'uses'=>'InstitucionController@asignarActorSolucion',
          'as'=>'actorSolucion.asignar'
     ]);

     //Administrar Usuarios
     //Route::resource('usuario','UsuarioController');

     Route::get('/editar-usuario/{id}/edit', 'UsuarioController@editarUsuarioConsejo');
     Route::get('/nuevo-usuario-institucion/', 'UsuarioController@nuevo_usuario_institucion');
     Route::post('crear-usuario-institucion',['uses'=>'UsuarioController@guardarUsuarioConsejo','as'=>'guardarUsuarioConsejo']);
     Route::post('/actualizar-usuario/{id}/update', ['uses'=>'UsuarioController@updateUsuarioConsejo','as'=>'updateUsuarioConsejo']);

     Route::get('/listar-usuario', 'UsuarioController@usuarios_cs');
     Route::get('/cambiar-clave/{id}', 'UsuarioController@cambiarClave');
     Route::post('/cambiar-clave/{id}', 'UsuarioController@updateClave');

     Route::get('verSolucion/despliegue-consejo/{tipo_actor}/{idSolucion}',['uses'=>'ActividadesController@verActividadesDespliegueConsejo','as'=>'verSolucion.despliegueConsejo']);

     Route::get('parametros-cumplimiento/edit/{idSolucion}',['uses'=>'ActividadesController@vistaEditParametrosCumplimiento','as'=>'solucion.EditparametrosCumplimiento']);

     Route::get('aperturar/actividad/update/{idSolucion}',['uses'=>'ActividadesController@vistaAperturarPropuesta','as'=>'aperturar.Propuesta']);

     Route::post('actividad-aperturar-propuesta/save/{tipo_fuente}/{idSolucion}',['uses'=>'ActividadesController@AperturarPropuestaSolucion','as'=>'actividadAperturar.saveActividad']);

     Route::get('verSolucion/despliegue/{tipo_actor}/{idSolucion}',['uses'=>'ActividadesController@verActividadesDespliegueConsejo','as'=>'verSolucion.despliegueConsejo']);

     Route::get('detalle-propuesta/{idSolucion}',['uses'=>'PaginasController@detallepropuestaConsejo','as'=>'detallepropuestaConsejo']);



  //consejo-sectorial/activar/{idSolucion}
     Route::get('activar/{idSolucion}',['uses'=>'ConsejoSectorialController@activarSolucion','as'=>'consejo.activarSolucion']);



     //REPORTES

     Route::get('/reportes-consejo/',['uses'=>'ReportesController@listaConsejoPorCodigo','as'=>'reporteConsejo.institucion']);

    Route::get('/reportes-grafico-consejo/',['uses'=>'ReportesController@reporteEstadisticoConsejoSectorial','as'=>'reporteGraficoConsejo.institucion']);

    //Route::post('/reporte-consejo/descargar-excel/{selInstituciones}','ReportesController@exportarExcelReporteConsejo');
     //Route::post('/reporte-consejo/descargar-excel/','ReportesController@exportarExcelReporteConsejo');
      Route::get('/reporte-consejo/descargar-excel/{codInstitucion}/{fechaInicial}/{fechaFinal}/{consulto}',['uses'=>'ReportesController@exportarExcelReporteConsejo','as'=>'exportarExcel.ReporteConsejo']);

     // Route::post('/reporte-consejo/descargar-pdf/{tipo}','ReportesController@exportarPdfReporteConsejo');
      Route::get('/reporte-consejo/descargar-pdf/{codInstitucion}/{fechaInicial}/{fechaFinal}',['uses'=>'ReportesController@exportarPdfReporteConsejo','as'=>'exportarPdf.ReporteConsejo']);

     //Propuestas finalizadas






});


 //Seleccionar fecha
Route::post('/test/save', ['as' => 'save-date',
                           'uses' => 'DateController@showDate',
                            function () {
                                return '';
                            }]);
