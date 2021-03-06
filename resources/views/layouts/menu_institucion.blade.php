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
			                    <a href="{{ url('/institucion/home') }}" class="navbar-brand">

														<!--PALTAFORMA DIALOGO NACIONAL BEGIN IPIALESO 20181026 -->
														<img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/logo_blanco.png') }}" class="center-block img-responsive" alt="Cinque Terre"  width="45px" height="45px" alt="Logo dialogo nacional">
														<!--PALTAFORMA DIALOGO NACIONAL END IPIALESO 20181026 -->
												 </a>
			                </div>
			                <div id="navbar" class="navbar-collapse collapse">
			                    <ul class="nav navbar-nav">
			                    	<li><a class="barra_menu" href="{{ route('mesadialogo.index') }}">Mesas Dialogos</a>
			                        <li><a class="barra_menu" href="/institucion/ver-propuestas-unificadas">Propuestas Ajustadas</a></li>
			                        <li><a class="barra_menu" href="/institucion/propuestas-en-conflicto">Propuestas en Conflicto</a></li>
			                        <li><a class="barra_menu" href="/institucion/propuestas-desestimadas">Propuestas Desestimadas</a></li>

			                        <li class="down">

			                        <!--<a href="/institucion/reportes">Reportes Inst</a>-->

			                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>

   										 <ul class="dropdown-menu">
			                        		<li><a href="/institucion/reporteMinisterio?codInstitucion=Todos">General</a></li>
			                            	<li>
			                   <a class="dropdown-item" href="/institucion/reporteMinisterioEstadistico?codInstitucion=Todos">Estadistico</a>
			                        		</li>
			                        	</ul>

			                        </li>
                          </ul>
			                    <ul class="nav navbar-nav navbar-right" style="margin-right: 30px">
														<li class="dropdown navbar-user">
														<a href="javascript:;" class="dropdown-toggle" style="color: #fff" data-toggle="dropdown">
														<span class="hidden-xs">@auth {{ Auth::user()->name }} @endauth</span> <b class="caret"></b>
														</a>
														<ul class="dropdown-menu animated fadeInLeft">
														<li class="arrow"></li>
											 			<li><a href="{{ '/institucion/cambiar-clave/'. Auth::user()->id  }}" class="arrow">Cambiar Contrase&ntilde;a</a></li>
														<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
