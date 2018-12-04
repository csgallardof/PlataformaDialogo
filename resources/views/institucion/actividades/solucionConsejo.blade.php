@extends('layouts.consejo-sectorial')
@section('title', 'Solucion')

@section('content')

<style>
            .wrapper {
                width: 200px;
            }
            
            .progress-bar {
                width: 100%;
                background-color: #e0e0e0;
                padding: 3px;
                border-radius: 3px;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
            }
            
            .progress-bar-fill {
                display: block;
                height: 22px;
                /*background-color: #005252;*/
                background-image: linear-gradient(to right, #006100 , #004080);
                border-radius: 3px;
                
                transition: width 500ms ease-in-out;
            }


            .progress-bar-fill2 {
                display: block;
                height: 22px;
                /*background-color: #005252;*/
                background-image: linear-gradient(to right, #5C5C00, #B30000);
                border-radius: 3px;
                
                transition: width 500ms ease-in-out;
            }
        </style>

<!-- begin #content -->
<div id="content" class="content" width="10%" style="background-color: #f3f3f3;">

	<!-- begin breadcrumb -->
	<!--<ol class="breadcrumb pull-right">
		<li><a href="{{ url('institucion/home') }}">Inicio</a></li>
		<li class="active">Propuesta</li>
	</ol>-->
	<!-- end breadcrumb -->
	<!-- begin page-header -->

	<!--<br/>-->

	<!-- end page-header -->

	<!-- begin row 1-->
	 @include('flash::message')
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">

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
					<br/>
					@if($solucion->nombre_estado =="Finalizado")
					<span class="label label-success f-s-12"  style="background-color: #28B463">
						{{$solucion->nombre_estado}}
					</span>

					@endif
				</div>
			</div>
		
	
					<div class="col-md-8">
						<div class="panel panel-inverse">
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
									<a class="btn btn-primary  m-b-30 m-l-30" href="{{ url('consejo-sectorial/detalle-propuesta',[$solucion->id]) }}">Ver Propuesta</a>
								</center>
							</div>
						</div>
					</div>


					<div   class="col-md-4">
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


				</div>
		<!-- end col-12 -->				

			</div>
	<!-- end row -->
	<!-- begin row 2-->

	<div class="row" >
		<!-- begin col-8 -->
		<div class="col-md-12">

			<!---->

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Actividades</h4>
				</div>
				<div class="panel-body">


					

						@include('flash::message')

						<div class="table-responsive">

							<?php
												//dd($solucion->estado_id);
												//echo  $actividad = count($actividades) ?>

												@if (isset($solucion))

												<!-- <a href="#" class="btn	btn-warning pull-right">Finalizar</a> -->
												<!--<a href="{{ url('institucion/home') }}" class="btn btn-default pull-left">&laquo; Regresar</a>-->
												<a href="{{ url('consejo-sectorial/home') }}" class="btn btn-default pull-left">&laquo; Regresar</a>
												&nbsp;&nbsp;
												@if($solucion->estado_id == 6)
												<a href="{{ route('consejo.activarSolucion',$solucion->id) }}" class="btn btn-default pull-left">Activar</a>
												@endif

												@if($solucion->estado_id == 4 )

												<a href="#modal-alert" class="btn btn-danger" data-toggle="modal">Aperturar Propuesta</a>
												<!-- #modal-alert -->
												<div class="modal fade" id="modal-alert">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																<h4 class="modal-title"><br>ALERTA APERTURAR PROPUESTA</h4>

															</div>
															<div class="modal-body">
																<div class="alert alert-info m-b-0">
																	<h4><i class="fa fa-info-circle"></i><strong>Usted esta seguro aperturara un propuesta</strong></h4>
																	<p> <strong> Para aperturar la Propuesta debe  registrar una el motivo actividad.</strong> <br> <br>Click en <strong>Continuar</strong> si desea aperturar la Propuesta. <br><br>
																		<strong>Recuerde</strong> <br>
																	</p>
																</div>
																<p>
																	<strong>Propuesta</strong>:{{ $solucion->propuesta_solucion }}
																</p>
															</div>
															<div class="modal-footer">
																<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
																<a href="{{ route('aperturar.Propuesta',$solucion->id) }}" class="btn btn-sm btn-danger">Continuar</a>
															</div>
														</div>
													</div>
												</div>
												@endif



												@endif


												<div id="collapseFive" class="panel-collapse collapse in">
													<div class="panel-body">
														<!--<div class="media-body">-->
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


																		<b>Comentario:</b>{!! $actividad-> comentario !!}<br/>
																		<b> Fecha de Inicio: </b> {{ substr($actividad->fecha_inicio,0,10) }}<br/>
																		<b> Ejecutor: </b> {{ $actividad-> institucion-> nombre_institucion }}<br/>
																		<!--ARCHIVOS-->

																		@if( count( $actividad-> archivo) > 0)
																		<hr>
																		<em> Archivos: </em><br/>

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
								


								<!--</div>-->
							</div>
						</div>

					</div>
					<!-- end col-8 -->





	
				</div>
				<!-- end row -->
			</div>
			<!-- end #content -->

	
@stop