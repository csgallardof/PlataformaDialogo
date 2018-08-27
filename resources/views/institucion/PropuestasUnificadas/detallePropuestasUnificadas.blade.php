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
										<a   class="btn btn-primary pull-right m-b-30 m-l-30" href="/institucion/ver-propuestas-unificadas" >Regresar</a>	
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Propuesta</th>
											<th>Ponderaci&oacute;n</th>
											<th>Lugar de soluci&oacute;n</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($uniDetalle as $detalle)
										<tr>
											<td class="text-justify">{{$detalle->propuesta_solucion}}</td>
											<td class="text-justify">{{$detalle->ponderacion}}</td>
											<td class="text-justify">{{$detalle->lugar_solucion}}</td>
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
							
							</div>
							<h4 class="panel-title">Notificaciones<br> (&uacute;ltima semana)</h4>
						</div>
						<div class="panel-body">
							
					
						</div>
					</div>
					
				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->



		@stop
