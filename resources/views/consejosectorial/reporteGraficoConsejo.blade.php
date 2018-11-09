@extends('layouts.consejo-sectorial')
@section('title','Reporte Consejo Sectorial')
@section('start_css')
@parent
    <link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
@endsection  

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<div class="container" width="10%" style="background-color: #f3f3f3;">
 <div class="col-md-12 ">
  <div class="panel panel-default">
    <div class="row">
      
      <div class="col-md-12">

      <!-- inicio cuadrados -->
    
        <div class="col-md-12">

  <div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse"  data-sortable-id="chart-js-2">
            <div class="panel-heading">                
                 <h3 class="panel-title">Reporte Consejo Sectorial de la Plataforma de Di&aacute;logo Nacional</h3>
            </div>
        </div>
    </div>
</div> 

 <div class="row">
  <table class="table table-hover">
                       
                        <tbody>

                     
                       <tr>
                           <th colspan="3" ><div align="center">Datos Informativos</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">Fecha</div></th>
                            <td colspan="1" ><div align="left">{{$hoy}}</div></td>
                        </tr>
                         <tr>
                           <th colspan="2" ><div align="left">Responsable</div></th>
                            <td colspan="1" ><div align="left">{{$nombreusuario}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">Nombre de la Instituci&oacute;n</div></th>
                            <td colspan="1" ><div align="left">{{$nombreinstitucion}}</div></td>
                        </tr>

                          <tr>
                           <th colspan="2" ><div align="left">Consejo Sectorial</div></th>
                            <td colspan="1" ><div align="left">{{$nombreConsejo}}</div></td>
                        </tr>                        

                        </tbody>
    </table>

    </div>

  <br/><br/>

        </div>

    </div>

  </div>
    </div>
		
@endsection

@section('end_js')
  @parent

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="{{ asset('plugins/DataTablesv2/datatables.js') }}"></script>
  <script src="{{ asset('js/table-manage-responsive.demo.js') }}"></script>
  <script src="{{ asset('plugins/scrollMonitor/scrollMonitor.js') }}"></script>
  <script src="{{ asset('js/apps.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>

  <!-- ================== END PAGE LEVEL JS ================== -->  
  <script>

    $(document).ready(function() {
      App.init();
      TablaCCPTHome.init();
    });

  </script>  

@endsection
                                                                                                                                                                               
