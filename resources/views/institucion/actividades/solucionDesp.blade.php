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
									{{ $solucion->propuesta_solucion }}
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
		
							<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Actividades</h4>
						</div>
						<div class="panel-body">
							<div class="height-lg" >

								@include('flash::message')

								<div class="media-body">

									@if (isset($solucion) && isset($tipo_actor) )
									@if($tipo_actor == 1)
									<!-- <a href="#" class="btn	btn-warning pull-right">Finalizar</a> -->
									<a href="{{ url('institucion/home') }}" class="btn btn-default pull-left">&laquo; Regresar</a>&nbsp;&nbsp;


									@if($solucion->estado_id==1)
									<a href="#modal-desestimada" data-toggle="modal" class="btn btn-warning"><i class="fa fa-warning" aria-hidden="true"></i> Desestimada</a>&nbsp;&nbsp;
									@endif
									@if($solucion->estado_id==1)
									<a href="#modal-conflicto" data-toggle="modal" class="btn btn-warning"><i class="fa fa-legal" aria-hidden="true"></i> En Conflicto</a>&nbsp;&nbsp;
									@endif
									@endif
									@if($solucion->estado_id<=3)

									<a href="{{ route('actividades.createDespliegue',$solucion->id) }}" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Nueva</a>&nbsp;&nbsp;
									@if(count($actividades) > 0)

									<a href="{{ route('solucion.parametrosCumplimiento',$solucion->id) }}" class="btn btn-warning "> Definir Parametros de Cumplimiento</a>

									<a href="#modal-alert" class="btn btn-primary" data-toggle="modal">Finalizar Propuesta</a>

									@endif
									@endif
									@endif


									<div id="collapseFive" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="media-body">
												<h3 align="left" class="panel-title">LISTA DE ACTIVIDADES</h3>	
												@if( isset( $actividades ) && count($actividades) > 0)

												<hr>
												<table id="data-table" class="table table-striped table-bordered" width="100%">
													<thead>
														<th class="text-center">Actividades</th>
													</thead>

													<tbody>

														@foreach( $actividades as $actividad)
														<tr>
															<td>
																<b class="text-justify"Comentario></b>{!! $actividad-> comentario !!}<br/>
																<b> Fecha de Inicio: </b> {{ substr($actividad->fecha_inicio,0,10) }}<br/>
																<b> Ejecutor: </b> {{ $actividad-> institucion-> nombre_institucion }}<br/>
																<!--ARCHIVOS-->
																@if( count( $actividad-> archivo) > 0)
																<hr>
																<b> Archivos: </b><br/>
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

															</td>
														</tr>

														@endforeach
													</tbody>
												</table>
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
						</div>

					</div>
				</div>
				<!-- end col-8 -->
				<!-- begin col-4 -->
				<div class="col-md-4" >
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							
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
												<td>{{ $actorSolucion->institucion->nombre_institucion}}</td>
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
							<a class="btn btn-primary  m-b-30 m-l-30" href="{{ url('institucion/detalle-propuesta',[$solucion->id]) }}">Ver Propuestas</a>
							</center>
						</div>
					</div>
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							<?php 
							   $total=0;
							   $total_buenas=0;
							   $total_malas=0;
                               foreach ($percepcion as $perc) {
                               	          $total=$total+1;
                               	          if($perc->ev_semaforo=="BUENA") {
												$total_buenas=$total_buenas+1;
                               	          }else{
												$total_malas=$total_malas+1;

                               	          }
                               }
                               $porcent_b= 0;
                               $porcent_m= 0;
                               
                               if($total>0){

                                  $porcent_b= round(($total_buenas*100)/$total,0);	
                                  $porcent_m= round(($total_malas*100)/$total,0);	
                               }
                               
                               //$porcent_b=100;
                               //$porcent_m=0;

							?>
							
							<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Percepci&oacuten Ciudadana</h4>
						</div>
						<div class="panel-body p-t-0">
							<table  class="table table-valign-middle m-b-0" width="100%">
								<tr><th>Total ingresadas:
								    </th>
								    <td><?php echo $total; ?></td>
								</tr>
							</table>

							<table  class="table table-valign-middle m-b-0" width="100%">
								<tr><th style="width:20%;">Total Buenas:
								    </th>
								    <td style="width:20%;"><?php echo $total_buenas; ?></td>
								    <td style="background-color:#575757;"><div style="width:<?php echo $porcent_b; ?>%;height:100%; background-image: linear-gradient(to right, #008000 , #004D00); background-color:#006600;  border-top-right-radius: 25px; padding:10px;color:white;font-weight:bold;"><?php echo $porcent_b; ?>%</div></td>
								</tr>
								<tr><th>Total Malas:
								    </th>
								    <td><?php echo $total_malas; ?></td>
								    <td style="background-color:#575757;"><div style="width:<?php echo $porcent_m; ?>%;height:100%;background-image: linear-gradient(to right, #E00000 , #700000);background-color:#AD0000; border-top-right-radius: 25px;padding:10px;color:white;font-weight:bold;"><?php echo $porcent_m; ?>%</div></td>
								</tr>

							</table>

						</div>
					</div>

				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		<!-- MODAL FINALIZAR -->
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
							<strong>Propuesta</strong>:{{ $solucion->propuesta_solucion }}
						</p>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
						<a href="{{ route('cierre.Propuesta',$solucion->id) }}" class="btn btn-sm btn-danger">Continuar</a>
					</div>
				</div>
			</div>
		</div>


		<!-- MODAL POR  DEFINIR-->
		<div class="modal fade" id="modal-conflicto">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title"><br>ALERTA DE PROPUESTA EN CONFLICTO</h4>

					</div>
					<div class="modal-body">
						<div class="alert alert-info m-b-0">
							<h4><i class="fa fa-info-circle"></i><strong>Esta propuesta cambiará de estado en CONFLICTO</strong></h4>
							<p> <strong> Al momento cambiar de estado, se crea una alerta para el Consejo Sectorial que preside a su institución.</strong> <br> <br>Clic en <strong>Continuar</strong> si desea finalizar la Propuesta. <br><br>
								<strong>Recuerde</strong> una vez que cambie de estado la propuesta no podra registrar más actividades. <br><br>
								</p>
						</div>
						<p>
							<strong>Propuesta</strong>:{{ $solucion->propuesta_solucion }}
						</p>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
						<a href="{{ route('conflicto.Propuesta',$solucion->id) }}" class="btn btn-sm btn-danger">Continuar</a>
					</div>
				</div>
			</div>
		</div>


		<!-- MODAL POR DESESTIMADA-->
		<div class="modal fade" id="modal-desestimada">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title"><br>ALERTA DE PROPUESTA EN DESESTIMADA</h4>

					</div>
					<div class="modal-body">
						<div class="alert alert-info m-b-0">
							<h4><i class="fa fa-info-circle"></i><strong>Esta propuesta cambiará de estado como DESESTIMADA</strong></h4>
							<p> <strong> Al momento cambiar de estado, se crea una alerta para el Consejo Sectorial que preside a su institución.</strong> <br> <br>Clic en <strong>Continuar</strong>
								<strong>Recuerde</strong> una vez que cambie de estado la propuesta no podra registrar más actividades. <br><br>
								</p>
						</div>
						<p>
							<strong>Propuesta</strong>:{{ $solucion->propuesta_solucion }}
						</p>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
						<a href="{{ route('desestimar.Propuesta',$solucion->id) }}" class="btn btn-sm btn-danger">Continuar</a>
					</div>
				</div>
			</div>
		</div>

		@stop
