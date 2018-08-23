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


  <!-- ini script carrusel -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // Initializes the carousel
    $(".start-slide").click(function(){
        $("#myCarousel").carousel('cycle');
    });
    // Stops the carousel
    $(".pause-slide").click(function(){
        $("#myCarousel").carousel('pause');
    });
    // Cycles to the previous item
    $(".prev-slide").click(function(){
        $("#myCarousel").carousel('prev');
    });
    // Cycles to the next item
    $(".next-slide").click(function(){
        $("#myCarousel").carousel('next');
    });
    // Cycles the carousel to a particular frame
    $(".slide-one").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".slide-two").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".slide-three").click(function(){
        $("#myCarousel").carousel(2);
    });
});
</script>

<style type="text/css">
.carousel{
    background: #2f4357;
    margin: 20px 0;
}
.carousel .item{
    min-height: 80px; /* Prevent carousel from being distorted if for some reason image doesn't load */
}
.carousel .item img{
    margin: 0 auto; /* Align slide image horizontally center */
}
.control-buttons{
    text-align: center;
}
.bs-example{
    margin: 20px;
}
</style>
  <!-- fin script carrusel -->


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
                                        <option value="0">Todas las Mesa</option>
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

            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <div class="row">
                    <div class="col-12" style="padding-bottom: 20px"><h2><strong>Herramientas <span style="color: #F26F21">productivas</span></strong></h2></div>
                    <br>

                </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-8">
                          
                </div>
                    
                <div class="col-md-4">

                        
                </div>
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
