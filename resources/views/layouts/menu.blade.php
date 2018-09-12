<!-- begin #header -->

<div id="header" class="header navbar navbar-default navbar-fixed-top">
	<!-- begin container-fluid -->
	<div class="header_main_properties container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<!-- <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> Color Admin</a> -->
			<a href="{{ url('/') }}" class="navbar-brand" tabindex="1">
					<img src="{{ asset('imagenes/dialogo_nacional/logo_dialogo_nacional.png') }}" class="center-block img-responsive" alt="logo de plataforma de dialogo nacional" width="115px" height="50px">
			</a>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled"><span style="text-indent: -9999px; width: 0px; float: left;">Menu para celulares</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!-- end mobile sidebar expand / collapse button -->

		<!-- begin navbar-collapse -->
						<div class="collapse navbar-collapse pull-left" id="top-navbar">
								<ul class="nav navbar-nav" role="menu principal">

										<li class="dropdown dropdown-lg">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" tabindex="2"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;Informes<b class="caret"></b></a>
												<div class="dropdown-menu dropdown-menu-lg">
														<div class="row">

																<div class="col-md-2 col-sm-2">
																		<a tabindex="3" class="text-left" href="http://www.planificacion.gob.ec/wp-content/uploads/downloads/2018/03/Informe-sobre-el-Dialogo-Nacional.pdf" >
																			<h4 class="dropdown-header">Informe del Diálogo Nacional</h4>
																			<div class="row">
																					<div class="col-md-12 col-xs-12">
																								<img src="{{ asset('imagenes/dialogo_nacional/portada_informe_dialogo.png') }}" class="img-rounded" alt="imagen de portada de informe de dialogo nacional" width="125px" height="125px">
																					</div>
																			</div>
																		</a>
																</div>

																<div class="col-md-2 col-sm-2">
																		<h4 class="dropdown-header">Reportes en línea</h4>
																		<div class="row">
																				<div class="col-md-12 col-xs-12">
																						<ul class="nav">
																								<li><a tabindex="4" href="{{ url('/reporte') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Reporte General</a></li>
																								<li><a tabindex="5" href="http://www.inteligenciaproductiva.gob.ec/dialogo-nacional-estadisticas" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Productivo</a></li>
																						</ul>
																				</div>
																		</div>
																</div>

																<div class="col-md-4 col-sm-4">
																		<h4 class="dropdown-header">Acerca del Diálogo Nacional</h4>
																		<p style="text-align: justify;">
																				El presidente Lenín Moreno ha convocado a un gran Diálogo Nacional con el objetivo de escuchar las propuestas de diferentes actores de la sociedad, recibir sus aportes, encontrar y sistematizar la diversidad de “posiciones comunes”, identificar posibles convergencias y visualizar acciones concurrentes, sin distanciarse de los principios y las bases fundacionales del proyecto político ganador en las pasadas elecciones.
																		</p>
																</div>
														</div>
												</div>
										</li>
										<li>
												<a tabindex="6" href="/calendario-dialogo-nacional">
														<i class="fa fa-calendar fa-fw"></i>&nbsp;Próximas Mesas
												</a>
										</li>
										<li class="dropdown">
												<a tabindex="7" href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="fa fa-comments-o fa-fw"></i>&nbsp;Participar<b class="caret"></b>
												</a>
												<ul class="dropdown-menu" role="sub menu de participar">
														<li><a tabindex="8" href="#">Enviar mi propuesta</a></li>
														<li><a tabindex="9" href="#">Alertas Productivas</a></li>
														<li><a tabindex="10" href="#">Alertas Ciudadanas</a></li>
														<li><a tabindex="11" href="#">Reportar un hecho relevante</a></li>
														<li><a tabindex="12" href="#">Quiero ser veedor</a></li>
														<!-- <li class="divider"></li> -->
												</ul>
										</li>
										<li>
												<a tabindex="13" href="#">
														<i class="fa fa-newspaper-o fa-fw"></i>&nbsp;Noticias
												</a>
										</li>

								</ul>
						</div>
		<!-- end navbar-collapse -->

		<div class="collapse navbar-collapse pull-right" id="top-navbar">
				<ul class="nav navbar-nav">

					<li>
							<a tabindex="14" href="login">
									<i class="fa fa-user fa-fw"></i> Ingresar
							</a>
					</li>

				</ul>
		</div>

		<!-- begin header navigation right -->

		<!-- end header navigation right -->
	</div>
	<!-- end container-fluid -->
</div>

<!-- end #header -->

<!-- ////// -->
<!-- SIDEBAR -->
<!-- ////// -->


<div id="sidebar" class="sidebar toggled" >
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="info">
					Menú
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="has-sub">
				<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-laptop"></i>
						<span>Informes 222</span>
					</a>
				<ul class="sub-menu">
						<li><a href="index.html">Informe del Diálogo Nacional</a></li>
						<li><a href="index_v2.html">Reporte General</a></li>
						<li><a href="index_v2.html">Reporte Productivo</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-laptop"></i>
						<span>Participar</span>
					</a>
				<ul class="sub-menu">
						<li><a href="index.html">Enviar mi propuesta</a></li>
						<li><a href="index_v2.html">Alertas Productivas</a></li>
						<li><a href="index_v2.html">Alertas Ciudadanas</a></li>
						<li><a href="index_v2.html">Reportar un hecho relevante</a></li>
						<li><a href="index_v2.html">Quiero ser veedor</a></li>
				</ul>
			</li>
			<li><a href="index.html">Próximas Mesas</a></li>
			<li><a href="index.html">Noticias</a></li>
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
