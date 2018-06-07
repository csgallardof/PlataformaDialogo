<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]--> 
<head>
	<meta charset="utf-8" />
	<title>Inteligencia Productiva - @yield('title')</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="{{ asset('plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
	<!--
		<link href="{{ asset('css/theme/default.css') }}" rel="stylesheet" id="theme" />
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
	 -->

	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{ asset('plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" />

	<link href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />

	<link href="{{ asset('plugins/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />


    <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
		@section('start_css')


			<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->




		@show
		<!-- ================== END BASE CSS STYLE ================== -->
	<!--
	<link href="{{ asset('plugins/ionRangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" />
	 -->

	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="{{ url('institucion/home') }}" class="navbar-brand">
								<img src="{{ asset('imagenes/logo_mipro_white.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="130px" height="46px">
					</a>
					<img src="{{ asset('imagenes/inteligencia_productiva_home_white.png') }}" class="center-block img-responsive m-t-20" alt="Cinque Terre" width="250px" height="65px">
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right" style="margin-right: 30px">
					<?php
					 
					 $tipo_fuente= Auth::user()->tipo_fuente;
    				?>
					@if($tipo_fuente==4 or $tipo_fuente==5)
					<li class="dropdown" ><a href="javascript:;" class="dropdown-toggle btn-primary btn-xs" style="color: #FFF;" data-toggle="dropdown">

							<span class="hidden-xs ">Consejo Sectorial</span> <b class="caret"></b>
						</a>

						<ul class="dropdown-menu animated fadeInLeft" >
							@if($tipo_fuente==4)
							<li>
								<a href="/institucion/consejo-sectorial-produccion/reportes-hechos">
        	                		Reportes Hechos CSP
                        		</a>

                            </li>
                            <li>
								<a href="/institucion/consejo-sectorial-produccion/reportes-alertas">
        	                		Reportes Alertas CSP
                        		</a>

                            </li>
							@endif
							@if( $tipo_fuente==5)
							<li>
								<a href="/institucion/consejo-sectorial-produccion">
        	                		Reportes CSP
                        		</a>

                            </li>
                            @endif
                            <li >
								<a  href="/institucion/ver-agenda-territorial">
        	                		Agenda Territorial
                        		</a>

                            </li>
						</ul>
					</li>
					@endif
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" style="color: #FFF" data-toggle="dropdown">
							<span class="hidden-xs">@auth {{ Auth::user()->name }} @endauth</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<!-- <li class="arrow"></li>
							<li><a href="javascript:;">Editar Perfil</a></li>
							<li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span>Mensajes</a></li>
							<li><a href="javascript:;">Ajustes</a></li>
							<li class="divider"></li> -->
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        	                		Salir
                        		</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->


		@yield('content')

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
		<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('plugins/jquery/jquery-1.9.1.min.js') }}"></script>

	<script src="{{ asset('plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
	<!-- ================== END BASE JS ================== -->


	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
	<script src="{{ asset('plugins/masked-input/masked-input.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('plugins/password-indicator/js/password-indicator.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js') }}"></script>
	<script src="{{ asset('plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ asset('js/form-plugins.demo.min.js') }}"></script>
	<script src="{{ asset('js/apps.min.js') }}"></script>
	<script src="{{ asset('js/Canton/comboCanton.js') }}"></script>
	<script src="{{ asset('plugins/DataTables/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/DataTables/js/dataTables.colReorder.js') }}"></script>
	<script src="{{ asset('plugins/gritter/js/jquery.gritter.js') }}"></script>
	<script src="{{asset ('plugins/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset ('plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
	<script src="{{asset ('plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
	<script src="{{asset ('js/form-wysiwyg.demo.min.js')}}"></script>

	<script src="{{ asset('plugins/DataTablesv2/datatables.js') }}"></script>
	<script src="{{ asset('js/table-manage-responsive.demo.js') }}"></script>
	<script src="{{ asset('js/Checkbox/chechBoxReportesCSP.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->



<script>
	
		$(document).ready(function() {
			App.init();
			FormWysihtml5.init();
			FormPlugins.init();
			TableManageResponsive.init();
		});
	</script>


</body>
</html>
