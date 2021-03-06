@extends('layouts.consejo-sectorial')

@section('title','Propuestas-Consejo Sectorial')

@section('content')
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


		<!-- begin #content -->
		<!-- begin #content -->
        <div id="content" class="content" width="10%">
   
             <div class="row">
                <!-- begin col-8 -->
                
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading" style="text-align: center;">
                            <h3 class="panel-title">Reporte Consejo Sectorial de la Plataforma del Di&aacute;logo Nacional</h3>
                        </div>

                    <div class="panel-body">


                     <form target="_self" method="GET" action="{{ route('reporteConsejo.institucion') }}">
                       <?php $consulto='no';?>
                       <div class="row">
                         <div class="col-md-3"></div>
                         <div class="col-md-1">
                           Instituci&oacute;n
                         </div>
                         <div class="col-md-4">
                           <select name="selInstituciones" class="form-control"  id="selInstituciones" required="" 
                           onchange="">
                           <option value="">Seleccione</option>
                           @if( isset($listaMinisterioPorConsejo) )
                           @foreach($listaMinisterioPorConsejo as $lista)
                           <option value="{{$lista->idInstitucion}}" {{ $idBusqueda == $lista->idInstitucion ? 'selected="selected" ' : '' }} > {{$lista->nombre_institucion}}</option>
                           @endforeach
                           @endif
                           <option value="Todos" {{ $idBusqueda == 'Todos' ? 'selected="selected" '  : '' }}>Todos</option>
                         </select>
                       </div>
                     </div>
                     <br />


                     <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-1">
                       Fecha Inicial
                     </div>
                     <div class="col-md-2" style="z-index: 9999">

                       <input id="fechaInicial" name="fechaInicial" class="date form-control" type="text" value="{{$fechaInicial}}" required="" >
                     </div>
                     <div class="col-md-1"></div>
                     <div class="col-md-1">
                       Fecha Final
                     </div>
                     <div class="col-md-2"  style="z-index: 9999">

                       <input id="fechaFinal" name="fechaFinal" class="date form-control" type="text" value="{{$fechaFinal}}" required="" >
                     </div>
                     <div class="col-md-3">

                      <button type="submit"   class="btn btn-primary" name="consulto" value="{{$consulto='si'}}">Consultar</button>

                    </div>


                    <script type="text/javascript">

                      $('.date').datepicker({  

                       format: 'yyyy-mm-dd',

                     });  

                   </script>  

                 </div>

                 <br/>
                 <div class="col-md-4"></div>
                 <div class="col-md-2">
                  @if( $idBusqueda != null &&  $fechaInicial != null && $fechaFinal != null )
                  <a class="link" href=" {{ route('exportarPdf.ReporteConsejo', [ $idBusqueda , $fechaInicial, $fechaFinal] ) }} " target="_self">
                   <button  type="button"  class="btn btn-primary" id="pdf" name="pdf" >Descargar PDF </button>
                 </a>  
                 @endif
               </div>    

               <div class="col-md-2">
                @if($idBusqueda != null && $fechaInicial != null && $fechaFinal != null && $consulto=='si')
                <a class="link" href=" {{ route('exportarExcel.ReporteConsejo', [ $idBusqueda , $fechaInicial, $fechaFinal, $consulto] ) }} " target="_self">
                 <button  type="button"  class="btn btn-primary" id="consulto" name="consulto" value="{{$consulto='no'}}">Descargar Excel </button>
               </a>  
               @endif
             </div>
             <div class="col-md-4"></div>
           </form>

       

<br />

<div class="row"> 
<div class="col-md-4"></div>   

        </div>
                    <br />

                    <div  class="col-md-9 col-md-offset-2">
                         <table class="table table-hover">
                        <thead>
                        <tr>
                           <th colspan="3" ><div align="center">  REPORTE CONSEJO SECTORIAL DE LA PLATAFORMA DE DIALOGO NACIONAL </div></th>
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
                           <th colspan="2" ><div align="left">Consejo Sectorial</div></th>
                            <td colspan="1" ><div align="left">{{$nombreConsejo}}</div></td>
                        </tr>

                      @if($idBusqueda!="Todos")
                         <tr>
                           <th colspan="2" ><div align="left">Institución</div></th>
                            <td colspan="1" ><div align="left">{{$nombreinstitucion}}</div></td>
                        </tr>
                      @endif                    
                     
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
                            <td colspan="1" ><div align="left">{{$numPropuestasConflicto}}</div></td>
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
                           <th colspan="3" ><div align="center">Propuestas Tiempo por Consejo Sectorial</div></th>
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
                            
            
                         <tr>
                           <th colspan="3" ><div align="center">Estadística de Propuestas por Temática o Ámbito</div></th>
                        </tr>
                        <tr>
                         </tr>

                        </tbody>
                    </table>
                    </div>

                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->

                
            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->
		

		@stop
                                                                                                                                                                               
