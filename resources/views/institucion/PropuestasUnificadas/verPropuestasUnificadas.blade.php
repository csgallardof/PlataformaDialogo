@extends('layouts.institucion')

@section('title','Inicio')

@section('content')  


		<!-- begin #content -->
		<div id="content" class="content" width="10%" style="background-color: #f3f3f3;">
			<!-- begin breadcrumb -->

			<br />
			
			
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
							<h4>MIS PROPUESTAS | @auth {{ Auth::user()->name }}@endauth</h4>
							@if (isset($solucionesDespliegue) )
								@if(isset($solucionesCCPT) )
									<p>{{ count($solucionesDespliegue) + count($solucionesCCPT) }} Propuestas</p>
								@else
									<p>{{ count($solucionesDespliegue) }} Propuestas </p>
								@endif
							@else
								@if(isset($solucionesCCPT) )
									<p>{{ count($solucionesCCPT) }} Propuestas</p>
								@else
									<p>0 Soluciones</p>
								@endif
							@endif
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->
			<div>
				
					
				
			</div>
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-12">


					<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">

						<li class="active">
							<a href="#responsable"  data-toggle="tab">
								<i class="fa fa-sticky-note-o m-r-5"></i>
								<span class="hidden-xs" ">Responsable</span>
								@if( isset($totalResponsable) )
									({{ $totalResponsable }})
								@endif
							</a>
						</li>
						
						
					</ul>
					<div class="tab-content" data-sortable-id="index-3">

						<!--SOLUCIONES RESPONSABLE-->
						@include('flash::message')
						
						<div class="tab-pane fade active in" id="responsable">
							<div class="" data-scrollbar="false">
								<div>
									
								</div>
								<form  method="POST" action="/institucion/seleccion-propuestas-unificadas" enctype="multipart/form-data">
									{{ csrf_field() }}
									 <a   class="btn btn-primary pull-right m-b-30 m-l-30" href="/institucion/home">Regresar</a>	
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Id</th>
											<th>Ajustadas</th>
											<th>Comentario</th>
											<th>Detalle propuestas unificadas</th>
										</tr>
									</thead>
									<tbody>
									@foreach($unificadas as $unificadas)
										<tr>
											<td class="text-justify" name="parametro" >{{$unificadas->id}}</td>
											<td class="text-justify">{{$unificadas->nombre_pajustada}}</td>
											<td class="text-justify">{{$unificadas->comentario_union}}</td>
											 <td><!--<a href="#modal-detalle?{{$unificadas->id}}" class="btn btn-sm btn-default" data-toggle="modal" >Detalle</a>-->
											 <a   class="btn btn-primary pull-left m-b-30 m-l-30" href="/institucion/detalle-propuestas-unificadas/{{$unificadas->id}}">Detalle</a>	
											 </td>
 										</tr>
								    @endforeach
									</tbody>
								</table>
								</form>
							</div>
						</div>

						<!--FIN SOLUCIONES RESPONSABLE-->

						

						

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


<!-- #modal-detalle-->
							<div class="modal" id="modal-detalle">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Detalle propuestas unificadas</h4>
										</div>
										<div class="modal-body">
											
                                <form  method="GET" action="" enctype="multipart/form-data">
                                {{ csrf_field() }}
									<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Id</th>
											<th>Ajustada</th>
											<th>Propuesta</th>
										</tr>
									</thead>
									<tbody>
                                   
									</tbody>
								</table>
								</form>

										</div>
										<div class="modal-footer">
											
										<a href="http://localhost:8000/admin/soluciones/create" class="btn btn-sm btn-white" >Nueva Propuesta</a>
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
										</div>
									</div>
								</div>
							</div>
		@stop
