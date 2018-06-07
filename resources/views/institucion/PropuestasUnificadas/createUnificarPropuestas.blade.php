@extends('layouts.institucion')

@section('content')

<!-- begin #content -->
		<div id="content" class="content" width="10%">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="{{ url('institucion/home') }}">Inicio</a></li>
				<li><a href="javascript:window.history.back()">Propuesta</a></li>
				<li class="active">Nueva Actividad</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<!-- <div class="brand">
                <img src="{{ asset('imagenes/inteligencia_productiva_home.png') }}" class="left-block img-responsive" alt="Cinque Terre" width="337px" height="55px"><br>
            </div> -->
			<!-- end page-header -->

			
			<!-- begin row -->
			<div class="row">
				<br><br><br>
				<!-- begin col-8 -->
				<div class="col-md-2">
					
				</div>
				<div class="col-md-8">

					<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

							</div>
							<h4 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> Unificar Propuestas</h4>
						</div>
						<div class="panel-body">
							<div class="height-lg" data-scrollbar="true">
								<div class="media-body">
									<a href="javascript:window.history.back();" class="btn btn-default pull-right">&laquo; Regresar</a>
									<hr>
									<br>
							<label class='text-success'>

	                                	<strong>Propuestas a Unificar:</strong>
	                         </label>
	                         <p>
								@foreach($solucionesDespliegue as $solucionD)

								{{$solucionD-> verbo_solucion." ".$solucionD-> sujeto_solucion." ".$solucionD-> complemento_solucion}} <br> <br>

								@endforeach
							</p>

							<form  method="POST" action="/institucion/seleccion-propuestas-unificadas/create-pajustada-unificar" enctype="multipart/form-data">
										{{ csrf_field() }}
										<input type="hidden" name="idPropuestas" value="{{$consulta}}">
									 	<div class="form-group">
									 		<div class="row">
									 			<div class="col-md-7">
									 				<label for="exampleTextarea">Palabra Ajustada</label>
									 			</div>
									 			<div class="col-md-3">
									 				<div id="nunCaracteres" class="pull-right"></div>
									 			</div>
									 		</div>
									 			<textarea required maxlength="280" class="form-control" id="exampleTextarea" name="palabraAjustada" rows="3" onKeyDown="cuenta()" onKeyUp="cuenta()"></textarea>

									  	</div>
									  	<div class="form-group">
									 		<div class="row">
									 			<div class="col-md-7">
									 				<label for="exampleTextarea">Comentario</label>
									 			</div>
									 			<div class="col-md-3">
									 				<div id="nunCaracteres" class="pull-right"></div>
									 			</div>
									 		</div>
									 			<textarea required maxlength="500" class="form-control" id="exampleTextarea" name="comentarioUnion" rows="3" onKeyDown="cuenta()" onKeyUp="cuenta()"></textarea>

									  	</div>

									  	
									  
									  	<hr>
									  	<button type="submit" class="btn btn-primary pull-right">Unificar</button>
									</form>

								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- end col-8 -->
				
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop
