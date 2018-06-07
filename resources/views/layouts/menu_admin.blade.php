<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
		<!-- begin container -->
			<div class="navbar-wrapper">
			    <div class="container-fluid">
			        <nav class="navbar navbar-fixed-top">
			            <div class="container">
			                <div class="navbar-header">
			                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			                    <span class="sr-only">Toggle navigation</span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    </button>
			                    <a href="{{ url('/admin/home') }}" class="navbar-brand">
									<img src="{{ asset('imagenes/logo_mipro.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="130px" height="46px">
								</a>
			                </div>
			                <div id="navbar" class="navbar-collapse collapse">
			                    <ul class="nav navbar-nav">
			                        <li class="down"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Principales <span class="caret"></span></a>
			                            <ul class="dropdown-menu">
			                                <li><a href="{{ route('ambits.index') }}">&Aacute;mbito</a></li>
				                            <li><a href="{{ route('thematics.index') }}">Eje temático</a></li>
				                            <li><a href="{{ route('instrumentos.index') }}">Instrumentos</a></li>
			                                <li><a href="{{ route('pajustadas.index') }}">Palabra Ajustada</a></li>
				                            <li><a href="{{ route('provincias.index') }}">Provincia</a></li>
			                                <li><a href="{{ route('sectors.index') }}">Sectores</a></li>
				                            <li><a href="{{ route('sipocs.index') }}">Sipoc</a></li>
				                            <li><a href="{{ route('vsectors.index') }}">Variable Sectorial</a></li>
				                        </ul>
			                        </li>
			                        <li class="down"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Propuestas <span class="caret"></span></a>
			                            <ul class="dropdown-menu">
			                        		<li><a href="{{ route('ccpt.index') }}">Consejo</a></li>
			                            	<li>
			                        			<a class="dropdown-item" href="{{ route('soluciones.index') }}">Despliegue</a>
			                        		</li>
			                        	</ul>
			                        </li>
					                <li><a class="dropdown-item" href="{{ route('participantes.index') }}">Participantes</a></li>
			                        <li><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
			                        <li><a href="../admin/actores/porasignar">Responsables</a></li>
			                    </ul>
			                    

			                    <ul class="nav navbar-nav navbar-right" style="margin-right: 30px">
									<li class="dropdown navbar-user">
										<a href="javascript:;" class="dropdown-toggle" style="color: #000" data-toggle="dropdown">
											<span class="hidden-xs">@auth {{ Auth::user()->name }} @endauth</span> <b class="caret"></b>
										</a>
										<ul class="dropdown-menu animated fadeInLeft">
											<li class="arrow"></li>
											<li><a href="#">Cambiar Contrase&ntilde;a</a></li>
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



			                </div>
			            </div>
			        </nav>
			    </div>
			</div>
			
</div>
<!-- end #header -->
