@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  
  <link href="{{asset('plugins/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->
  
@endsection

@section('contenido')
  
        <!-- begin #about -->
        <div id="about" class="content work row-m-t-3 p-t-40" data-scrollview="true">

            <!-- begin container -->
            <div class="container p-t-25" data-animation="true" data-animation-type="fadeInDown">

                <div class="col-md-12 p-t-25">
                    <div class="panel-body">
                        <h2 class="text-center"><strong>Calendario de Diálogo</strong></h2>
                    </div>
                </div>

                <div class="content_cal">
                  <div class="panel-body p-0">
                    <div class="vertical-box">
                            
                        <div id="calendar" class="vertical-box-column p-15 calendar"></div>
                    </div>
                  </div>
              </div>
 
            </div>
        </div>

  

@endsection

@section('end_js')
  @parent

  
  <script src="{{ asset('plugins/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
  <script src="{{ asset('js/calendar.demo.js') }}"></script>
  <script src="{{ asset('js/apps.min.js') }}"></script>

    
  
@endsection

@section('init_scripts')

  <script>
    $(document).ready(function() {

      App.init();
      Calendar.init();
    });
  </script>

@endsection
