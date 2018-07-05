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
                            <font face="arial, verdana, helvetica" style="font-size: 14px" > 
                            <strong>Detalle de Propuestas:</strong> 
                            </font> <br><br> 
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="table-responsive" >
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" style="padding-right:4%">
                                    <thead>
                                        <tr bgcolor="#229954"> 
                                            <td colspan="3" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                       <strong>Dialogo Nacional</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                            <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Codigo</b>
                                                </font>
                                            </th>
                                            <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha Creacion</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Problema Solucion</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Propuesta Solucion</b>
                                                </font>
                                            </th>
                                             <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
                                                </font>
                                            </th>
                                            <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Corresponsable</b>
                                                </font>
                                            </th>
                                           <th align="center" width="20" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Estado</b>
                                                </font>
                                            </th>
                                           
                                           
                                             
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if(sizeof($data1)==0)
                                            <tr > 
                                                    <td colspan="3" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                        
                                       <?php foreach($data1 as $propuestasDialogo){ ?>
                                            <tr bgcolor="#FDFEFE">

                                                
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$propuestasDialogo->id}}
                                                    </font>
                                               
                                                </td>
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{substr($propuestasDialogo->created_at,0,10)}}
                                                    </font>
                                               
                                                </td>

                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$propuestasDialogo->problema_solucion}}
                                                    </font>
                                               
                                                </td>
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$propuestasDialogo->propuesta_solucion}}
                                                    </font>
                                               
                                                </td>
                                               
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$propuestasDialogo->nombre_institucion}}
                                                    </font>
                                               
                                                </td>
                                                 <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$propuestasDialogo->corresponsable_solucion}}
                                                    </font>
                                               
                                                </td>
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$propuestasDialogo->nombre_estado}}
                                                    </font>
                                               
                                                </td>
                                                
                                                
                                                
                                                
                                                
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                           
                            
                        
                       
                        </div>
                            
            </div>
    
</body>

</html>
