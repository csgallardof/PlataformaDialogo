@extends('layouts.institucion')

@section('title','Inicio')


@section('content')


		<!-- begin #content -->
		<div id="content" class="content" width="10%" style="background-color: #f3f3f3;">
			<!-- begin breadcrumb -->

			<br />





			<!--

				@if($tipo_fuente==5 or $tipo_fuente==4)
			<ol class="breadcrumb pull-right">
				<a href="/institucion/consejo-sectorial-produccion" class="btn btn-primary">Consejo Sectorial</a>

			</ol>
			@endif
			 -->


			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<!-- <div class="brand">
                <img src="{{ asset('imagenes/inteligencia_productiva_home.png') }}" class="left-block img-responsive" alt="Cinque Terre" width="337px" height="55px"><br>
            </div> -->
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4>TOTAL DE PROPUESTAS</h4>
							@if (isset($totalDespliegue) )
								@if(isset($totalConsejo) )
									<p>{{ $totalDespliegue + $totalConsejo }}</p>
								@else
									<p>{{ $totalDespliegue }}</p>
								@endif
							@else
								@if(isset($totalConsejo) )
									<p>{{ $totalConsejo }}</p>
								@else
									<p>0</p>
								@endif
							@endif
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4>MESAS COMPETITIVAS</h4>
							@if (isset($totalDespliegue) )
								<p>{{ $totalDespliegue }} Propuestas</p>
							@else
								<p>0 Propuestas</p>
							@endif
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4>CONSEJO CONSULTIVO</h4>
							@if (isset($totalConsejo) )
								<p>{{ $totalConsejo }} Propuestas</p>
							@else
								<p>0 Propuestas</p>
							@endif
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
			<!-- end row -->





			<div>
				<div class="alert alert-success fade in m-b-15" >
							<small>
								En caso de que una propuesta no pertenezca a su institución, contactarse a inteligencia@mipro.gob.ec con su respectiva justificación. <br>
								Si desea actualizar su usuario contactarse inteligencia@mipro.gob.ec

								<span class="close" data-dismiss="alert">&times;</span>
								</small>
							</div>
							<div class="alert alert-info fade in m-b-15">
								<small>
								Al momento de unificar Propuestas las acciones no se transfieren.
								<span class="close" data-dismiss="alert">&times;</span>
								</small>
							</div>

					<a   class="btn btn-primary pull-left m-b-30 m-l-30" href="/institucion/unificar-propuestas">Unificar Propuestas</a>

			</div>
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-12">


					<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">

						<li class="active">
							<a href="#responsable" data-toggle="tab">
								<i class="fa fa-sticky-note-o m-r-5"></i>
								<span class="hidden-xs">Responsable</span>
								@if( isset($totalResponsable) )
									({{ $totalResponsable }})
								@endif
							</a>
						</li>
						<li class="">
							<a href="#corresponsable" data-toggle="tab">
								<i class="fa fa-sticky-note m-r-5"></i>
								<span class="hidden-xs">Corresponsable</span>
								@if( isset($totalCorresponsable) )
									({{ $totalCorresponsable }})
								@endif
							</a>
						</li>
						<li class=""><a href="#general" data-toggle="tab"><i class="fa fa-newspaper-o m-r-5"></i> <span class="hidden-xs">
						Todas (
						
						</span></a></li>
					</ul>
					<div class="tab-content" data-sortable-id="index-3">

						<!--SOLUCIONES RESPONSABLE-->
						<div class="tab-pane fade active in" id="responsable">
							<div class="" data-scrollbar="false">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Codigo</th>
											<th>Propuesta</th>
											<th>Fuente</th>
											<th>Estado</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
										@if( isset($solucionesDespliegue) )

											@foreach($solucionesDespliegue as $solucionD)
												@if($solucionD->tipo_actor == 1)
													<tr>
														<td class="text-justify">{{$solucionD->id}}</td>
														<td class="text-justify">{{$solucionD->propuesta_solucion}}</td>

														<td>
															
														</td>

														<td>
															@if($solucionD->nombre_estado=="Cierre")
															<span class="label label-success f-s-12" style="background-color: #28B463">{{$solucionD->nombre_estado}}</span>
																<span class="label label-info">
																	
																</span>
															@endif

															@if($solucionD->nombre_estado=="En Desarrollo")
															<span class="label label-default f-s-12" style="background-color: #CA6F1E">{{$solucionD->nombre_estado}}</span>
																<span class="label label-info">
																
																</span>
															@endif

															@if($solucionD->nombre_estado=="En Análisis")
															<span class="label label-default f-s-12" style="background-color: #A6ACAF">{{$solucionD->nombre_estado}}</span>
																<span class="label label-info">
																	
																</span>

															@endif
														</td>
														<td>
															<a href="{{ route('verSolucion.despliegue',[1,$solucionD->id]) }}" class="btn btn-link f-s-13 f-w-500">Ver detalle</a>
														</td>
													</tr>
												@endif
											@endforeach

										@endif

										

									</tbody>
								</table>
							</div>
						</div>
						<!--FIN SOLUCIONES RESPONSABLE-->

						
						<!--FIN SOLUCIONES CORRESPONSABLE-->

						<!--SOLUCIONES EN GENERAL-->
						
						<!--FIN SOLUCIONES EN GENERAL-->


					</div>

				</div>
				<!-- end col-8 -->
				<!-- begin col-4 -->
				<div class="col-md-12" >
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
							</div>
							<h4 class="panel-title">Notificaciones<br> (&uacute;ltima semana)</h4>
						</div>
						<div class="panel-body">
							@if( isset($notificaciones) && count($notificaciones) > 0 )
								<ul>
									@foreach($notificaciones as $notificacion)
										<li>
											{!! substr($notificacion-> comentario,0,65).'..' !!} <br>
											{{ substr($notificacion-> fecha_inicio,0,10) }}
											@if($notificacion->tipo_fuente == 1)
												<a href="{{ route('verSolucion.despliegue',[2,$notificacion-> solucion_id]) }}" class="pull-right f-s-13 f-w-500">Ver m&aacute;s</a><br><br>
											@endif
											@if($notificacion->tipo_fuente == 2)
												<a href="{{ route('verSolucion.consejo',[2,$notificacion-> solucion_id]) }}" class="pull-right f-s-13 f-w-500">Ver m&aacute;s</a><br><br>
											@endif

										</li>
									@endforeach
								</ul>
							@else
								No existen notificaciones recientes.
							@endif
						</div>
					</div>
					<!-- <div class="panel panel-inverse" data-sortable-id="index-7">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">&Uacute;ltimas actividades</h4>
						</div>
						<div class="panel-body">

						</div>
					</div> -->

				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop
