@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  <link href="{{ asset('plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
@endsection

@section('contenido')

<br><br><br><br>

		<!-- begin #about -->
		<div class="content row-m-t-2" data-scrollview="true">
				<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInDown">

        <div class="toolbar title_ip_breadcrumb fit-m-b-10">
          <ol class="breadcrumb">
            <li class="home"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i><span></span></a></li>
            <li class="active"><a href="{{ url('/busqueda?parametro=Consejo_consultivo') }}">Resultados de la B&uacute;squeda</a></li>
            <li class="active"><a href="#">Detalle de la propuesta</a></li>
            <label class='text-success pull-right'>
							<a href="{{ url('/') }}" class="btn btn-link fit-m-t-1"><i class="fa fa-1x fa-search"></i> Nueva Consulta</a>
						</label>
          </ol>
        </div>

				<!-- begin row -->
				<div class="row">
					<!-- begin col-5 -->
					<div class="col-md-7">
						<div class="panel panel-inverse" data-sortable-id="index-6" style="border: 1px solid rgba(112, 116, 120, 0.64);">
							<div class="panel-heading" style="padding:5px 5px;">
								<div class="panel-heading-btn">

									<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->

								</div>
								<h4 class="panel-title">Propuestas /Solución</h4>
							</div>
							<div class="panel-body p-t-0">
								<div class="media-body">

									<br>
									<div class="alert detalle_evento_info_adicional fade in m-b-15">
										<strong>Eslabon de la cadena productiva:</strong>
										@if(isset($solucion))
											{{ $solucion->sipoc->nombre_sipoc }}
										@endif
										<br>
										<strong>Instrumentos Necesario:</strong>
 										@if(isset($solucion))
											{{ $solucion->instrumento->nombre_instrumento }}
										@endif
										<br>
										<strong>Clasificación Empresa:</strong>
										@if(isset($solucion))
											{{ $solucion->tipoEmpresa->nombre_tipo_empresa }}
										@endif
										<br>
										<strong>Ámbito:</strong>
										@if(isset($solucion))
											{{ $solucion->ambit->nombre_ambit }}

										@endif
										<span data-dismiss="alert"></span>
									</div>


									<label class='text-success'>

	                                	<i class="fa fa-clock-o fa-fw"></i>Creado:
	                                	@if(isset($solucion))
											{{ substr($solucion->created_at,0,10) }}
										@endif
	                                </label>

                                  <br /><br />

                                </div>

                                	<label class='text-success'>
                                		<i class="fa fa-cheked-o fa-fw"></i><strong>Solución</strong>
                                	</label>
									<blockquote>
										  	<p><h5>
										  		@if(isset($solucion))
													{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion }}
												@endif
										  	</h5>
                                   	</blockquote>

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


                                    <label class='text-success'>
                                		<i class="fa fa-cheked-o fa-fw"></i><strong>Fuente</strong>
                                	</label>
									<blockquote>
										  	<p><h5>
                          <strong>Evento:</strong>
            							@if(isset($solucion))
            								{{ $solucion->evento->nombre_evento }}
            							@endif
            							<br /><strong>Provincia:</strong>
            							@if(isset($solucion))
            								{{ $solucion->provincia->nombre_provincia }}
            							@endif

            							<br /><strong>Sector:</strong>
            							@if(isset($solucion))
            								{{ $solucion->sector->nombre_sector }}
            							@endif

            							<br /><strong>Líder de Mesa:</strong>
            							@if(isset($solucion))
            								{{ $solucion->lider_mesa_solucion }}
            							@endif
            							<br /><strong>Sistematizador de Mesa:</strong>
            							@if(isset($solucion))
            								{{ $solucion->sistematizador_solucion }}
            							@endif
										  	</h5>
                                   	</blockquote>



	                        </div>

						</div>
					</div>
					<!-- end col-5 -->
					<!-- inicio acciones -->
					<div class="col-md-5">
						<div class="panel panel-inverse" data-sortable-id="index-5" style="border: 1px solid rgba(112, 116, 120, 0.64);" >
							<div class="panel-heading" style="padding:5px 5px;">
								<div class="panel-heading-btn">

									<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->

								</div>
								<h4 class="panel-title">Acciones de cumplimiento</h4>
							</div>
							<div class="panel-body p-t-0">
								<div class="media-body">
									<br>
										<label class='text-success f-s-11'>

                                	</label>
                            		<dl class="dl-horizontal">

										<span class="f-w-700">RESPONSABLE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										@if(isset($actoresSoluciones))
											@foreach($actoresSoluciones as $actorSolucion)
												@if($actorSolucion->tipo_actor == 1)
													{{ $actorSolucion->usuario-> name }}
												@endif
											@endforeach
										@endif

                    <br />

										<span class="f-w-700">CO-RESPONSABLE:</span>

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
											<span class="label label-warning f-s-13">
												@if(isset($solucion))
													{{ $solucion->estado->nombre_estado }}
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
