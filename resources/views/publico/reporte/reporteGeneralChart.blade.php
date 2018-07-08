@extends('layouts.main')
@section('title', 'Reporte')
@section('start_css')
@parent
<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

@endsection

@section('contenido')
 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('visualization',"1",{'packages':['corechart','bar','table']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChartMesa);
      google.charts.setOnLoadCallback(drawChartPlazo);
      google.charts.setOnLoadCallback(drawChartZona);
      google.charts.setOnLoadCallback(drawChartInstitucion);
      google.charts.setOnLoadCallback(drawChartActividad);
      google.charts.setOnLoadCallback(drawTable);


      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Consejo Sectorial', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($solicitud as $solicitudes)
           ['{{$solicitudes->nombre}}',{{$solicitudes->analisis}},{{$solicitudes->desarrollo}},{{$solicitudes->finalizado}}],
           @endforeach
        ]);
         var options = {
          chart: {
            title: 'Propuestas designadas por Consejo Sectorial',
            subtitle: '',
          }
        };

        //var chart = new google.visualization.PieChart(document.getElementById('estadosDiv'));
        //chart.draw(data, options);
        
        var chart = new google.charts.Bar(document.getElementById('estadosDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        
      }
      
      function drawChartMesa() {
        var data = google.visualization.arrayToDataTable([
          ['Mesa Dialogo', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($mesa as $mesas)
            ['{{$mesas->nombre}}',{{$mesas->analisis}},{{$mesas->desarrollo}},{{$mesas->finalizado}}],
           @endforeach
        ]);
      
         var options = {
          chart: {
            title: 'Número de propuestas por Mesas de Diálogo',
            //subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };
        
        var chart = new google.charts.Bar(document.getElementById('mesasDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        
      }
      
      
      
      
      function drawChartZona() {
        var data = google.visualization.arrayToDataTable([
          ['Mesa Dialogo', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($zona as $zonas)
           ['{{$zonas->nombre}}',{{$zonas->analisis}},{{$zonas->desarrollo}},{{$zonas->finalizado}}],
           @endforeach
        ]);
        var options = {
          chart: {
            title: 'Número de propuestas por Zona',
            //subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };
        
        var chart = new google.charts.Bar(document.getElementById('zonasDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      
      
          
      function drawChartPlazo() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por plzo y estado', 'Total'],
           @foreach($plazo as $plazos)
           ['{{$plazos->plazo}}',{{$plazos->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Plazo'
        };
        var chart = new google.visualization.PieChart(document.getElementById('plazosDiv'));
        chart.draw(data, options);
      }
      
      
      function drawChartInstitucion() {
        var data = google.visualization.arrayToDataTable([
      ['Instituciones', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($institucion as $instituciones)
             ['{{$instituciones->nombre}}',{{$instituciones->analisis}},{{$instituciones->desarrollo}},{{$instituciones->finalizado}}],
           @endforeach
        ]);
              var options = {
          chart: {
            title: 'Propuestas por Instituciones',
          //  subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };
                var chart = new google.charts.Bar(document.getElementById('institucionesDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
 
        function drawChartActividad() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Consejo Sectorial');
        data.addColumn('string', 'Institucion');
        data.addColumn('number', 'Analisis');
        data.addColumn('number', 'Desarrollo');
        data.addColumn('number', 'Finalizado');
        data.addColumn('number', 'Actividades');
        
        data.addRows([
        
          @foreach($actividad as $actividades)
          ['{{$actividades->consejo}}','{{$actividades->institucion}}',{{$actividades->analisis}},{{$actividades->desarrollo}},{{$actividades->finalizado}},{{$actividades->actividad}}],
           @endforeach
          
          
        ]);

        var table = new google.visualization.Table(document.getElementById('actividadesDiv'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }

    </script>
    <br><br><br><br>
	<!-- begin row -->
	<div id="about" class="content work" data-scrollview="true">
   <div class="container" data-animation="true" data-animation-type="fadeInDown">
          <div class="toolbar title_ip_breadcrumb fit-m-b-10">  
                <h3> Reportes Dialogo Nacional 
                
                
                </h3> 
          <hr>
          </div>
            <div class="row col-sm-12">
                <form method="POST"  action="/reporte">
                    {{ csrf_field() }}
                    <div class="form-group col-sm-4">
                        <label for="consejoSectorial_id">Consejo sectorial:</label>
                         <select class="form-control" name="consejoSectorial_id" id="consejoSectorial_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($consejoSectorial_) )
                                    @foreach( $consejoSectorial_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre_consejo}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="estado_id">Estados:</label>
                 
                         <select class="form-control" name="estado_id" id="estado_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($estado_) )
                                    @foreach( $estado_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre_estado}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div>
                     <div class="form-group col-sm-4">
                         <label for="institucion_id">Instituci&oacute;n:</label>
                        <select class="form-control" name="institucion_id" id="institucion_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($institucion_) )
                                    @foreach( $institucion_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre_institucion}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div> 
                       <div class="form-group col-sm-4">
                        <label for="mesa_id">MESA:</label>
                        <select class="form-control" name="mesa_id" id="mesa_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($mesaDialogo_) )
                                    @foreach( $mesaDialogo_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div> 
                       <div class="form-group col-sm-4">
                        <label for="zona_id">Zona:</label>
                        <select class="form-control" name="zona_id" id="zona_id">
                                     <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($zona_) )
                                    @foreach( $zona_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div> 
                    <div class="form-group col-sm-4">
                        <label for="palabra_clave_id">Palabra Clave:</label>
                        <select class="form-control" name="palabra_clave_id" id="palabra_clave_id">
                            <option value="-1" selected="true"> - Seleccione - </option>
                            @if( isset($palabraClave_) )
                            @foreach( $palabraClave_ as $item )
                            <option value="{{ $item->nombre}}">
                                {{ $item->nombre}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div> 
                     <div class="form-group col-sm-4">
                         <label for="palabra_clave_id">Ponderaci&oacute;n:</label>
                         <select class="form-control" name="ponderacion_id" id="ponderacion_id">
                            <option value="-1" selected="true"> - Seleccione - </option>
                            <option value="0">0</option>
                            <option value="25">25</option>
                            <option value="25">50</option>
                            <option value="25">75</option>
                            <option value="25">100</option>                            
                        </select>
                     
                         <button type="submit" class="btn btn-default">Buscar...</button>
                    </div>
                     
                </form> 
            </div>
 

            <div class="row col-sm-12">

                <div id="estadosDiv" style="width: 400px; height: 400px;" class=" col-sm-6"></div>
                <div id="mesasDiv" style="width: 400px; height: 400px;" class=" col-sm-6"></div>
            </div>
            <div class="row col-sm-12">
                <div id="zonasDiv" style="width: 400px; height: 400px;" class=" col-sm-6"></div>
                <div id="plazosDiv" style="width: 400px; height: 400px;"class=" col-sm-6"></div>
            </div>
            <div class="row col-sm-12">
                <div id="institucionesDiv" style="width: 400px; height: 400px;"class=" col-sm-6"></div>
           
            </div>
             <div class="row col-sm-12">
     
                <div id="actividadesDiv"  class=" col-sm-12"></div>
            </div>
        </div>
    </div>
    
     
     @endsection
