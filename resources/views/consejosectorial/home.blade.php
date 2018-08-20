@extends('layouts.consejo-sectorial')

@section('title','Propuestas-Consejo Sectorial')


@section('content')

<!-- NOTAS ESTA ES LA PANTALLA PARA CONSEJO SECTORIAL  / SEBE PROBAR Y MODIFICAR LAS COSAS PARA MEJORAR +++ NOTA +++++  -->
		<!-- begin #content -->
		<div id="content" class="content" width="10%" style="background-color: #f3f3f3;">
			<!-- begin breadcrumb -->

			<br />

			<div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
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





			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-12">


					<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">

						<li class="active">
							<a href="#responsable" data-toggle="tab">
								<i class="fa fa-sticky-note-o m-r-5"></i>
								<span class="hidden-xs">Priorizadas</span>
								
							</a>
						</li>
						<li class="">
							<a href="#corresponsable" data-toggle="tab">
								<i class="fa fa-sticky-note m-r-5"></i>
								<span class="hidden-xs">Corresponsable</span>
								
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
							
						</div>
					</div>
					
				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop
