@extends('layouts.consejo-sectorial')

@section('title','Propuestas-Consejo Sectorial')


@section('content')

<!-- NOTAS ESTA ES LA PANTALLA PARA CONSEJO SECTORIAL  / SEBE PROBAR Y MODIFICAR LAS COSAS PARA MEJORAR +++ NOTA +++++  -->
		<!-- begin #content -->
		<!-- begin #content -->
        <div id="content" class="content" width="10%">
            <!-- begin row -->
            <div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>

            @include('flash::message')

            <div class="row">
                <!-- begin col-8 -->
                
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                              
                            </div>
                            <h3 align="left" class="panel-title">Reporte del Consejo de la Plataforma del Di&aacute;logo Nacional</h3>
                        </div>


<div class="row"> 
<div class="col-md-5"></div>           
 <div class="col-md-2">
                   <form target="_blank" method="POST" action="/consejo-sectorial/reporte-consejo/descargar-excel" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-9">
                                 <button type="submit"  class="btn btn-primary">Descargar Excel</button>
                            </div>
                              
                        </div>
                        <table hidden>
                        <thead>
                        <th class="text-left f-s-18">Seleccionar</th>
                        <th class="text-left f-s-18">id</th>
                        </thead>
                        <tbody>
                        @foreach( $resultadosreporte as $excel)
                        <tr>
                        <td><input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
                        <td>{{$excel->id}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </form>
                      
                         <form target="_blank" method="POST" action="/consejo-sectorial/reporte-consejo/descargar-pdf/1" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                                    <div class="col-md-3 ">
                                        
                                        <button type="submit"  class="btn btn-success">Descargar PDF</button>

                                    </div>
                                      
                                </div>
                        <table hidden>
                        <thead>
                        <th class="text-left f-s-18">Seleccionar</th>
                        <th class="text-left f-s-18">id</th>
                        </thead>
                        <tbody>
                        @foreach( $resultadosreporte as $excel)
                        <tr>
                        <td><input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
                        <td>{{$excel->id}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </form>
                        <br /><br />

                 </div>
        </div>



                    <div class="panel-body">

                         
                    <div class="row">
                       <form target="_blank" method="POST" action="/consejo-sectorial/reportes">
                      <div class="col-md-2"></div>
                     <div class="col-md-1">
                         Instituci&oacute;n
                     </div>
                    <div class="col-md-3">
                     <select name="selInstituciones" class="form-control"  id="selInstituciones" required="" >
                         <option value="">Todos</option>
                        @foreach($listaMinisterioPorConsejo as $lista)
                        <option value="{{$lista->idInstitucion}}">{{$lista->nombre_institucion}}</option>
                        @endforeach
                         <option value="">Todos</option>
                    </select>
                    <script>
                        $(function(){
                          $('#selInstituciones').on('change', function () {
                              var id = $(this).val(); // get selected value
                              if (id) { 
                                  window.location = "{{ url('/') }}reportesPorInstitucion/"+id; 
                              }
                              return false;
                          });
                        });
                    </script>

                    </div>
                    <div class="col-md-6">
                         <button type="submit"  >Obtener</button>
                     </div>
                     </form>
                      </div>
                     


                    <div  class="col-md-9 col-md-offset-2">
                         <table class="table table-hover">
                        <thead>
                        <tr>
                           <th colspan="3" ><div align="center">  REPORTE DE MINISTERIO DE LA PLATAFORMA DE DIALOGO NACIONAL </div></th>
                        </tr>
                       

                      </thead>
                        <tbody>

                     
                         

                       <tr>
                           <th colspan="3" ><div align="center">Datos Informativos</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">Fecha</div></th>
                            <td colspan="1" ><div align="left">{{$hoy}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">Responsable</div></th>
                            <td colspan="1" ><div align="left">{{$nombreusuario}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">Consejo Sectorial</div></th>
                            <td colspan="1" ><div align="left">{{$nombreConsejo}}</div></td>
                        </tr>

                      

                       <tr>
                           <th colspan="3" ><div align="center">Tipo Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Recibidas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasRecibidas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Desestimadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesestimadas}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Validadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasValidadas}}</div></td>
                        </tr>


                        <tr>
                           <th colspan="3" ><div align="center">Estado de Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Cumplidas o Finalizadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasFinalisadas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en Desarrollo</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesarrolladas}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en An&aacute;lisis</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasAnalisadas}}</div></td>
                        </tr>



                       <tr>
                           <th colspan="3" ><div align="center">Forma de Cumplimiento</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en PP</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPolitica}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas leyes</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasLeyes}}</div></td>
                        </tr>

               
                        <tr>
                           <th colspan="3" ><div align="center">Propuestas por Plazo</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas a Corto</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoCorto}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Mediano</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoMediano}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Largo Plazo</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoLargo}}</div></td>
                        </tr>


                        </tbody>
                    </table>
                    </div>

                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->

                
            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->
		

		@stop
                                                                                                                                                                               
