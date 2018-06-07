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
			<div class="brand">
                <img src="{{ asset('imagenes/inteligencia_productiva_home.png') }}" class="left-block img-responsive" alt="Cinque Terre" width="337px" height="55px"><br>
            </div>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-12 -->
				<div class="col-md-12 col-sm-12">
					<div class="widget widget-stats bg-green-darker">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>Soluci&oacute;n</h4>
							<p>
								@if (isset($solucion) )
									{{ $solucion-> nombre_pajustada }}
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
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								
							</div>
							<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Actividades</h4>
						</div>
						<div class="panel-body">
							<div class="height-lg" data-scrollbar="true">

								@include('flash::message')
								
								<div class="media-body">

									@if (isset($solucion) && isset($tipo_actor) )
										@if($tipo_actor == 1)
											<!-- <a href="#" class="btn	btn-warning pull-right">Finalizar</a> -->
											<a href="{{ url('institucion/home') }}" class="btn btn-default pull-left">&laquo; Regresar</a>
											<a href="{{ route('actividades.createConsejo',$solucion->id) }}" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Nueva</a>
											<hr>
											<br>
										@endif
									@endif

									<h3>LISTA DE ACTIVIDADES</h3><hr>
									@if( isset( $actividades ) && count($actividades) > 0)
										<?php $count=count($actividades) ; ?>
										@foreach( $actividades as $actividad)
											<h4>
												<label class="label label-danger label-lg">Actividad {{ $count }}</label><br><br>
											</h4>
											<p class="text-justify">
												{{ $actividad-> comentario }}
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
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								
							</div>
							<h4 class="panel-title"><i class="fa fa-users" aria-hidden="true"></i> Actores</h4>
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
						</div>
					</div>
					
					
				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop
		
        