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
                           <th colspan="2" ><div align="left">Periodo</div></th>
                            <td colspan="1" ><div align="left">{{$periodo}}</div></td>
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



                        
                   
                </div>

                            
            </div>
    
</body>

</html>
