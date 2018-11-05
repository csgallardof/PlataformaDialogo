@extends('layouts.institucion')

@section('content')
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>



<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                  
                </div>
                 <h3 align="left" class="panel-title">Reporte de Ministerio de la Plataforma de Di&aacute;logo Nacional</h3>
            </div>
        </div>
    </div>
</div> 


<div class="container">
  <div class="col-md-12 ">
            <div class="panel panel-default">
            <br/><br/>

              <form target="_self" method="GET" action="{{ route('reporteInstitucion.institucion') }}">
                   <div class="col-md-2">
                             Fecha Inicial
                   </div>
                   <div class="col-md-4">
                       
                       <input id="fechaInicial" name="fechaInicial" class="date form-control" type="text" value="{{$fechaInicial}}" required="" >
                   </div>
                   <div class="col-md-2">
                             Fecha Final
                   </div>
                   <div class="col-md-4">
                       
                       <input id="fechaFinal" name="fechaFinal" class="date form-control" type="text" value="{{$fechaFinal}}" required="" >
                   </div>
                   <div class="col-md-12">
                        <button type="submit"   class="btn btn-primary" name="consulto" value="{{$consulto='si'}}">Consultar</button>
                   </div>

                   <script type="text/javascript">
                      $('.date').datepicker({  
                         format: 'dd-mm-yyyy'
                       });  
                   </script> 
              
                     <br /><br /><br />

                   <div class="col-md-4"></div>
                   <div class="col-md-2">
                      @if(  $fechaInicial != null && $fechaFinal != null )
                      <a class="link" href=" {{ route('exportarPdf.ReporteMinisterio', [ $fechaInicial, $fechaFinal ] ) }} " target="_self">
                           <button  type="button"  class="btn btn-primary" id="pdf" name="pdf" >Descargar PDF </button>
                       </a>  
                       @endif
                      </div>    
        
                    <div class="col-md-2">
                      @if( $fechaInicial != null && $fechaFinal != null )
                      <a class="link" href=" {{ route('exportarExcel.ReporteMinisterio', [ $fechaInicial, $fechaFinal] ) }} " target="_self">
                           <button  type="button"  class="btn btn-primary" id="excel" name="excel" >Descargar Excel </button>
                       </a>  
                       @endif
                    </div>

                    <div class="col-md-2">
                      @if(  $fechaInicial != null && $fechaFinal != null )
                      <a class="link" href=" {{ route('exportarGrafico.ReporteMinisterio', [ $fechaInicial, $fechaFinal ] ) }} " target="_self">
                           <button  type="button"  class="btn btn-primary" id="graf" name="graf" >Descargar Gráfico </button>
                       </a>  
                       @endif
                      </div> 
                     <div class="col-md-4"></div>

                        <br /><br />

               </form>


                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                           <th colspan="3" ><div align="center">  REPORTE DE MINISTERIO DE LA PLATAFORMA DE DIALOGO NACIONAL </div></th>
                        </tr>
                       </thead>
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

                        <tr>
                           <th colspan="2" ><div align="left">Fecha Desde</div>
                            <td colspan="1" ><div align="left">{{$fechaInicial}}</div></td>
                           </tr>
                            <tr>
                             <th colspan="2" ><div align="left">Fecha Hasta</div></th>
                            <td colspan="1" ><div align="left">{{$fechaFinal}}</div></td>
                        </tr>

                       <tr>
                           <th colspan="3" ><div align="center">Tipo Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Recibidas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasRecibidas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Desestimadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesestimadas}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Validadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasValidadas}}</div></td>
                        </tr>


                        <tr>
                           <th colspan="3" ><div align="center">Estado de Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Cumplidas o Finalizadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasFinalisadas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en Desarrollo</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesarrolladas}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en An&aacute;lisis</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasAnalisadas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Desestimadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesestimadas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en Conflicto</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasEnConflicto}}</div></td>
                        </tr>

                       <tr>
                           <th colspan="3" ><div align="center">Forma de Cumplimiento</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en PP</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPolitica}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas leyes</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasLeyes}}</div></td>
                        </tr>

               
                        <tr>
                           <th colspan="3" ><div align="center">Propuestas por Plazo</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas a Corto</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoCorto}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Mediano</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoMediano}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Largo Plazo</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoLargo}}</div></td>
                        </tr>
                         
                          <tr>
                           <th colspan="3" ><div align="center">Propuestas Planificadas por Consejo Sectorial</div></th>
                        </tr>
                        <tr>
                             <th colspan="2" ><div align="left">N° de Propuestas Planificadas</div></th>
                             <td colspan="1" ><div align="left">{{$numPropuestasPlanificadas}}</div></td>
                         </tr>
                        <tr>
                             <th colspan="2" ><div align="left">N° de Propuestas No planificadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasNoPlanificadas}}</div></td>
                          </tr>  


                         <tr>
                           <th colspan="3" ><div align="center">Estadística de Propuestas por Mesa</div></th>
                        </tr>
                        <tr>
                             <th colspan="1" ><div align="left">Nombre de la mesa</div></th>
                             <th colspan="1" ><div align="left">Propuestas en proceso</div></th>
                             <th colspan="1" ><div align="left">Propuestas finalizadas</div></th>
                         </tr>       
                            @foreach($propuestasPorMesa as $propuestasPorMesa)
                              <tr>
                                 <td colspan="1" ><div align="left"> {{ $propuestasPorMesa ->nombreMesa }}</div></td>
                                  <td colspan="1" ><div align="left"> {{ $propuestasPorMesa ->porTerminar}}</div></td>
                                  @if(!empty($propuestasPorMesaFinalizadas))
                                   @if($propuestasPorMesaFinalizadas ->idMesa ==  $propuestasPorMesa ->idMesa)
                                   @foreach($propuestasPorMesaFinalizadas as $propuestasPorMesaFinalizadas)
                                         <td colspan="1" ><div align="left"> {{ $propuestasPorMesaFinalizadas -> porTerminar}}</div></td>
                                   @endforeach
                                   @endif
                                   @else
                               <td colspan="1" ><div align="left">0</div></td>
                                   
                                    @endif

                           </tr>
                           @endforeach
            
                        <tr>
                           <th colspan="3" ><div align="center">Estadística de Propuestas por Temática o Ámbito</div></th>
                        </tr>
                        <tr>
                             @foreach($propuestasPorAmbito as $propuestasPorAmbito)
                             <td colspan="1" ><div align="left">{{$propuestasPorAmbito ->ambito}}</div></td>
                               <td colspan="1" ><div align="left">{{$propuestasPorAmbito->numPorAmbito}}</div></td>
                              @endforeach
                         </tr>


                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
