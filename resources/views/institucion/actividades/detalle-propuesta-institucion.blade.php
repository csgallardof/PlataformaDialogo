@extends('layouts.institucion')

@section('title', 'Reporte')

@section('start_css')
  @parent
  <link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
  <script src="{{ asset('js/gen_validatorv4.js?1') }}" type="text/javascript"></script>

@endsection

@section('contenido')


<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right fit-m-b-10">
				<li><a href="{{ url('institucion/home') }}">Inicio</a></li>
				<li class="active">Propuesta</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-12">
					<a class="btn btn-primary  m-b-30 m-l-30" href="{{ url('institucion/verSolucion/despliegue/1',[$solucion->id]) }}">Regresar</a>
					<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								
							</div>
							<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Información</h4>
						</div>
						<div class="panel-body">
							<!-- inicio informacion general -->
								<p><strong>Instrumentos Necesario: </strong>

										@if(isset($solucion))
											@if(isset($solucion->instrumento->nombre_instrumento))
											{{ $solucion->instrumento->nombre_instrumento }}
											@else
											No Existe Registro
											@endif
										@endif

								
								<p><strong>Clasificación Empresa: </strong>
									@if(isset($solucion))
											@if(isset($solucion->tipoEmpresa->nombre_tipo_empresa))
											{{ $solucion->tipoEmpresa->nombre_tipo_empresa }}
											@else
											No Existe Registro
											@endif
									@endif
								<p><strong>Ámbito: </strong>
									@if(isset($solucion))
											@if(isset($solucion->ambit->nombre_ambit))
											{{ $solucion->ambit->nombre_ambit }}
											@else
											No Existe Registro
											@endif
									@endif
								<p><strong>Sector: </strong>
									@if(isset($solucion))
											@if(isset($solucion->sector->nombre_sector))
											{{ $solucion->sector->nombre_sector }}
											@else
											No Existe Registro
											@endif
									@endif
									
								
							<!-- fin informacion general -->

							<div class="col-md-10 p-t-150">
						@include('flash::message')
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

															{{ $actorSolucion->institucion->nombre_institucion }}



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
																<li>{{ " ".$actorSolucion->institucion->nombre_institucion }}</li>
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
										<!--<h3 class="panel-title" style="color:#17202A">-->
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
								        		<b>Ejecutor: </b> {{ $actividad-> institucion->nombre_institucion}}<br>
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
				<!-- end col-8 -->
				
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->



