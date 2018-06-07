@extends('layouts.institucion')

@section('content')

<!-- begin #content -->
		<div id="content" class="content" width="10%">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="{{ url('institucion/home') }}">Inicio</a></li>
				<li class="active"><a href="javascript:window.history.back()">Propuesta</a></li>
				<li class="active">Nueva Actividad</li>
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
								@if (isset($pajustada) )
									{{ $pajustada->nombre_pajustada }}
								@endif
							</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">&nbsp;</i></a>
						</div>
					</div>
				</div>
				<!-- end col-12 -->
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-7">
					
					<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								
							</div>
							<h4 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> Nueva Actividad</h4>
						</div>
						<div class="panel-body">
							<div class="height-lg" data-scrollbar="true">
								<div class="media-body">
									<a href="javascript:window.history.back();" class="btn btn-default pull-right">&laquo; Regresar</a>
									<hr>
									<br>
								
									<form  method="POST" action="{{ route('actividades.saveActividad',[ 2,$pajustada->id]) }}" enctype="multipart/form-data">
										{{ csrf_field() }}
									 	<div class="form-group">
									 		<div class="row">
									 			<div class="col-md-7">
									 				<label for="exampleTextarea">Descripcion Actividad</label>		
									 			</div>
									 			<div class="col-md-3 pull-right">
									 				<div id="nunCaracteres" class=""></div>
									 			</div>
									 		</div>
									 			<textarea maxlength="280" required="" class="form-control" id="exampleTextarea" name="comentario" rows="3" onKeyDown="cuenta()" onKeyUp="cuenta()"></textarea>	
									    	
									  	</div>
									  	
									  	<div class="form-group">
									    	<label for="exampleSelect1">Instituci&oacute;n ejecutora</label>
									    	<select class="form-control" name="institucion_id" id="exampleSelect1">
									      		@if( isset($actoresSoluciones) )
													@foreach( $actoresSoluciones as $actorSolucion )
														<option value="{{ $actorSolucion->usuario-> id}}">
															{{ $actorSolucion->usuario-> name }}
														</option>
													@endforeach
												@endif
									    	</select>
									  	</div>
									  
									  	<div class="form-group">
									    	<label for="exampleInputFile">Agregar archivos. (Opcional)</label>
									    	<!--
									    	<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
									    	-->

									    	<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="files[]" multiple>


									    	<small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
									  	</div>
									  	<hr>
									  	<button type="submit" class="btn btn-primary pull-right">Registrar</button>
									</form>		

								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!-- end col-8 -->
				<div class="col-md-5">
					<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								
							</div>
							<h4 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> Actividades</h4>
						</div>
						<div class="panel-body">
							<div class="height-lg" data-scrollbar="true">
								
								<div class="media-body">

									@if( isset( $actividades ) && count($actividades) > 0)
										<?php $count=1; ?>
										@foreach( $actividades as $actividad)
											<h4>
												<label class="label label-danger label-lg"><i class="fa fa-file-text-o" aria-hidden="true"></i> Actividad {{ $count }}</label><br><br>
											</h4>
											<p class="text-justify">
												{{ $actividad-> comentario }}
												<br><br>

												@if( $actividad-> ejecutor_id > 0 )
													<b> Ejecutor: </b> {{ $actividad-> usuario-> name }}<br>
												@endif
												
											</p>
											<hr>
											<?php $count++; ?>
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
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop
		