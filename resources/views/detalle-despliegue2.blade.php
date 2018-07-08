@extends('layouts.main')

@section('title', 'Reporte')

@section('start_css')
  @parent
  <link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
@endsection

@section('contenido')

<br><br><br><br>

		<!-- begin #about -->
		<div class="content row-m-t-2" data-scrollview="true">
				<!-- begin container -->
			<div class="container-fluid" data-animation="true" data-animation-type="fadeInDown">

        <div class="toolbar title_ip_breadcrumb fit-m-b-10">
          <ol class="breadcrumb">
            <li class="home"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i><span></span></a></li>
            <li class="active"><a href="/busquedaAvanzada">Resultados de la B&uacute;squeda</a></li>
            <li class="active"><a href="#">Detalle de la propuesta</a></li>
            <label class='text-success pull-right'>
							<a href="/busquedaAvanzada" class="btn btn-link fit-m-t-1"><i class="fa fa-1x fa-search"></i> Nueva Consulta</a>
						</label>
          </ol>
        </div>

				<!-- begin row -->
				<div class="row">
					<!-- begin col-5 -->
					<div class="col-md-3">

						<div class="panel panel-inverse" data-sortable-id="index-6" style="border: #D7DBDD 1px solid; padding: 1%">
							<dl class="dl-horizontal">
										
								<a href="/propuesta-detallada/descargar-excel/{{$solucion->id}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;Descargar Excel</a>
								<a target="_blank" href="/propuesta-detallada/descargar-pdf/{{$solucion->id}}/1" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>&nbsp;Descargar PDF</a>

								
								
							</dl>


							<h5 class="panel-title alert detalle_evento_info_adicional fade in m-b-15" style="padding: 5px 5px 5px 15px;"><strong>Estado de Compromiso:</strong></h5>


									<p style="padding-left:15%">
										<span class="label label-warning f-s-13">
											@if(isset($solucion))
												{{ $solucion->estado->nombre_estado }}
											@endif
										</span>
									</p>

							<br>

							<h5 class="panel-title alert detalle_evento_info_adicional fade in m-b-15" style="padding: 5px 5px 5px 15px;"><strong>Eslabon de la cadena productiva</strong></h5>


									<p style="padding-left:15%">
										@if(isset($solucion))
											@if(isset($solucion->sipoc->nombre_sipoc))
											{{ $solucion->sipoc->nombre_sipoc }}
											@else
											No Existe Registro
											@endif
										@endif
									</p>

							<br>

								<h4 class="panel-title alert detalle_evento_info_adicional fade in m-b-15" style="padding: 5px 5px 5px 15px;"><strong>Instrumentos Necesario</strong></h4>


								<p style="padding-left:15%">
										@if(isset($solucion))
											@if(isset($solucion->instrumento->nombre_instrumento))
											{{ $solucion->instrumento->nombre_instrumento }}
											@else
											No Existe Registro
											@endif
										@endif

								</p>
								<h4 class="panel-title alert detalle_evento_info_adicional fade in m-b-15" style="padding: 5px 5px 5px 15px;"><strong>Clasificación Empresa</strong></h4>
								<p style="padding-left:15%">

									@if(isset($solucion))
											@if(isset($solucion->tipoEmpresa->nombre_tipo_empresa))
											{{ $solucion->tipoEmpresa->nombre_tipo_empresa }}
											@else
											No Existe Registro
											@endif
									@endif
									
								</p>
								<h4 class="panel-title alert detalle_evento_info_adicional fade in m-b-15" style="padding: 5px 5px 5px 15px;"><strong>Ámbito</strong></h4>
								<p style="padding-left:15%">
									
									@if(isset($solucion))
											@if(isset($solucion->ambit->nombre_ambit))
											{{ $solucion->ambit->nombre_ambit }}
											@else
											No Existe Registro
											@endif
									@endif
								</p >
								<h4 class="panel-title alert detalle_evento_info_adicional fade in m-b-15" style="padding: 5px 5px 5px 15px;"><strong>Sector</strong></h4>
								<p style="padding-left:15%">
									@if(isset($solucion))
											@if(isset($solucion->sector->nombre_sector))
											{{ $solucion->sector->nombre_sector }}
											@else
											No Existe Registro
											@endif
									@endif
									
								</p >


						</div>
					</div>
					<!-- end col-5 -->
					<!-- inicio acciones -->
					<div class="col-md-9">

					<div class="panel panel-inverse overflow-hidden">
						<div class="panel-heading" style="background-color:#214974">
							<h3 class="panel-title" style="color:white">
	                  			<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseInfoGeneral">
	                      		<i class="fa fa-plus-circle pull-right"></i>
								<strong>Informacion General</strong>
	                  			</a>
							</h3>
						</div>
            		<div id="collapseInfoGeneral" class="panel-collapse collapse">

							<div class="panel-body">

									<div class="media-body"><br />
										f
	                                <label class='text-success'>

	                                	<strong>Datos Generales:</strong>
	                                </label>
	                                <div>
	                                	<table id="data-table2" class="table table-striped table-bordered"">

												<tr>
											    <th><label class='text-default'>

				                                	Codigo:

				                                </label></th>
												    <td>
												    	{{$solucion->id}}
						                             </td>
											  </tr>
	                                			<tr>
											    <th><label class='text-default'>

				                                	Creado:

				                                </label></th>
												    <td>
												    	@if(isset($solucion))
														{{ substr($solucion->created_at,0,10) }}
														@endif
						                             </td>
											  </tr>
											  <tr>
											    <th>Fecha de Cumplimiento:</th>
												    <td>
														@if($solucion->estado->nombre_estado=="Finalizado")
															{{$actividadUltima->created_at}}
														@else
												    	@if($solucion->fecha_cumplimiento!="0000-00-00")
						                                  	{{$solucion->fecha_cumplimiento}}
						                                  	@else
						                                  	No Definido
						                                  	@endif
														@endif
						                             </td>
											  </tr>
											@if($solucion->estado->nombre_estado!="Finalizado")
											  <tr>
											    <th>Plazo de Propuesta:</th>
												    <td>@if($solucion->plazo_cumplimiento!="")
						                                  	{{$solucion->plazo_cumplimiento}}
						                                  	@else
						                                  	No Definido
						                                  	@endif
						                            </td>
											  	</tr>
											  <tr>
											    <th>Riesgos:</th>
												    <td>@if($solucion->riesgos_cumplimiento!="")
						                                  	{{$solucion->riesgos_cumplimiento}}
						                                  	@else
						                                  	No Definido
						                                  	@endif
						                            </td>
											  </tr>
											  <tr>
											    <th>Supuestos:</th>
												    <td>@if($solucion->supuestos_cumplimientos!="")
						                                  	{{$solucion->supuestos_cumplimientos}}
						                                  	@else
						                                  	No Definido
						                                  	@endif
						                            </td>
											  </tr>
											@endif
											</table>
	                                </div>

									<br>
	                                <label class='text-success'>

	                                	<strong>Datos Responsables:</strong>
	                                </label>
                                   	<div>
                                   		<table id="data-table1" class="table table-striped table-bordered">
					                                    <thead>
					                                        <tr>
					                                            <th>Responsable</th>
					                                            <th>Corresponsable</th>

					                                        </tr>
					                                    </thead>
					                                    <tbody>
					                                        <tr class="odd gradeX">
					                                            <td>
					                    @if(isset($actoresSoluciones))
											@foreach($actoresSoluciones as $actorSolucion)
												@if($actorSolucion->tipo_actor == 1)

													{{ $actorSolucion->usuario-> name }}



												@endif
											@endforeach
										@endif
										@if(count($actoresSoluciones)==0)
										No Asignado
										@endif

					                                            </td>
					                                            <td>
					                    <dd>
										@if(isset($actoresSoluciones))
											<ul>
												@foreach($actoresSoluciones as $actorSolucion)
													@if($actorSolucion->tipo_actor == 2)
														<li>{{ " ".$actorSolucion->usuario-> name }}</li>
													@else
													No Asignado
													@endif

												@endforeach
											</ul>
										@endif

										</dd>
					                                            </td>

					                                        </tr>




					                                    </tbody>
					                                </table>
                                   	</div>


									</div>




								</div>
							</div>
						</div>
						<div class="panel panel-inverse overflow-hidden">
							<div class="panel-heading header_detail_propuesta">
								<h3 class="panel-title" style="color:#ffffff">
									<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									    <i class="fa fa-plus-circle pull-right"></i>
										<strong>Datos de la Mesa de Dialogo</strong>
									</a>
								</h3>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									<label class='text-success'>
                                		<strong>Fuente</strong>
                                	</label>

									<p>
                          				<strong>Evento:</strong>
            							@if(isset($solucion))
            								{{ $solucion->nombre }}
            							@endif
            							<br /><strong>Provincia:</strong>
            							@if(isset($solucion))
            								{{ $solucion->provincia->nombre_provincia }}
            							@endif
            							<br /><strong>Líder de Mesa:</strong>
            							@if(isset($solucion))
            								{{ $solucion->lider }}
            							@endif
            							<br /><strong>Sistematizador de Mesa:</strong>
            							@if(isset($solucion))
            								{{ $solucion->sistematizador }}
            							@endif
            							<br /><strong>Coordinador de Mesa:</strong>
            							@if(isset($solucion))
            								{{ $solucion->coordinador }}
            							@endif

                                   	</p>
								</div>
							</div>
						</div>
						<div class="panel panel-inverse overflow-hidden">
							<div class="panel-heading" style="background-color:#214974" >
								<h3 class="panel-title" style="color:#17202A">
									<h3 class="panel-title" style="color:#ffffff">
									<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
									    <i class="fa fa-plus-circle pull-right"></i>
										<strong>Solución Propuesta</strong>
									</a>
								</h3>
							</div>
							<div id="collapse3" class="panel-collapse collapse in">
								<div class="panel-body">
									<label class='text-success'>
                                		<i class="fa fa-cheked-o fa-fw"></i><strong>Solución</strong>
                                	</label>
									<blockquote>
										  	<p><h5>
										  		@if(isset($solucion))
													{{ $solucion->propuesta_solucion }} 
												@endif
										  	</h5>
                                   	</blockquote>
								</div>
							</div>
						</div>
						@if(isset($solucion))
							@if($solucion->probleme_solucion!='')
						<div class="panel panel-inverse overflow-hidden">
							<div class="panel-heading" style="background-color:#214974" >
								<h3 class="panel-title" style="color:#ffffff">
									<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									    <i class="fa fa-plus-circle pull-right"></i>
										<strong>Problematica</strong>
									</a>
								</h3>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="panel-body">
									<label class='text-success'>
                                		<i class="fa fa-cheked-o fa-fw"></i><strong>Problematica</strong>
                                	</label>
									<blockquote>
										  	<p><h5>
										  		@if(isset($solucion))
													{{ $solucion->problema_solucion }}
												@endif
										  	</h5>
                                   	</blockquote>
								</div>
							</div>
						</div>
							@endif
						@endif


						<div class="panel panel-inverse  overflow-hidden">
							<div class="panel-heading" style="background-color:#214974" >
								<h3 class="panel-title" style="color:#ffffff">

									 <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
									    <i class="fa fa-plus-circle pull-right"></i>
										<strong>Actividades Registradas</strong>
										</a>

								</h3>
							</div>
							<div id="collapseFive" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="media-body">
										<br>
										@if(isset($actividades) &&  count($actividades) > 0)
									<label class='text-success'><b>Actividades Resgistradas: </b></label>{{ count($actividades) }}
									<span class="pull-right" style="font-size: 12px">Ordenado desde la m&aacute;s reciente</span>
									<hr>
									<table id="data-table" class="table table-striped table-bordered" width="100%">
								<thead>

									<th class="text-center">Actividades</th>


								</thead>
								<tbody>
									@foreach($actividades as $actividad)
						        	<tr>

						        		<td>
						        		<b>Fecha de Inicio: </b> {{ $actividad-> created_at}}<br>
						        		<b>Ejecutor: </b> {{ $actividad-> usuario-> name}}<br>
										{!! $actividad -> comentario!!}<br>
										<!--ARCHIVOS-->
											@if( count( $actividad-> archivo) > 0)
											<hr>
											<em> Archivos: </em> <br>

													@foreach($actividad-> archivo as $file)

														<!-- <a target="_blank" href="'../../../../../../storage/{{ $file-> nombre_archivo }} "> -->
														<a target="_blank" href="{{ route('descargarArchivo',$file-> nombre_archivo) }} ">
															<?php
																$pos = strpos($file-> nombre_archivo, "_-_");
																$nombre_archivo = substr($file-> nombre_archivo, $pos+3, strlen($file-> nombre_archivo)); // devuelve "d"
															?>

															{{$nombre_archivo}}
														</a>

													@endforeach

											@endif

											<!--FIN ARCHIVOS-->
						        		</td>

						        	</tr>
						       	 	@endforeach
			     				</tbody>

							</table>
							@else
										No se encontraron actividades registradas.
							@endif


								</div>
								</div>
							</div>

						</div>


					</div>



					</div>
					<!-- fin acciones  -->
					</div>



			</div>
		</div>

@endsection

@section('end_js')
  @parent




  <script src="{{ asset('plugins/DataTablesv2/datatables.js') }}"></script>
	<script src="{{ asset('js/table-manage-responsive.demo.js') }}"></script>
	<script src="{{ asset('plugins/scrollMonitor/scrollMonitor.js') }}"></script>
	<script src="{{ asset('js/custom-mipro.js" type="text/javascript') }}"></script>
	<script src="{{ asset('js/apps.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>


@endsection

@section('init_scripts')

  <script>

		$(document).ready(function() {
			App.init();
			TablaCCPTHome.init();
		});

	</script>

  <script>
function goBack() {
    window.history.back();
}
</script>

@endsection
