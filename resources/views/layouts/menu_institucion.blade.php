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
			                    		<li><a class="dropdown-item" href="{{ route('mesadialogo.index') }}">Mesas Dialogo</a>
			                        <li><a href="/institucion/ver-propuestas-unificadas">Propuestas Ajustadas</a></li>
			                        <li><a href="propuestas-en-conflicto">Propuestas en  Conflicto</a></li>
			                        <li><a href="/institucion/propuestas-desestimadas">Propuestas   Desestimadas</a></li>
			                        <li><a href="/institucion/reportes">Reportes</a></li>
                          </ul>
			                    <ul id="navbaruser" class="nav navbar-nav " style="">
														<li class="dropdown navbar-user">
<<<<<<< HEAD
																		<a href="javascript:;" class="dropdown-toggle" style="color: #fff" data-toggle="dropdown">
																			<span class="">@auth {{ Auth::user()->name }} @endauth</span> <b class="caret"></b>
																		</a>
																		<!--/*PLATAFORMA DIALOGO NACIONAL BEGIN IPIALESO 20181026 */-->
																		<ul class="dropdown-menu animated fadeInLeft">
																			<!--<li class="arrow"></li>-->
															 				<li><a href="{{ 'cambiar-clave/'. Auth::user()->id  }}" class="arrow">Cambiar Contrase&ntilde;a</li>
																			<li>	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				                                            		Salir
				                                        		</a>

						                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						                                            {{ csrf_field() }}
						                                        </form>
								                  		</li>
																	</ul>
																	<!--/*PLATAFORMA DIALOGO NACIONAL BEGIN IPIALESO 20181026 */-->
=======
														<a href="javascript:;" class="dropdown-toggle" style="color: #fff" data-toggle="dropdown">
														<span class="hidden-xs">@auth {{ Auth::user()->name }} @endauth</span> <b class="caret"></b>
														</a>
														<ul class="dropdown-menu animated fadeInLeft">
														<li class="arrow"></li>
											 			<li><a href="{{ 'cambiar-clave/'. Auth::user()->id  }}" class="arrow">Cambiar Contrase&ntilde;a</a></li>
														<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            		Salir
                                        		</a>
		                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                            {{ csrf_field() }}
		                                        </form>
				                  </li>
													</ul>
>>>>>>> 6ff1d4288696f17cf45be499a61a0ee67d6f27c9
													</li>
													</ul>
			                </div>
			            </div>
			        </nav>
			    </div>
			</div>

</div>
<!-- end #header -->
