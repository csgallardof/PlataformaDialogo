@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  
  <link href="{{ asset('plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  	<link href="{{ asset('plugins/isotope/isotope.css') }}" rel="stylesheet" />
  	<link href="{{ asset('plugins/lightbox/css/lightbox.css') }}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
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
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<div class="modal-header">
							<h4 class="modal-title">Cifras</h4>
					</div>

					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">
								<div class="col-md-12">
				                	<ul class="nav nav-tabs">
										<li class="active"><a href="#default-tab-1" data-toggle="tab">Costa</a></li>
										<li class=""><a href="#default-tab-2" data-toggle="tab">Sierra</a></li>
										<li class=""><a href="#default-tab-3" data-toggle="tab">Oriente</a></li>
										<li class=""><a href="#default-tab-4" data-toggle="tab">Insular</a></li>
									</ul>
									<div class="col-md-12">
										<div class="tab-content">
											<!-- COSTA-->
											<div class="tab-pane fade active in " id="default-tab-1">
												<div class="col-md-12">
													<ul class="nav nav-pills center-block text-center">
														<li class="active"><a href="#nav-pills-tab-ElOro" data-toggle="tab">El Oro</a></li>
														<li><a href="#nav-pills-tab-Esmeraldas" data-toggle="tab">Esmeraldas</a></li>
														<li><a href="#nav-pills-tab-Guayas" data-toggle="tab">Guayas</a></li>
														<li><a href="#nav-pills-tab-LosRios" data-toggle="tab">Los Ríos</a></li>
														<li><a href="#nav-pills-tab-Manabi" data-toggle="tab">Manabí</a></li>
														<li><a href="#nav-pills-tab-SantaElena" data-toggle="tab">Santa Elena</a></li>
													</ul>
												</div>

												<div class="tab-content">
													<div class="tab-pane fade active in ol-md-10 col-md-offset-1" id="nav-pills-tab-ElOro">
													    <h3 class="m-t-10">El Oro</h3>
													    <div class="row">
													    	@include('publico.provincias.el_oro')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Esmeraldas">
													    <h3 class="m-t-10">Esmeraldas</h3>
													    <div class="row">
													    	@include('publico.provincias.esmeraldas')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Guayas">
													    <h3 class="m-t-10">Guayas</h3>
													    <div class="row">
													    	@include('publico.provincias.guayas')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-LosRios">
													    <h3 class="m-t-10">Los Ríos</h3>
													    <div class="row">
													    	@include('publico.provincias.los_rios')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Manabi">
													    <h3 class="m-t-10">Manabí</h3>
													    <div class="row">
													    	@include('publico.provincias.manabi')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-SantaElena">
													    <h3 class="m-t-10">Santa Elena</h3>
													    <div class="row">
													    	@include('publico.provincias.santa_elena')
													    </div>
													</div>
												</div>

											</div>

											<!--FIN COSTA-->

											<!-- SIERRA-->
											<div class="tab-pane fade active" id="default-tab-2">
												<div class="col-md-12">
													<ul class="nav nav-pills">
														<li class="active"><a href="#nav-pills-tab-Azuay" data-toggle="tab">Azuay</a></li>
														<li><a href="#nav-pills-tab-Bolivar" data-toggle="tab">Bolivar</a></li>
														<li><a href="#nav-pills-tab-Canar" data-toggle="tab">Cañar</a></li>
														<li><a href="#nav-pills-tab-Carchi" data-toggle="tab">Carchi</a></li>
														<li><a href="#nav-pills-tab-Cotopaxi" data-toggle="tab">Cotopaxi</a></li>
														<li><a href="#nav-pills-tab-Chimborazo" data-toggle="tab">Chimborazo</a></li>
														<li><a href="#nav-pills-tab-Imbabura" data-toggle="tab">Imbabura</a></li>
														<li><a href="#nav-pills-tab-Loja" data-toggle="tab">Loja</a></li>
														<li><a href="#nav-pills-tab-Pichincha" data-toggle="tab">Pichincha</a></li>
														<li><a href="#nav-pills-tab-SantoDomingo" data-toggle="tab">Santo Domingo</a></li>
														<li><a href="#nav-pills-tab-Tungurahua" data-toggle="tab">Tungurahua</a></li>
													</ul>
												</div>
												<div class="tab-content">
													<div class="tab-pane fade active in ol-md-10 col-md-offset-1" id="nav-pills-tab-Azuay">
													    <h3 class="m-t-10">Azuay</h3>
													    <div class="row">
													    	@include('publico.provincias.azuay')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Bolivar">
													    <h3 class="m-t-10">Bolivar</h3>
													    <div class="row">
													    	@include('publico.provincias.bolivar')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Canar">
													    <h3 class="m-t-10">Cañar</h3>
													    <div class="row">
													    	@include('publico.provincias.canar')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Carchi">
													    <h3 class="m-t-10">Carchi</h3>
													    <div class="row">
													    	@include('publico.provincias.carchi')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Chimborazo">
													    <h3 class="m-t-10">Chimborazo</h3>
													    <div class="row">
													    	@include('publico.provincias.chimborazo')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Cotopaxi">
													    <h3 class="m-t-10">Cotopaxi</h3>
													    <div class="row">
													    	@include('publico.provincias.cotopaxi')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Imbabura">
													    <h3 class="m-t-10">Imbabura</h3>
													    <div class="row">
													    	@include('publico.provincias.imbabura')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Loja">
													    <h3 class="m-t-10">Loja</h3>
													    <div class="row">
													    	@include('publico.provincias.loja')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Pichincha">
													    <h3 class="m-t-10">Pichincha</h3>
													    <div class="row">
													    	@include('publico.provincias.pichincha')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-SantoDomingo">
													    <h3 class="m-t-10">Santo Domingo</h3>
													    <div class="row">
													    	@include('publico.provincias.santo_domingo')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Tungurahua">
													    <h3 class="m-t-10">Tungurahua</h3>
													    <div class="row">
													    	@include('publico.provincias.tungurahua')
													    </div>
													</div>
												</div>
											</div>
											<!-- FIN SIERRA-->

											<!-- ORIENTE-->
											<div class="tab-pane fade" id="default-tab-3">
												<div class="col-md-12">
												<ul class="nav nav-pills">
														<li class="active"><a href="#nav-pills-tab-MoronaSantiago" data-toggle="tab">Morona Santiago</a></li>
														<li><a href="#nav-pills-tab-Napo" data-toggle="tab">Napo</a></li>
														<li><a href="#nav-pills-tab-Orellana" data-toggle="tab">Orellana</a></li>
														<li><a href="#nav-pills-tab-Pastaza" data-toggle="tab">Pastaza</a></li>
														<li><a href="#nav-pills-tab-Sucunbios" data-toggle="tab">Sucumbios</a></li>
														<li><a href="#nav-pills-tab-ZamoraChinchipe" data-toggle="tab">Zamora Chinchipe</a></li>
													</ul>
												</div>
												<div class="tab-content">
													<div class="tab-pane fade active in ol-md-10 col-md-offset-1" id="nav-pills-tab-Mç">
													    <h3 class="m-t-10">Morona Santiago</h3>
													    <div class="row">
													    	@include('publico.provincias.morona_santiago')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Napo">
													    <h3 class="m-t-10">Napo</h3>
													    <div class="row">
													    	@include('publico.provincias.napo')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Orellana">
													    <h3 class="m-t-10">Orelllana</h3>
													    <div class="row">
													    	@include('publico.provincias.orellana')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Pastaza">
													    <h3 class="m-t-10">Pastaza</h3>
													    <div class="row">
													    	@include('publico.provincias.pastaza')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Sucunbios">
													    <h3 class="m-t-10">Sucumbios</h3>
													    <div class="row">
													    	@include('publico.provincias.sucumbios')
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-ZamoraChinchipe">
													    <h3 class="m-t-10">Zamora Chinchipe</h3>
													    <div class="row">
													    	@include('publico.provincias.zamora')
													    </div>
													</div>
												</div>

											</div>
											<!--FIN ORIENTE-->


											<!-- INSULAR-->
											<div class="tab-pane fade" id="default-tab-4">
												<div class="col-md-12">
													<ul class="nav nav-pills">
														<li class="active"><a href="#nav-pills-tab-Galapagos" data-toggle="tab">Galápagos</a></li>
													</ul>
												</div>
												<div class="tab-content">
													<div class="tab-pane fade active in ol-md-10 col-md-offset-1" id="nav-pills-tab-Galapagos">
													    <h3 class="m-t-10">Galápagos</h3>
													    <div class="row">
													    	@include('publico.provincias.galapagos')
													    </div>
													</div>

												</div>

											</div>
											<!--FIN INSULAR-->

										</div>
									</div>


				                </div>
							</div>
							<!-- begin page-header -->
						</div>


						<!-- end col-4 -->
					</div>
						<!-- end row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">

							</div>
							<!-- begin page-header -->
						</div>
							<!-- end col-4 -->
					</div>
						<!-- end row -->

				</div>

			</div>
			<!-- end #about -->

			<!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
					<div class="container" data-animation="true" data-animation-type="fadeInDown">

							<!-- begin row -->
							<div class="row">

							</div>
							<!-- end row -->

					</div>
					<!-- end container -->
			</div>
			<!-- end #about -->

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

	<script src="{{ asset('plugins/isotope/jquery.isotope.min.js') }}"></script>
  	<script src="{{ asset('plugins/lightbox/js/lightbox-2.6.min.js') }}"></script>
	<script src="{{ asset('js/gallery.demo.js') }}"></script>



@endsection

@section('init_scripts')

  <script>
    $(document).ready(function() {

      Gallery.init();





    });
  </script>


@endsection
