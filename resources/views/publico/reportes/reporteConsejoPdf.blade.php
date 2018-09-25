<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Agenda Territorial {{$date}}</title>
    
</head>
<body>
    <div class="row"> 
        <div class="col-md-4"> </div>   

        <div class="col-md-8">
                      <div class="box">
                        <div align="center"  >
                            <br><br><img  src="img/logo_presidencia_2.png" width="150" height="60" alt="">

                            <br><br>
                            
                          <p style="margin:0; font-family: calibri;color:#2874A6"><strong>DIALOGO NACIONAL</strong></p> <br>
                          
                        </div>
                       
                 
             <div class="panel-body">
                    <table  >
                         <tr>
                           <th colspan="3" ><div align="center">  REPORTE DE MINISTERIO DE LA PLATAFORMA DE DIALOGO NACIONAL </div></th>
                        </tr>
                       

                        <tr>
                           <th colspan="3" ><br /></th>
                        </tr>                                
                       <tr>
                           <th colspan="3" ><div align="center">Datos Informativos</div></th>
                        </tr>
                       
                         <tr >
                           <td colspan="2" ><div align="left">Fecha</div></td>
                            <td colspan="1" ><div align="left">{{$hoy}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">Responsable</div></td>
                            <td colspan="1" ><div align="left">{{$nombreusuario}}</div></td>
                        </tr>

                         <tr>
                           <td colspan="2" ><div align="left">Nombre de Instituci&oacute;n</div></td>
                            <td colspan="1" ><div align="left">{{$nombreinstitucion}}</div></td>
                        </tr>

                          <tr>
                           <td colspan="2" ><div align="left">Consejo Sectorial</div></td>
                            <td colspan="1" ><div align="left">{{$nombreConsejo}}</div></td>
                        </tr>


                        <tr>
                           <td colspan="2" ><div align="left">Periodo</div></td>
                            <td colspan="1" ><div align="left">{{$periodo}}</div></td>
                        </tr>

                         <tr>
                           <td colspan="2" ><div align="left">Fecha Inicial</div></td>
                            <td colspan="1" ><div align="left">{{$fechaInicial}}</div></td>
                        </tr>

                         <tr>
                           <td colspan="2" ><div align="left">Fecha Final</div></td>
                            <td colspan="1" ><div align="left">{{$fechaFinal}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="3" ><br /><br /></th>
                        </tr>
                       <tr>
                           <th colspan="3" ><div align="center">Tipo Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Recibidas</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasRecibidas}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Desestimadas</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesestimadas}}</div></td>
                        </tr>

                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Validadas</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasValidadas}}</div></td>
                        </tr>


                        <tr>
                           <th colspan="3" ><br /><br /></th>
                        </tr>
                        <tr>
                           <th colspan="3" ><div align="center">Estado de Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Cumplidas o Finalizadas</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasFinalisadas}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas en Desarrollo</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesarrolladas}}</div></td>
                        </tr>

                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas en An&aacute;lisis</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasAnalisadas}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Desestimadas</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesestimadas}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas en Conflicto</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasConflicto}}</div></td>
                        </tr>


                         <tr>
                           <th colspan="3" ><br /><br /></th>
                        </tr>
                       <tr>
                           <th colspan="3" ><div align="center">Forma de Cumplimiento</div></th>
                        </tr>
                       
                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas en PP</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasPolitica}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas leyes</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasLeyes}}</div></td>
                        </tr>

                  
                        <tr>
                           <th colspan="3" ><br /><br /></th>
                        </tr>
                        <tr>
                           <th colspan="3" ><div align="center">Prioridad de Propuestas</div></th>
                        </tr>
                       
                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas a Corto</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoCorto}}</div></td>
                        </tr>

                        <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Mediano</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoMediano}}</div></td>
                        </tr>

                         <tr>
                           <td colspan="2" ><div align="left">N° de Propuestas Largo Plazo</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoLargo}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="3" ><br /><br /></th>
                        </tr>
                         
                           <tr>
                           <th colspan="3" ><div align="center">Propuestas Planificadas por Consejo Sectorial</div></th>
                        </tr>
                        <tr>
                             <td colspan="2" ><div align="left">N° de Propuestas Planificadas</div></td>
                             <td colspan="1" ><div align="left">{{$numPropuestasPlanificadas}}</div></td>
                         </tr>
                        <tr>
                             <td colspan="2" ><div align="left">N° de Propuestas No planificadas</div></td>
                            <td colspan="1" ><div align="left">{{$numPropuestasNoPlanificadas}}</div></td>
                            
                          </tr>  

                        <tr>
                           <th colspan="3" ><br /><br /></th>
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
                           <th colspan="3" ><br /><br /></th>
                        </tr>

                         <tr>
                           <th colspan="3" ><div align="center">Estadística de Propuestas por Temática o Ámbito</div></th>
                        </tr>
                        <tr>
                             @foreach($propuestasPorAmbito as $propuestasPorAmbito)
                             <td colspan="1" ><div align="left">{{$propuestasPorAmbito ->ambito}}</div></td>
                               <td colspan="1" ><div align="right">{{$propuestasPorAmbito->numPorAmbito}}</div></td>
                              @endforeach
                         </tr>


                     </table>
                   
                </div>

                            
            </div>
    
</body>

</html>
