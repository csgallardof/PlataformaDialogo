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
			                    <a href="{{ url('/consejo-sectorial/home') }}" class="navbar-brand">
									<img src="{{ asset('imagenes/dialogo_nacional/logo_dialogo_nacional.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="130px" height="46px">
								</a>
			                </div>
			                <div id="navbar" class="navbar-collapse collapse">
			                    <ul class="nav navbar-nav">
			                        <li><a href="/consejo-sectorial/listar-usuario">Usuarios</a></li>
			                        <li><a href="propuestas-finalizadas">Propuestas Finalizadas</a></li>
			                        <li><a href="propuestas-desestimadas">Propuestas Desestimadas</a></li>
			                        <li><a href="propuestas-en-conflicto">Propuestas en Conflicto</a></li>
			                        <li><a href="/consejo-sectorial/reportes-consejo?selInstituciones=Todos">Reportes</a></li>
			                    </ul>


			                    <ul class="nav navbar-nav navbar-right" style="margin-right: 30px">
									<li class="dropdown navbar-user">
										<a href="javascript:;" class="dropdown-toggle"  data-toggle="dropdown">
											<span class="hidden-xs">@auth {{ Auth::user()->name }} @endauth</span> <b class="caret"></b>
										</a>
										<ul class="dropdown-menu animated fadeInLeft">
											<li class="arrow"></li>
											 <li><a href="{{ 'cambiar-clave/'. Auth::user()->id  }}" class="arrow">Cambiar Contrase&ntilde;a</li>

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
