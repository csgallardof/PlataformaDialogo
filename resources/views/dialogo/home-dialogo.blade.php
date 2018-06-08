@extends('layouts.main')

@section('title', 'Reporte')

@section('start_css')
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style-responsive-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/theme/default-front.css') }}" id="theme" rel="stylesheet" />
  <link href="{{ asset('css/inteligencia.css') }}" id="theme" rel="stylesheet" />

  <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
  <link href="{{asset ('css/style.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/style-responsive.min.css')}}" rel="stylesheet" />
  <link href="{{asset ('css/theme/default.css')}}" rel="stylesheet" id="theme" />
  <link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

   <script type="text/javascript">
        google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(drawStuff);

          function drawStuff() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Cadena SIPOC');
            data.addColumn('number', 'Propuestas');
            data.addRows([

              @foreach($propuestas_institucion as $propuestas_institucions)
                  ['{{ $propuestas_institucions ->responsable_solucion }}',{{ $propuestas_institucions ->total}}],  
                @endforeach
            ]);

           var options = {
             title: 'Actividades registradas por Institución',
             width: 900,
             height: 300,
             legend: 'none',
             bar: {groupWidth: '95%'},
             vAxis: { gridlines: { count: 4 } }
           };

           var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart_institucion'));
           chart.draw(data, options);

           document.getElementById('format-select').onchange = function() {
             options['vAxis']['format'] = this.value;
             chart.draw(data, options);
           };
        };  
      
    </script>



@endsection

