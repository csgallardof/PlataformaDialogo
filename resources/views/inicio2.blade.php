@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css') 
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style-responsive-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/theme/default-front.css') }}" id="theme" rel="stylesheet" />
  <link href="{{ asset('css/inteligencia.css') }}" id="theme" rel="stylesheet" />

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
        <div id="about" class="content work row-m-t-3" data-scrollview="true">


            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">

                <div class="col-12">

                    <div class="brand">
                        <img src="{{ asset('imagenes/inteligencia_productiva_home_white.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="450px" height="73px">
                    </div>

                    <div class="panel-body">
                        <h4 style="font-style: italic;" class="text-center text-white">Acuerdo por la producción y el empleo</h4>
                    </div>

                </div>

                <!-- <div class="col-lg-offset-3 col-lg-8 row-m-t-minus-25"> -->
                <div class="col-md-8 col-md-offset-2 row-m-t-minus-25" >
                    <div class="panel-body text-center">
                        
                        <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusqueda2') }}">
                            <div class="form-group">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control_2" placeholder="Busca todo sobre el diálogo con el sector productivo" name="parametro" required style="font-size: 16px" >
                                    <span class="input-group-btn">
                                        <button class="btn btn-buscar btn-lg" type="submit" height="50px">
                                            <span class="glyphicon glyphicon-search">&nbsp;BUSCAR</span>
                                        </button>
                                    </span>

                                </div>
                                <p style="margin-top: 10px" class="text-white">Ej: Mesas de Competitividad, Consejo Consultivo, Innovaci&oacute;n, Ministerio de Industrias y Productitivad, etc.</p>
                            </div>
                        </form>


 
                    </div>
                </div>




                
                <!-- <div class="col-md-12 row-m-t-minus-25">
                    <div class="panel-body text-center">

                      <a href="{{ asset('imagenes/foro-documentos/Digital_Economy_Industrias_BID.pdf') }}" target="_blank" target="_blank" class="btn btn-inverse"><i class="fa fa-book pull-left" aria-hidden="true"></i>Top 10 Instituciones</a>
                      <a href="#" target="_blank" class="btn btn-inverse"><i class="fa fa-book pull-left" aria-hidden="true"></i>Top 10 Propuestas de Soluci&oacute;n</a>

                    </div>
                </div>
 -->
            </div>

        </div>

        <!-- begin #team -->
        <div id="team" class="content team" data-scrollview="true">

            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <div class="row">
                    <div class="col-12" style="padding-bottom: 20px"><h2><strong>Herramientas <span style="color: #F26F21">productivas</span></strong></h2></div>
                    <br>
                    
                </div>

                <div class="row">
                    <div class="col-md-2 box">
                        <div class="container2">
                          <a href="/cifras"><img src="{{ asset('imagenes/cifras-home-inteligencia.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            <h3 style="margin-top: 20px; margin-bottom: 0px;color:#F26F21; "><strong>Cifras</strong></h3>
                            <p style="margin-bottom: 0px;color:#F26F21;">competitivas</p>
                          </div>
                        </div>

                    </div>
                    <div class="col-md-2 box">
                        <div class="container2">
                          <a href="/indice"><img src="{{ asset('imagenes/cifras-home-inteligencia-2-front.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            <h3 style="margin-top: 20px; margin-bottom: 0px;color:#F26F21; "><strong>Índice</strong></h3>
                            <p style="margin-bottom: 0px;color:#F26F21;">de competitividad</p>
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 box">
                        <div class="container2">
                          <a href="/vocaciones"><img src="{{ asset('imagenes/vocaciones-productivas-front.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            <h3 style="margin-top: 20px; margin-bottom: 0px;color:#F26F21; "><strong>Vocaciones</strong></h3>
                            <p style="margin-bottom: 0px;color:#F26F21;">productivas</p>
                          </div>
                        </div>

                    </div>
                    <div class="col-md-2 box">
                        <div class="container2">
                          <a href="http://servicios.industrias.gob.ec/biblioteca/" target="_blank"><img src="{{ asset('imagenes/biblioteca-front-2.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            <h3 style="margin-top: 20px; margin-bottom: 0px;color:#F26F21;"><strong>Biblioteca</strong></h3>
                            <p style="margin-bottom: 0px;color:#F26F21;">estudios</p>
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 box">
                        <div class="container2">
                          <a href="/inversiones"><img src="{{ asset('imagenes/inversiones-front-2.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            <h3 style="margin-top: 20px; margin-bottom: 0px;color:#F26F21;"><strong>Inversiones</strong></h3>
                            <p style="margin-bottom: 0px;color:#F26F21;">de productividad</p>
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 box">
                        <div class="container2">
                          <a href="http://encuestas.administracionpublica.gob.ec/index.php/887844/lang-es#" target="_blank"><img src="{{ asset('imagenes/simplificacion-tramites-front-2.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            <h3 style="margin-top: 20px; margin-bottom: 0px;color:#F26F21;"><strong>Trámites</strong></h3>
                            <p style="margin-bottom: 0px;color:#F26F21;">simplificación</p>
                          </div>
                        </div>
                        
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
  s
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
