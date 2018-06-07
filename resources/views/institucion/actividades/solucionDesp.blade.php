@extends('layouts.institucion')

@section('content')

<!-- begin #content -->
		<div id="content" class="content" width="10%">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="{{ url('institucion/home') }}">Inicio</a></li>
				<li class="active">Propuesta</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->

<br />

			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
				<!-- begin col-12 -->
				<div class="col-md-12 col-sm-12">
					<div class="widget widget-stats bg-green-darker">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>Soluci&oacute;n</h4>
							<p class="f-s-20">
								@if (isset($solucion) )
									{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion }}
								@endif
							</p>
						</div>
						<div class="stats-link">
							<a href="javascript:;">&nbsp;</a>
						</div>
					</div>
				</div>
				<!-- end col-12 -->
			</div>
			<!-- end row -->
			
			<!-- begin row -->
			
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-8">

					<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->

							</div>

							<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Actividades</h4>
						</div>
						<div class="panel-body">
							<div class="height-lg" >

								@include('flash::message')

								<div class="media-body">

									@if (isset($solucion) && isset($tipo_actor) )
										@if($tipo_actor == 1 or $tipo_actor == 2 )
											<!-- <a href="#" class="btn	btn-warning pull-right">Finalizar</a> -->
											<a href="{{ url('institucion/home') }}" class="btn btn-default pull-left">&laquo; Regresar</a>&nbsp;&nbsp; 
											@if($solucion->plazo_cumplimiento=="")
											<a href="{{ route('solucion.parametrosCumplimiento',$solucion->id) }}" class="btn btn-success "> Definir Parametros de Cumplimiento</a>
											@endif
											@if($solucion->estado_id<=3)
											<a href="{{ route('actividades.createDespliegue',$solucion->id) }}" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Nueva</a>&nbsp;&nbsp;
											@if(count($actividades) > 0)
											
											<a href="#modal-alert" class="btn btn-primary" data-toggle="modal">Finalizar Propuesta</a>
											<!-- #modal-alert -->
										<div class="modal fade" id="modal-alert">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title"><br>ALERTA DE FINALIZAR PROPUESTA</h4>
													
													</div>
													<div class="modal-body">
														<div class="alert alert-info m-b-0">
															<h4><i class="fa fa-info-circle"></i><strong>Usted esta seguro de  Finalizar Propuesta</strong></h4>
															<p> <strong> Para Finalizar la Propuesta debe  registrar una última actividad.</strong> <br> <br>Clic en <strong>Continuar</strong> si desea finalizar la Propuesta. <br><br> 
																<strong>Recuerde</strong> una vez finalizada la propuesta no podra registrar mas actividades. <br><br>
																</p>
														</div>
														<p>
															<strong>Propuesta</strong>:{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion }}
														</p>
													</div>
													<div class="modal-footer">
														<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
														<a href="{{ route('cierre.Propuesta',$solucion->id) }}" class="btn btn-sm btn-danger">Continuar</a>
													</div>
												</div>
											</div>
										</div>
											@endif
											@endif
											<hr>
											<br>
										@endif
									@endif

									<h3>LISTA DE ACTIVIDADES</h3><hr>
									@if( isset( $actividades ) && count($actividades) > 0)
										<?php $count=count($actividades) ; ?>
										@foreach( $actividades as $actividad)
											<h4>
												<label class="label label-danger label-lg"><i class="fa fa-file-text-o" aria-hidden="true"></i>
 												 Actividad {{ $count }}</label><br><br>
											</h4>
											<p class="text-justify">
												{!! $actividad-> comentario !!}
											</p>
												<br>

												<b> Fecha de Inicio: </b> {{ substr($actividad->fecha_inicio,0,10) }}<br>
												@if( $actividad-> ejecutor_id > 0 )
													<b> Ejecutor: </b> {{ $actividad-> usuario-> name }}<br><br>
												@endif

													<!--ARCHIVOS-->
														@if( count( $actividad-> archivo) > 0)
														<b> Archivos: </b> <br>
															<ul>
																@foreach($actividad-> archivo as $file)
																<li>
																	<!-- <a target="_blank" href="'../../../../../../storage/{{ $file-> nombre_archivo }} "> -->
																	<a target="_blank" href="{{ route('descargarArchivo',$file-> nombre_archivo) }} ">
																		<?php
																			$pos = strpos($file-> nombre_archivo, "_-_");
																			$nombre_archivo = substr($file-> nombre_archivo, $pos+3, strlen($file-> nombre_archivo)); // devuelve "d"
																		?>

																		{{$nombre_archivo}}
																	</a>
																</li>
																@endforeach
															</ul>
														@endif

													<!--FIN ARCHIVOS-->



											<hr>
											<?php $count--; ?>
										@endforeach
									@else
										@if( count($actividades) == 0)
											{{ "No hay actividades registradas"}}
										@endif
									@endif

								</div>


							</div>
						</div>
					</div>

				</div>
				<!-- end col-8 -->
				<!-- begin col-4 -->
				<div class="col-md-4" >
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->

							</div>
							<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Actores</h4>
						</div>
						<div class="panel-body p-t-0">
							<table class="table table-valign-middle m-b-0">
								<thead>
									<tr>
										<th>Institución</th>
										<th>Responsabilidad</th>
									</tr>
								</thead>
								<tbody>
									@if( isset($actoresSoluciones) )
										@foreach( $actoresSoluciones as $actorSolucion )
											<tr>
												<td>{{ $actorSolucion->usuario->name}}</td>
												<td>
													@if($actorSolucion->tipo_actor == 1)
														<em>{{ "Responsable" }}</em>
													@else
														<em>{{ "Corresponsable" }}</em>
													@endif
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
							<hr>
							<center>
							<a class="btn btn-primary  m-b-30 m-l-30" href="/detalle-despliegue-dialogo/{{ $solucion->id}}">Ver Propuesta</a>
							</center>
						</div>
					</div>

				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop