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
                    <div class="panel-body home_main_web_title">
                        <h2 class="text-center text-white"><strong>DIALOGO NACIONAL PÚBLICO-PRIVADO</strong></h2>
                        <h5 class="text-center text-white home_sentence">“Dialogar no es muestra de debilidad, es una muestra de sabiduría. Nada sobre los ciudadanos, sin los ciudadanos”</h5>
                        <h6 class="text-center text-white home_author_sentence">Lenín Moreno Garcés<br />Presidente Constitucional de la República del Ecuador</h6>
                    </div>
                </div>

                        <div class="panel-body text-center">

                                  <div class="row">
                                      <div class="col-xs-8 col-xs-offset-2">
                                          <form method="GET" action="{{ route('nuevaBusquedaDialogo') }}" id="searchForm" class="search-home input-group">
                                              <div class="input-group-btn search-panel hidden-xs">
                                                <label for="tipo_dialogo" style="display:none;">Buscar por tipo de dialogo</label>
                                                  <select name="selectBusqueda" id="tipo_dialogo" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                      <option value="no">Filtrar por tipo de diálogo</option>

                                                      @foreach($tipo_dialogo as $tipo_dialogo)
                                                        <option value="{{ $tipo_dialogo->id }}" > {{ $tipo_dialogo->nombre }} </option>
                                                      @endforeach

                                                  </select>
                                              </div>
                                              <label for="buscar_general" style="display:none;">Parametro de busqueda</label>
                                              <input id="buscar_general" type="text" class="form-control" name="parametro" placeholder="Buscar información sobre propuestas y pedidos del diálogo nacional">
                                              <span class="input-group-btn">
                                                  <button id="btn_buscar" class="btn btn-default" type="submit">
                                                     <text class="hidden-xs">Buscar</text><i class="fa fa-2x fa-search visible-xs"></i>
                                                  </button>
                                              </span>
                                          </form><!-- end form -->
                                      </div><!-- end col-xs-8 -->
                                  </div><!-- end row -->

                          <p style="margin-top: 10px" class="text-white">Ejemplo: Costos de energía electrica, Promoción turística, Consejo Consultivo, Innovaci&oacute;n.</p>
                        </div>

                <div class="col-md-12 col-xs-12 p-b-30">
                      <div class="col-md-2 col-xs-2">
                      </div>
                      <div class="col-md-2 col-xs-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_1.png') }}" alt="logo de dialogos presidenciales">
                        <div class="text-center">
                          <div class="home_main_icon_line1">DIÁLOGOS</div>
                          <div class="home_main_icon_line2">PRESIDENCIALES</div>
                        </div>

                      </div>
                      <div class="col-md-2 col-xs-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_2.png') }}"  alt="logo de dialogos sectoriales">
                        <div class="text-center">
                          <div class="home_main_icon_line1 ">DIÁLOGOS</div>
                          <div class="home_main_icon_line2">SECTORIALES</div>
                        </div>
                      </div>
                      <div class="col-md-2 col-xs-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_3.png') }}"  alt="logo de dialogos productivos">
                        <div class="text-center">
                          <div class="home_main_icon_line1">DIÁLOGOS</div>
                          <div class="home_main_icon_line2">PRODUCTIVOS</div>
                        </div>
                      </div>
                      <div class="col-md-2 col-xs-2 text-center ">
                        <img class="home_part1_size_images" src="{{ asset('imagenes/dialogo_nacional/dialogo_4.png') }}"  alt="logo de logros alcanzados">
                        <div class="text-center">
                          <div class="home_main_icon_line1">LOGROS</div>
                          <div class="home_main_icon_line2">ALCANZADOS</div>
                        </div>
                      </div>
                </div>

            </div>
        </div>


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
