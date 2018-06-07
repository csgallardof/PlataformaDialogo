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
                            <br><br><img  src="img/logo_mipro.jpg"  class="img-responsive center-block"  width="15%" alt="">

                            <br><br>
                            
                          <p style="margin:0; font-family: calibri;color:#2874A6"><strong>CONSEJO CONSULTIVO PRODUCTIVO Y TRIBUTARIO</strong></p> <br>
                          
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
                                                       <strong>Estado En Analisis</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                        
                                            <th align="center" width="100" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Propuesta</b>
                                                </font>
                                            </th>
                                             <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
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
                                        
                                       <?php foreach($data1 as $consutaPropuestasAnalisis){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                
                                                <td width="100" height="10" >
                                                    <font   face="arial, verdana, helvetica" size=1 > 
                                                    <strong>{{ ucfirst(mb_strtolower($consutaPropuestasAnalisis->verbo_solucion))}}</strong><br>
                                                    {{ucfirst(mb_strtolower($consutaPropuestasAnalisis->sujeto_solucion))}} <br>
                                                    {{ucfirst(mb_strtolower($consutaPropuestasAnalisis->complemento_solucion))}}
                                                        
                                                    
                                                    </font>
                                                </td>
                                                @if($consutaPropuestasAnalisis->name!="")
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$consutaPropuestasAnalisis->name}}
                                                    </font>
                                                </td>
                                                @else
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    Pendiente
                                                    </font>
                                                </td>
                                                @endif
                                                <td width="2" height="10" align="center" style="font-size: 13px">
                                                    <font face="arial, verdana, helvetica" > 
                                                    {{$consutaPropuestasAnalisis->nombre_estado}}
                                                    </font>
                                                </td>
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                           <br> <br> 
                           <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" style="padding-right:4%">
                                    <thead>
                                        <tr bgcolor="#F1C40F"> 
                                            <td colspan="3" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                       <strong>Estado En Desarrollo</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                        
                                            <th align="center" width="100" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Propuesta</b>
                                                </font>
                                            </th>
                                             <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
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
                                        @if(sizeof($data2)==0)
                                            <tr > 
                                                    <td colspan="3" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                        
                                       <?php foreach($data2 as $consutaPropuestasDesarrollo){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                
                                                <td width="100" height="10">
                                                    <font  face="arial, verdana, helvetica" size=1 > 
                                                    <strong>{{ ucfirst(mb_strtolower($consutaPropuestasDesarrollo->verbo_solucion))}}</strong><br>
                                                    {{ucfirst(mb_strtolower($consutaPropuestasDesarrollo->sujeto_solucion))}} <br>
                                                    {{ucfirst(mb_strtolower($consutaPropuestasDesarrollo->complemento_solucion))}}
                                                        
                                                    
                                                    </font>
                                                </td>
                                                @if($consutaPropuestasDesarrollo->name!="")
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$consutaPropuestasDesarrollo->name}}
                                                    </font>
                                                </td>
                                                @else
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    Pendiente
                                                    </font>
                                                </td>
                                                @endif
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$consutaPropuestasDesarrollo->nombre_estado}}
                                                    </font>
                                                </td>
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            
                            <br> <br> 
                           <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" style="padding-right:4%">
                                    <thead>
                                        <tr bgcolor="#E67E22"> 
                                            <td colspan="3" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                       <strong>Estado En Cierre</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                        
                                            <th align="center" width="100" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Propuesta</b>
                                                </font>
                                            </th>
                                             <th align="center" width="10" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
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
                                        @if(sizeof($data3)==0)
                                            <tr > 
                                                    <td colspan="3" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                        
                                       <?php foreach($data3 as $consutaPropuestasCierre){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                
                                                <td width="100" height="10">
                                                    <font  face="arial, verdana, helvetica" size=1 > 
                                                    <strong>{{ ucfirst(mb_strtolower($consutaPropuestasCierre->verbo_solucion))}}</strong><br>
                                                    {{ucfirst(mb_strtolower($consutaPropuestasCierre->sujeto_solucion))}} <br>
                                                    {{ucfirst(mb_strtolower($consutaPropuestasCierre->complemento_solucion))}}
                                                        
                                                    
                                                    </font>
                                                </td>
                                                @if($consutaPropuestasCierre->name!="")
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$consutaPropuestasCierre->name}}
                                                    </font>
                                                </td>
                                                @else
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    Pendiente
                                                    </font>
                                                </td>
                                                @endif
                                                <td width="2" height="10" align="center">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$consutaPropuestasCierre->nombre_estado}}
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
