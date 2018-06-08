<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top" >
		<!-- begin container -->
		<div class="container">
				<!-- begin navbar-header -->
				<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>

						<a href="{{ url('/') }}" class="navbar-brand">
								<img src="{{ asset('imagenes/dialogo_nacional/logo_dialogo_nacional.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="130px" height="46px">
						</a>

				</div>
				<!-- end navbar-header -->

				<div class="collapse navbar-collapse navbar-right" id="header-navbar">
                    <ul class="nav navbar-nav  navbar-right">
                        
                        {{-- <li>
                            <a href="{{ url('/') }}">
                                <i></i> Inicio
                            </a>
                        </li> --}}
                        <li>
                            <a href="/estructura-promedio-costos-gastos-empresas">
                                <i></i>DOCUMENTOS INTERACTIVOS
                            </a>
                        </li>
                        <li>
                            <a href="http://encuestas.administracionpublica.gob.ec/index.php/887844/lang-es#" target="_blank">
                                <i></i> INFORME DEL DIÁLOGO
                            </a>
                        </li>
                        
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i></i>CONSEJOS SECTORIALES<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">DE LA POLÍTICA</a></li>
                                <li><a href="#">DE LO SOCIAL</a></li>
                                <li><a href="#">DE LA PRODUCCIÓN</a></li>
                                
                                
                            </ul>
                        </li>
                        <li>
                            <a href="/login">
                                <i class="fa fa-user fa-fw"></i> INGRESAR
                            </a>
                        </li>
                    </ul>
                </div>
				<!-- end navbar-collapse -->
				

		</div>
		<!-- end container -->
</div>
<!-- end #header -->
