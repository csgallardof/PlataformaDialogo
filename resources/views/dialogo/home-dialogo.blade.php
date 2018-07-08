@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
@endsection

@section('contenido')

        <!-- begin #about -->
        <div id="about" class="img-responsive background-home content work row-m-t-3 p-t-40" data-scrollview="true">

            <!-- begin container -->
            <div class="container p-t-25" data-animation="true" data-animation-type="fadeInDown">

                <div class="col-md-12 p-t-25">
                    <div class="panel-body">
                        <h2 class="text-center text-white"><strong>DIALOGO NACIONAL PÚBLICO-PRIVADO</strong></h2>
                        <h5 class="text-center text-white home_sentence">“Dialogar no es muestra de debilidad, es una muestra de sabiduría. Nada sobre los ciudadanos, sin los ciudadanos”</h5>
                        <h6 class="text-center text-white home_author_sentence">Lenín Moreno Garcés<br />Presidente Constitucional de la República del Ecuador</h6>
                    </div>
                </div>

                        <div class="panel-body text-center">


                                  <div class="row">
                                      <div class="col-xs-8 col-xs-offset-2">
                                          <form method="GET" action="{{ route('nuevaBusquedaDialogo') }}" id="searchForm" class="search-home input-group">
                                              <div class="input-group-btn search-panel">
                                                  <select name="selectBusqueda" id="tipo_dialogo" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                      <option value="no">Filtrar por tipo de diálogo</option>

                                                      @foreach($tipo_dialogo as $tipo_dialogo)
                                                        <option value="{{ $tipo_dialogo->id }}" > {{ $tipo_dialogo->nombre }} </option>
                                                      @endforeach

                                                  </select>
                                              </div>
                                              <input id="buscar_general" type="text" class="form-control" name="parametro" placeholder="Buscar información sobre propuestas y pedidos del diálogo nacional">
                                              <span class="input-group-btn">
                                                  <button id="btn_buscar" class="btn btn-default" type="submit">
                                                     Buscar
                                                  </button>
                                              </span>
                                          </form><!-- end form -->
                                      </div><!-- end col-xs-8 -->
                                  </div><!-- end row -->

                          <p style="margin-top: 10px" class="text-white">Ejemplo: Costos de energía electrica, Promoción turística, Consejo Consultivo, Innovaci&oacute;n.</p>
                        </div>

                <div class="col-md-12 p-b-30">
                      <div class="col-md-2">
                      </div>
                      <div class="col-md-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_1.png') }}">
                        <div class="text-center">
                          <div class="home_main_icon_line1">DIÁLOGOS</div>
                          <div class="home_main_icon_line2">PRESIDENCIALES</div>
                        </div>

                      </div>
                      <div class="col-md-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_2.png') }}" >
                        <div class="text-center">
                          <div class="home_main_icon_line1">DIÁLOGOS</div>
                          <div class="home_main_icon_line2">SECTORIALES</div>
                        </div>
                      </div>
                      <div class="col-md-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_3.png') }}" >
                        <div class="text-center">
                          <div class="home_main_icon_line1">DIÁLOGOS</div>
                          <div class="home_main_icon_line2">PRODUCTIVOS</div>
                        </div>
                      </div>
                      <div class="col-md-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_4.png') }}" >
                        <div class="text-center">
                          <div class="home_main_icon_line1">LOGROS</div>
                          <div class="home_main_icon_line2">ALCANZADOS</div>
                        </div>
                      </div>
                </div>

            </div>
        </div>

        <!-- begin #team -->
        <div id="team" class="content team text-center" data-scrollview="true">

            <div class="row text-center">

            <div class="col-md-7 p-30">
              <div class="panel-body">
              <ul class="media-list media-list-with-divider">
              

                  <li class="media media-sm">
                    <div class="media-body text-right">
                            <div class="media">
                          <a class="media-left" href="javascript:;">
                                      <img src="{{ asset('imagenes/dialogo_nacional/noticia-2-dialogo.png') }}" alt="" class="" />
                          </a>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>MINISTERIO DE EDUCACIÓN Y SENECYT ABREN DIÁLOGO NACIONAL PARA APORTAR AL TEMA EDUCATIVO</strong></h4>
                            <p>Quito (Pichincha). – Con el fin de recoger sugerencias para mejorar la educación media y superior, el Ministerio de Educación (MinEduc) y la Secretaría Nacional de Educación Superior, Ciencia, Tecnología e Innovación (Senescyt) abren el Diálogo Nacional por la Educación para todos los actores de la sociedad que quieran aportar en el tema educativo. Estas dos instituciones mantendrán una reunión el martes 18 de julio, a las 08:30.</p>
                                <p>
                          </div>
                        </div>
                            
                        </li>


                        <li class="media media-sm">
                    <div class="media-body text-right">
                            <div class="media">
                          <a class="media-left" href="javascript:;">
                                      <img src="{{ asset('imagenes/dialogo_nacional/noticia-1-dialogo.png') }}" alt="" class="" />
                          </a>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>LOJA RECIBIRÁ LA PRÓXIMA ‘MESA DE DIÁLOGO’ DE COMUNICACIÓN</strong></h4>
                            <p>Quito (Pichincha).- La Universidad Técnica Particular de Loja (UTPL) acogerá una nueva jornada del ‘Diálogo Nacional’, llamado por el Gobierno, durante el cual se tratarán temas relativos a la comunicación. Tres temas marcarán la jornada: garantías y derechos de la comunicación, regulación y control; y publicidad y producción nacional..</p>
                                <p>
                          </div>
                        </div>
                            
                        </li>
                  </ul>


                </div>
                  
            </div>
            <div class="col-md-4 p-25">
              <div class="panel-group" id="accordion">
                <div class="panel panel-inverse overflow-hidden">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                      <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          <i class="fa fa-plus-circle pull-right"></i>
                        Consejo Sectorial de la Política
                      </a>
                    </h3>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li class="text-justify">Michael Porter extendi&oacute; la idea de que el grado en que una regi&oacute;n es competitiva var&iacute;a de acuerdo con la configuraci&oacute;n de un conjunto propio de factores internos y externos.
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel panel-inverse overflow-hidden">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                      <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          <i class="fa fa-plus-circle pull-right"></i>
                        Consejo Sectorial de la Producción
                      </a>
                    </h3>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li class="text-justify">Se generan un total de 64 indicadores agrupados en 12 pilares de an&aacute;lisis.
                        </li>
                        <li class="text-justify">
                          Para hacer comparable cada indicador fue necesario hacer una transformaci&oacute;n en una escala de 1 a 100.
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel panel-inverse overflow-hidden">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                      <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          <i class="fa fa-plus-circle pull-right"></i>
                       Consejo Sectorial de la Politica
                      </a>
                    </h3>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                      El &Iacute;ndice &uacute;nico de competitividad provincial est&aacute; compuesto por 64 indicadores agrupados en 12 pilares.

                    </div>
                  </div>
                </div>

                 <div class="panel panel-inverse overflow-hidden">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                      <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          <i class="fa fa-plus-circle pull-right"></i>
                       Media
                      </a>
                    </h3>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <iframe class="youtube-player" type="text/html" width="300" height="250" src="http://www.youtube.com/embed/vPur9z0pHYI?version=3&amp;rel=1&amp;fs=1&amp;showsearch=0&amp;showinfo=1&amp;iv_load_policy=1&amp;wmode=transparent" frameborder="0" allowfullscreen="true"></iframe>

                    </div>
                  </div>
                </div>

              </div>
              </div>
            <!-- FIN DE METODOLOGIA-->

                </div>

            </div>




        </div>
        <!-- end #team -->



      

@endsection

@section('end_js')
  @parent

  
  <script src="{{ asset('js/ui-modal-notification.demo.js') }}"></script>
@endsection

@section('init_scripts')

  <script>
      $(document).ready(function() {
          Notification.init();
      });
  </script>

@endsection
