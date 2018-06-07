@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  <link href="{{ asset('plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')

		<!-- begin #about -->
		<div id="about" class="content row-m-t-2" data-scrollview="true">
				<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
				<div class="row">

					<div class="col-md-12">

						<!-- begin breadcrumb -->
						<ol class="breadcrumb pull-right">
							<li><a href="dashboard.php">Home</a></li>
							<li class="active">Fichas</li>
						</ol>
						<!-- end breadcrumb -->

					</div>

				</div>

			</div>

		</div>
		<!-- end container -->

			<!-- end page-header -->

		<!-- begin #about -->
		<div class="content row-m-t-2" data-scrollview="true">
				<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInDown">

				<div class="modal-header">
					<h4 class="modal-title">
						<br>
						<label class='text-success f-s-12'>
							<a href="{{ url('consejoconsultivo') }}" class="btn btn-success m-r-5"><i class="fa fa-1x fa-search"></i> Nueva Consulta</a>
							<br>
							<br>
							@if(isset($sector))
								<strong>Sector:</strong>
								{{ $sector->nombre_sector }}
							@endif
							@if(isset($ambito))
								<strong> | &Aacute;mbito:</strong>
								{{ $ambito->nombre_ambit }}
							@endif
							@if(isset($sipoc))
								<strong> | Cadena Productiva:</strong>
								{{ $sipoc->nombre_sipoc }}
							@endif

						</label>
					</h4>
				</div>

				<!-- begin row -->
				<div class="row">
					<!-- begin col-5 -->
					<div class="col-md-7">
						<div class="panel panel-inverse" data-sortable-id="index-6" style="border: 1px solid rgba(112, 116, 120, 0.64);">
							<div class="panel-heading" style="padding:5px 5px;">
								<div class="panel-heading-btn">

									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

								</div>
								<h4 class="panel-title">Propuestas /Solución</h4>
							</div>
							<div class="panel-body p-t-0">
								<br>
                            	<label class='text-success f-s-11'>
                            		<i class="fa fa-cheked-o fa-fw"></i><strong>Propuesta Unificada</strong>
                            	</label>
                            	<blockquote>
									  	<p><h5>
									  		@if(isset($pajustada))
												{{ $pajustada->nombre_pajustada }}
											@endif
									  	</h5></p>
									  	<!--VALORACIONES-->

									  	<!-- <div class="row">
									  		<div class="col-md-2"></div>
									  		<div class="col-md-2">
									  			<a href="#"> <i class="material-icons">sentiment_very_satisfied</i></a>
									  		</div>
									  		<div class="col-md-2">
									  			<a href="#"> <i class="material-icons">sentiment_satisfied</i></a>
									  		</div>
									  		<div class="col-md-2">
									  			<a href="#"> <i class="material-icons">sentiment_neutral</i></a>
									  		</div>
									  		<div class="col-md-2">
									  			<a href="#"> <i class="material-icons">sentiment_dissatisfied</i></a>

									  		</div>
									  		<div class="col-md-2">
									  			<a href="#"> <i class="material-icons">sentiment_very_dissatisfied</i></a>
									  		</div>
									  	</div> -->
									  	<!--FIN VALORACIONES-->
                               	</blockquote>

                               	<label class='text-success f-s-11'>
                            		<i class="fa fa-cheked-o fa-fw"></i><strong>Propuestas Originales</strong>
                            	</label>

						  		@if(isset($soluciones))
									@foreach($soluciones as $solucion)
										<div class="panel panel-info">
												<div class="panel-heading f-s-13">
													{{ $solucion->solucion_ccpt }}
												</div>
												<div class="panel-body fade in f-s-11" style="background-color: #d9eaf2;"}}>

														<label class='text-success f-s-11'>
                    									<i class="fa fa-clock-o fa-fw"></i>Creado:
                    									{{ substr($solucion->created_at,0,10) }}
					                                </label><br>
														<strong>Eslabon de la cadena productiva: </strong> {{ $solucion->sipoc->nombre_sipoc }} <br>
														<strong>Instrumentos Necesario: </strong> {{ $solucion->instrumento->nombre_instrumento }} <br>
														<strong>Mesa: </strong>{{ $solucion->mesa->nombre_mesa }} <br>
														<strong>Fomento de la Producci&oacute;n Nacional: </strong>{{ $solucion->thematic->nombre_thematic }}<br>
												</div>
										</div>

									@endforeach
								@endif

	                        </div>

						</div>
					</div>
					<!-- end col-5 -->
					<!-- inicio acciones -->
					<div class="col-md-5">
						<div class="panel panel-inverse" data-sortable-id="index-5" style="border: 1px solid rgba(112, 116, 120, 0.64);" >
							<div class="panel-heading" style="padding:5px 5px;">
								<div class="panel-heading-btn">

									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

								</div>
								<h4 class="panel-title">Acciones de cumplimiento</h4>
							</div>
							<div class="panel-body p-t-0">
								<div class="media-body">
									<br>
										<label class='text-success f-s-11'>

                                	</label>
                            		<dl class="dl-horizontal">

										<dt>RESPONSABLE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
										@if(isset($actoresSoluciones))
											@foreach($actoresSoluciones as $actorSolucion)
												@if($actorSolucion->tipo_actor == 1)
													{{ $actorSolucion->usuario-> name }}
												@endif
											@endforeach
										@endif

										<dt>CO-RESPONSABLE:</dt>

										<dd>
										@if(isset($actoresSoluciones))
											<ul>
												@foreach($actoresSoluciones as $actorSolucion)
													@if($actorSolucion->tipo_actor == 2)
														<li>{{ " ".$actorSolucion->usuario-> name }}</li>
													@endif
												@endforeach
											</ul>
										@endif
										</dd>

									</dl>
									<div class="media-body">
										<dl class="dl-horizontal">
											Estado de Compromiso: &nbsp;&nbsp;&nbsp;
											<span class="label label-warning">
												@if(isset($soluciones))
													@foreach($soluciones as $solucion)
														{{ $solucion->estado->nombre_estado }}
													@endforeach
												@endif
											</span>
										</dl>
									</div>

									@if(isset($actividades) &&  count($actividades) > 0)
									<b>Actividades: </b>{{ count($actividades) }}
									<span class="pull-right" style="font-size: 12px">Ordenado desde la m&aacute;s reciente</span>
									<hr>
									<ul class="media-list media-list-with-divider">
										@foreach($actividades as $actividad)

											<li class="media media-lg">
												<div class="media-body">
													<b>Fecha de Inicio: </b> {{ $actividad-> created_at}}<br>
													<b>Ejecutor: </b> {{ $actividad-> usuario-> name}}<br>
													<h5 class="media-heading"></h5>
													{{ $actividad -> comentario}}
													<br>

													<!-- <a class="btn btn-primary btn-xs" ><i class="fa fa-download"></i></a>
	                                            	<a href="#modal-add-acc" class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-edit"></i></a> -->

												</div>

											</li>

											<!--ARCHIVOS-->
											@if( count( $actividad-> archivo) > 0)
											<hr>
											<em> Archivos: </em> <br>
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

										@endforeach
									</ul>
									@else
										No se encontraron actividades registradas.
									@endif

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




  <script src="{{ asset('plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('plugins/DataTables/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/DataTables/js/dataTables.responsive.js') }}"></script>
	<script src="{{ asset('js/table-manage-responsive.demo.min.js') }}"></script>
	<script src="{{ asset('js/custom-mipro.js') }}"></script>
	<script src="{{ asset('js/apps.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>


@endsection

@section('init_scripts')

  <script>
    $(document).ready(function() {
      Dashboard.init();



    });
  </script>

@endsection