@section('contenido')

        <!-- begin #about -->
        <div id="about" class="content work row-m-t-3 p-t-40" data-scrollview="true">


            <!-- begin container -->
            <div class="container p-t-40" data-animation="true" data-animation-type="fadeInDown">
                  <br><br>
                <div class="col-12 p-t-40">
                    <div class="panel-body">
                        <h2 class="text-center text-white"><strong>¿QUÉ SON LAS MESAS DE DÍALOGO NACIONAL?</strong></h2>
                        <h5 style="font-style: italic;" class="text-center text-white">Descripción de las mesas de dialogo nacional y leer más</h5>
                        
                    </div>
                </div>

                <div class="panel-body text-center">
                  <div class="row">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusqueda2') }}">
                    <div class="col-md-2"></div>
                    <div class="col-md-2" style="padding: 0px" > 
                      <select  style="text-align:center;width:100%;height:47px;font-size:14px;border-radius: 10px 0px 0px 10px;"  name="selectBusqueda" > 
                                        <option value="0">Todas las Mesas</option>
                                        <option value="2">Consejo Consultivo</option>
                                        <option value="1">Mesas De Competitividad</option>
                                        </select>
                    </div>

                    <div class="col-md-5" style="padding:0px">
                        <input type="text" class="form-control_2" style="-webkit-border-radius: 0px 0px 0px 0px;" placeholder="Busca todo sobre el diálogo con el sector productivo" name="parametro" data-parsley-range="[20,60]" maxlength="60">
                    </div>
                    <div class="col-md-1" style="padding:0px">

                      <button class="btn btn-buscar btn-lg" type="submit" height="50px">
                                            <i class="fa fa-search fa-1x">&nbsp;BUSCAR</i>
                                        </button>

                    </div>
                    <div class="col-md-1"></div>
                    </form>
                  </div>
                  <p style="margin-top: 10px" class="text-white">Ej: Mesas de Competitividad, Consejo Consultivo, Innovaci&oacute;n, Ministerio de Industrias y Productitivad, etc.</p>
                </div>
                
                <div class="col-md-12 p-t-20 p-b-20">
                      <div class="col-md-2">
                      </div>
                      <div class="col-md-2 text-center ">
                        <img src="{{ asset('imagenes/dialogo_nacional/dialogo_1.png') }}" >
                        <div class="text-center">
                          <strong>DIÁLOGOS</strong> 
                          <br>
                          <span class="f-s-8">PRESIDENCIALES</span>

                        </div>
                        
                      </div>
                      <div class="col-md-2 text-center ">
                        <img src="{{ asset('imagenes/dialogo_nacional/dialogo_2.png') }}" >
                        <div class="text-center">
                          <strong>DIÁLOGOS</strong> 
                          <br>
                          <span class="f-s-8">SECTORIALES</span>

                        </div>
                        
                      </div>
                      <div class="col-md-2 text-center ">
                        <img src="{{ asset('imagenes/dialogo_nacional/dialogo_3.png') }}" >
                        <div class="text-center">
                          <strong>INTELIGENCIA</strong> 
                          <br>
                          <span class="f-s-8">PRODUCTIVA</span>

                        </div>
                        
                      </div>
                      <div class="col-md-2 text-center ">
                        <img src="{{ asset('imagenes/dialogo_nacional/dialogo_4.png') }}" >
                        <div class="text-center">
                          <strong>LOGROS</strong> 
                          <br>
                          <span class="f-s-8">ALCANZADOS</span>

                        </div>
                        
                      </div>
                      <div class="col-md-2">
                      </div> 

                      
                </div>

            </div>



        </div>

        <!-- begin #team -->
        <div id="team" class="content team" data-scrollview="true">

            <div class="row">
              
               
                <div class="col-md-6">
                  <div id="number_format_chart_institucion"></div>
                </div>
                <div class="col-md-2">
                  
                </div>
                    
                
                    <!-- METODOLOGIA-->
            <div class="col-md-3">
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
                      <br><br>
                      <div class="col-md-12">
                        <img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/tablaIndicadores.png') }}">

                                            </div>


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



        <!-- begin #work -->
        <div id="work" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">

                <hr class="hr_style1 row-m-b-1"><!-- End Spacing -->


                <!-- begin row -->
                <div class="row">
                    <div class="col-md-4">
                        <a class="twitter-timeline box-tw" data-dnt="true" data-chrome="nofooter" href="https://twitter.com/hashtag/MesasDeCompetitividadEc" data-widget-id="909581797175984133">Tweets sobre #MesasDeCompetitividadEc</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                    </div>
                    <div class="col-md-4 manual-work">




                        <div class="row row-space-12">
                            <div id="myCarousel" class="carousel slide" data-interval="6000" data-ride="carousel">
                                <!-- Wrapper for carousel items -->
                                <div class="carousel-inner">
                                    <div class="active item">
                                        <img src="{{ asset('imagenes/CCT/1.jpg') }}" alt="First Slide">
                                        <div class="carousel-caption">
                                          <!-- <h3>First slide label</h3>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('imagenes/CCT/2.jpg') }}" alt="Second Slide">
                                        <div class="carousel-caption">
                                          <!-- <h3>Second slide label</h3>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('imagenes/CCT/3.jpg') }}" alt="Third Slide">
                                        <div class="carousel-caption">
                                          <!-- <h3>Third slide label</h3>
                                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 manual-work">

                        <div class="col-12"><h3><span style="color: #F26F21; text-align: left;"><strong>Contáctanos</span></strong></h2></div>

                        <table class="table table-profile">

                            <tbody>

                                <tr>

                                    <td style="text-align: left;"><small>
                                        <br> Plataforma Gubernamental de Gestión Financiera. Pisos 8 y 9 <br> <strong>Código Postal:</strong> 170506 <br> Quito-Ecuador </small></td>
                                </tr>

                                <tr>

                                    <td style="text-align: left;"><small><strong>Teléfono:</strong> 593-2 394 8760</small></td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;"><small><strong>mail:</strong> inteligencia@mipro.gob.ec</small></td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
            <!-- end container -->
        </div>
        <!-- end #work -->

@endsection

@section('end_js')
  @parent
  
  <script src="{{ asset('js/apps.min.js')}}"></script>
  <script src="{{ asset('js/ui-modal-notification.demo.js') }}"></script>
@endsection

@section('init_scripts')

  <script>
      $(document).ready(function() {
          Notification.init();
      });
  </script>

@endsection
