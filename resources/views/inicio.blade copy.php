@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.min-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style-responsive-front.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/theme/default-front.css') }}" id="theme" rel="stylesheet" />
@endsection

@section('contenido')

        <!-- begin #about -->
        <div id="about" class="content row-m-t-3" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">

                <div class="col-12">

                    <div class="brand">
                        <img src="{{ asset('imagenes/inteligencia_productiva_home.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="450px" height="73px">
                    </div>

                    <div class="panel-body">
                        <h4 style="font-style: italic;" class="text-center">Mesas de Competitividad en el marco del acuerdo por la producción y el empleo</h4>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="panel-body text-center">

                      <a href="/cifras" class="btn btn-inverse"><i class="fa fa-bar-chart pull-left" aria-hidden="true"></i>Cifras</a>
                      <a href="/indice" class="btn btn-inverse"><i class="fa fa-list-ol pull-left" aria-hidden="true"></i>Índice Único de Competitividad</a>
                      <a href="/vocaciones" class="btn btn-inverse"><i class="fa fa-cog pull-left" aria-hidden="true"></i>Vocaciones Productivas</a>

                    </div>
                </div>

                <div class="col-md-12 row-m-t-minus-25">
                    <div class="panel-body text-center">

                      <a href="/despliegueterritorial" class="btn btn-inverse"><i class="fa fa-comments-o pull-left" aria-hidden="true"></i>Despliegue Territorial</a>
                      <a href="http://192.168.2.190" target="_blank" class="btn btn-inverse"><i class="fa fa-book pull-left" aria-hidden="true"></i>Biblioteca</a>

                    </div>
                </div>

            </div>

        </div>

        <div class="bg-cover"></div>

                </div>
                   <!-- begin col-3 -->
        <!-- end #about -->



        <!-- begin #team -->
        <div id="team" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container row-m-t-4">
                hola

            </div>
            <!-- end container -->
        </div>
        <!-- end #team --> 

        <!-- begin #work -->
        <div id="work" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">

								<!-- Spacing --><hr class="hr_style1 row-m-b-1"><!-- End Spacing -->
                <!-- begin row -->
                <div class="row row-space-10">
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/1.jpg') }}" alt="Work 1" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/2.jpg') }}" alt="Work 3" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/6.jpg') }}" alt="Work 5" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/4.jpg') }}" alt="Work 7" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
                <!-- begin row -->
                <div class="row row-space-10">
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/5.jpg') }}" alt="Work 2" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/6.jpg') }}" alt="Work 4" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/3.jpg') }}" alt="Work 6" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{ asset('imagenes/CCT/5.jpg') }}" alt="Work 8" /></a>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #work -->

@endsection

@section('end_js')
  @parent
  <script src="{{ asset('js/apps-front.js') }}"></script>
  <script src="{{ asset('js/ui-modal-notification.demo.js') }}"></script>
@endsection

@section('init_scripts')

  <script>
      $(document).ready(function() {
          Notification.init();
      });
  </script>

@endsection
