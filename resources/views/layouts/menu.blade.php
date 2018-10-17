<!-- begin #header -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script> // script for expand/collapse
    var expandCollapse = function(){
        if ( $(window).width() < 768 ) {
            $(function(){
            	
            	 var x = document.getElementById("sidebar");
            	 var ht = '';
            	 x.style.display = "block";


                 var div = document.createElement('div');

                 div.className = 'row';

                 ht = '<div data-scrollbar="true" data-height="100%"><ul class="nav">';
                 ht += '<li class="nav-profile">';
				 ht += '<div class="info">Menú</div></li></ul><ul class="nav"><li class="has-sub"><a href="javascript:;">';
				 ht += '<b class="caret pull-right"></b><i class="fa fa-laptop"></i><span><h3>Informes</h3></span>';
				 ht += '</a><ul class="sub-menu"><li><a href="index.html"><h3>Informe del Diálogo Nacional</h3></a></li>';
				 ht += '<li><a href="index_v2.html"><h3>Reporte General</h3></a></li>';
				ht +=  '<li><a href="index_v2.html"><h3>Reporte Productivo</h3></a></li>';
				ht += '</ul></li><li><a href="index.html"><h2>Próximas Mesas</h2></a></li>';
			    ht += '<li><a href="index.html"><h3>Noticias</h3></a></li></ul></div>';

                div.innerHTML=ht;
                //document.getElementById('sidebar').appendChild(div);
                document.getElementById('sidebar').innerHTML=ht;

               var menutop1 = document.getElementById("top-navbar");
                menutop1.style.display = "none";

                // add a class .collapse to a div .showHide
                //$('.showHide').addClass('collapse');
                // set display: "" in css for the toggle button .btn.btn-primary
                //$('button.btn.btn-primary').css('display', '');// removes display property to make it visible
            });
        }
        else {
            $(function(){
            	 var x = document.getElementById("sidebar");
            	x.style.display = "none";
            	var menutop1 = document.getElementById("top-navbar");
                menutop1.style.display = "block";
                // remove a class .collapse from a div .showHide
                //$('.showHide').removeClass('collapse');
                // set display: none in css for the toggle button .btn.btn-primary  
                //$('button.btn.btn-primary').css('display', 'none');// hides button display on bigger screen
            });
        }
    }
    $(window).resize(expandCollapse); // calls the function when the window first loads
</script>
<style type="text/css">
	
    h2{
      font-size: 14px;

    }

	h3{
        font-size: 13px;

	}
</style>

<div id="header" class="header navbar navbar-default navbar-fixed-top">
	<!-- begin container-fluid -->
	<div class="header_main_properties container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<!-- <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> Color Admin</a> -->
			<a href="{{ url('/') }}" class="navbar-brand" tabindex="1">
					<img src="{{ asset('imagenes/dialogo_nacional/logo_dialogo_nacional.png') }}" class="center-block img-responsive" alt="logo de plataforma de dialogo nacional" width="115px" height="50px">
			</a>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
				<span style="text-indent: -9999px; width: 0px; float: left;">Menu para celulares</span>
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
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" tabindex="2"><h2 ><i class="fa fa-file-text-o fa-fw"></i>&nbsp;Informes</h2></a>
												<div class="dropdown-menu dropdown-menu-lg">
														<div class="row">

																<div class="col-md-2 col-sm-2">
																		<a tabindex="3" class="text-left" href="http://www.planificacion.gob.ec/wp-content/uploads/downloads/2018/03/Informe-sobre-el-Dialogo-Nacional.pdf" >
																			<h3 class="dropdown-header" >Informe del Diálogo Nacional</h3>
																			<div class="row">
																					<div class="col-md-12 col-xs-12">
																								<img src="{{ asset('imagenes/dialogo_nacional/portada_informe_dialogo.png') }}" class="img-rounded" alt="imagen de portada de informe de dialogo nacional" width="125px" height="125px">
																					</div>
																			</div>
																		</a>
																</div>

																<div class="col-md-2 col-sm-2">
																		<h3 class="dropdown-header">Reportes en línea</h3>
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
																		<h3 class="dropdown-header">Acerca del Diálogo Nacional</h3>
																		<p style="text-align: justify;">
																				El presidente Lenín Moreno ha convocado a un gran Diálogo Nacional con el objetivo de escuchar las propuestas de diferentes actores de la sociedad, recibir sus aportes, encontrar y sistematizar la diversidad de “posiciones comunes”, identificar posibles convergencias y visualizar acciones concurrentes, sin distanciarse de los principios y las bases fundacionales del proyecto político ganador en las pasadas elecciones.
																		</p>
																</div>
														</div>
												</div>
										</li>
										 <li>
												<a tabindex="6" href="/calendario-dialogo-nacional">
														<h2><i class="fa fa-calendar fa-fw"></i>&nbsp;Próximas Mesas</h2>
												</a>
										</li>
										<!--<li class="dropdown">
												<a tabindex="7" href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="fa fa-comments-o fa-fw"></i>&nbsp;Participar<b class="caret"></b>
												</a>
												<ul class="dropdown-menu" role="sub menu de participar">
														<li><a tabindex="8" href="#">Enviar mi propuesta</a></li>
														<li><a tabindex="9" href="#">Alertas Productivas</a></li>
														<li><a tabindex="10" href="#">Alertas Ciudadanas</a></li>
														<li><a tabindex="11" href="#">Reportar un hecho relevante</a></li>
														<li><a tabindex="12" href="#">Quiero ser veedor</a></li>
															
												</ul>
										</li>-->
										<!--<li>
												<a tabindex="13" href="#">
														<i class="fa fa-newspaper-o fa-fw"></i>&nbsp;Noticias
												</a>
										</li> -->

								</ul>
						</div>
		<!-- end navbar-collapse -->

		<div class="collapse navbar-collapse pull-right" id="top-navbar">
				<ul class="nav navbar-nav">

					<li>
							<a tabindex="14" href="login">
									 <h2><i class="fa fa-user fa-fw"></i>Ingresar</h2>
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
	
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
