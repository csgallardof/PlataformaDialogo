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
                            
                          <p style="margin:0; font-family: calibri;color:#2874A6"><strong>AGENDA TERRITORIAL</strong></p>
                          <p style="margin-top:0 ; font-family: calibri"><strong>CONSEJO SECTORIAL DE LA PRODUCCIÓN</strong><br><b>Fecha:</b> {{$date}}</p><br>
                          
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            
                            <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" >
                                    <thead>
                                        <tr bgcolor="#229954"> 
                                            <td colspan="7" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                       <strong>Semana 1</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Institución</b>
                                                </font>
                                            </th>
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Tipo Cominicación</b>
                                                </font>
                                            </th>
                                            <th align="center" width="40" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha Agenda</b>
                                                </font>
                                            </th>
                                            
                                            <th align="center" width="10" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Lugar</b>
                                                </font>
                                            </th >
                                            <th align="center" width="90" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Descripción de: <br>Actividad/Proyecto/Obra/Reunión:</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Impacto Técnico-Político <br>(Beneficarios, Inversión, etc).</b>
                                                </font>
                                            </th>
                                            <th align="center" width="25" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
                                                </font>
                                            </th>
                                             
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if(sizeof($data1)==0)
                                            <tr > 
                                                    <td colspan="7" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                        
                                       <?php foreach($data1 as $agendaTerritorialSem1){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem1->Institucion}}
                                                    </font>
                                                </td>
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1>
                                                    @if($agendaTerritorialSem1->tipo_comunicacional!="") 
                                                    {{$agendaTerritorialSem1->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    </font>
                                                </td>
                                                <?php 
                                                 
                                                $fecha=substr($agendaTerritorialSem1->fecha_agenda, 0,10);
                                                $hora=substr($agendaTerritorialSem1->fecha_agenda, 11,8);
                                                //dd($fecha);
                                                $hora_agenda=strftime("%I:%M:%S %p",strtotime($hora));
                                                //dd($hora,$hora_agenda);

                                                ?>
                                                <td width="60" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha:</b>{{$fecha}} <br>
                                                    <b>Hora:</b>{{$hora_agenda}} 
                                                    </font>
                                                </td>
                                                
                                                <td width="10" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem1->nombre_canton}}
                                                    </font>
                                                </td>
                                                <td width="90" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem1->descripcion_tipo_agenda!!}
                                                    </font>
                                                </td>
                                                <td width="100" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem1->descripcion_tipo_impacto!!}
                                                    </font>

                                                </td> 
                                                <td width="25" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem1->responsable}}
                                                    </font>
                                                </td>
                                                
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                           
                            <br> <br>
                            <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" >
                                    <thead>
                                        <tr bgcolor="#F1C40F"> 
                                            <td colspan="7" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                       <strong>Semana 2</strong> 
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Institución</b>
                                                </font>
                                            </th>
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Tipo Cominicación</b>
                                                </font>
                                            </th>
                                            <th align="center" width="40" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha Agenda</b>
                                                </font>
                                            </th>
                                            
                                            <th align="center" width="10" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Lugar</b>
                                                </font>
                                            </th >
                                            <th align="center" width="90" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Descripción de: <br>Actividad/Proyecto/Obra/Reunión:</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Impacto Técnico-Político <br>(Beneficarios, Inversión, etc).</b>
                                                </font>
                                            </th>
                                            <th align="center" width="25" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
                                                </font>
                                            </th>
                                            
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if(sizeof($data2)==0)
                                            <tr > 
                                                    <td colspan="7" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                       <?php foreach($data2 as $agendaTerritorialSem2){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem2->Institucion}}
                                                    </font>
                                                </td>
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    @if($agendaTerritorialSem2->tipo_comunicacional!="") 
                                                    {{$agendaTerritorialSem2->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    </font>
                                                </td>
                                                <?php 
                                                 
                                                $fecha=substr($agendaTerritorialSem2->fecha_agenda, 0,10);
                                                $hora=substr($agendaTerritorialSem2->fecha_agenda, 11,8);
                                                //dd($fecha);
                                                $hora_agenda=strftime("%I:%M:%S %p",strtotime($hora));
                                                //dd($hora,$hora_agenda);

                                                ?>
                                                <td width="60" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha:</b>{{$fecha}} <br>
                                                    <b>Hora:</b>{{$hora_agenda}} 
                                                    </font>
                                                </td>
                                                
                                                <td width="10" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem2->nombre_canton}}
                                                    </font>
                                                </td>
                                                <td width="90" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem2->descripcion_tipo_agenda!!}
                                                    </font>
                                                </td>
                                                <td width="100" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem2->descripcion_tipo_impacto!!}
                                                    </font>

                                                </td> 
                                                <td width="25" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem2->responsable}}
                                                    </font>
                                                </td>
                                                
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" >
                                    <thead>
                                        <tr bgcolor="#E67E22"> 
                                            <td colspan="7" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                        <strong>Semana 3</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Institución</b>
                                                </font>
                                            </th>
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Tipo Cominicación</b>
                                                </font>
                                            </th>
                                            <th align="center" width="40" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha Agenda</b>
                                                </font>
                                            </th>
                                            
                                            <th align="center" width="10" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Lugar</b>
                                                </font>
                                            </th >
                                            <th align="center" width="90" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Descripción de: <br>Actividad/Proyecto/Obra/Reunión</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Impacto Técnico-Político <br>(Beneficarios, Inversión, etc).</b>
                                                </font>
                                            </th>
                                            <th align="center" width="25" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
                                                </font>
                                            </th>
                                            
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if(sizeof($data3)==0)
                                            <tr > 
                                                    <td colspan="7" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                       <?php foreach($data3 as $agendaTerritorialSem3){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem3->Institucion}}
                                                    </font>
                                                </td>
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    @if($agendaTerritorialSem3->tipo_comunicacional!="") 
                                                    {{$agendaTerritorialSem3->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    </font>
                                                </td>
                                                <?php 
                                                 
                                                $fecha=substr($agendaTerritorialSem3->fecha_agenda, 0,10);
                                                $hora=substr($agendaTerritorialSem3->fecha_agenda, 11,8);
                                                //dd($fecha);
                                                $hora_agenda=strftime("%I:%M:%S %p",strtotime($hora));
                                                //dd($hora,$hora_agenda);

                                                ?>
                                                <td width="60" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha:</b>{{$fecha}} <br>
                                                    <b>Hora:</b>{{$hora_agenda}} 
                                                    </font>
                                                </td>
                                                
                                                <td width="10" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem3->nombre_canton}}
                                                    </font>
                                                </td>
                                                <td width="90" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem3->descripcion_tipo_agenda!!}
                                                    </font>
                                                </td>
                                                <td width="100" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem3->descripcion_tipo_impacto!!}
                                                    </font>

                                                </td> 
                                                <td width="25" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem3->responsable}}
                                                    </font>
                                                </td>
                                                
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" >
                                    <thead>
                                        <tr bgcolor="#8E44AD"> 
                                            <td colspan="7" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                        <strong>Semana 4</strong>
                                                </font>    
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Institución</b>
                                                </font>
                                            </th>
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Tipo Cominicación</b>
                                                </font>
                                            </th>
                                            <th align="center" width="40" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha Agenda</b>
                                                </font>
                                            </th>
                                            
                                            <th align="center" width="10" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Lugar</b>
                                                </font>
                                            </th >
                                            <th align="center" width="90" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Descripción de: <br>Actividad/Proyecto/Obra/Reunión</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Impacto Técnico-Político <br>(Beneficarios, Inversión, etc).</b>
                                                </font>
                                            </th>
                                            <th align="center" width="25" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
                                                </font>
                                            </th>
                                            
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if(sizeof($data4)==0)
                                            <tr > 
                                                    <td colspan="7" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                       <?php foreach($data4 as $agendaTerritorialSem4){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem4->Institucion}}
                                                    </font>
                                                </td>
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    @if($agendaTerritorialSem4->tipo_comunicacional!="") 
                                                    {{$agendaTerritorialSem4->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    </font>
                                                </td>
                                                <?php 
                                                 
                                                $fecha=substr($agendaTerritorialSem4->fecha_agenda, 0,10);
                                                $hora=substr($agendaTerritorialSem4->fecha_agenda, 11,8);
                                                //dd($fecha);
                                                $hora_agenda=strftime("%I:%M:%S %p",strtotime($hora));
                                                //dd($hora,$hora_agenda);

                                                ?>
                                                <td width="60" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha:</b>{{$fecha}} <br>
                                                    <b>Hora:</b>{{$hora_agenda}} 
                                                    </font>
                                                </td>
                                                
                                                <td width="10" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem4->nombre_canton}}
                                                    </font>
                                                </td>
                                                <td width="90" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem4->descripcion_tipo_agenda!!}
                                                    </font>
                                                </td>
                                                <td width="100" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem4->descripcion_tipo_impacto!!}
                                                    </font>

                                                </td> 
                                                <td width="25" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem4->responsable}}
                                                    </font>
                                                </td>
                                                
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                
                                <table width="570"  border=1 cellspacing=0 cellpadding=2 bordercolor="666633" >
                                    <thead>
                                        <tr bgcolor="#B03A2E"> 
                                            <th colspan="7" align="center">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                        <strong>Semana 5</strong>
                                                </font>    
                                            </th>
                                        </tr>
                                        <tr bgcolor="#2874A6">
                                            
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Institución</b>
                                                </font>
                                            </th>
                                            <th align="center" width="2" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Tipo Cominicación</b>
                                                </font>
                                            </th>
                                            <th align="center" width="40" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha Agenda</b>
                                                </font>
                                            </th>
                                            
                                            <th align="center" width="10" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Lugar</b>
                                                </font>
                                            </th >
                                            <th align="center" width="90" height="10">
                                                <font  color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Descripción de: <br>Actividad/Proyecto/Obra/Reunión</b>
                                                </font>
                                            </th>
                                            <th align="center" width="100" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Impacto Técnico-Político <br>(Beneficarios, Inversión, etc).</b>
                                                </font>
                                            </th>
                                            <th align="center" width="25" height="10">
                                                <font color="#FDFEFE" face="arial, verdana, helvetica" size=1> 
                                                    <b>Responsable</b>
                                                </font>
                                            </th>
                                            
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if(sizeof($data5)==0)
                                            <tr > 
                                                    <td colspan="7" align="center"><strong>No Existen Registros</strong></td> 
                                                 
                                            </tr>
                                        @endif
                                       <?php foreach($data5 as $agendaTerritorialSem5){ ?>
                                            <tr bgcolor="#FDFEFE">
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem5->Institucion}}
                                                    </font>
                                                </td>
                                                <td width="2" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    @if($agendaTerritorialSem5->tipo_comunicacional!="") 
                                                    {{$agendaTerritorialSem5->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    </font>
                                                </td>
                                                <?php 
                                                 
                                                $fecha=substr($agendaTerritorialSem5->fecha_agenda, 0,10);
                                                $hora=substr($agendaTerritorialSem5->fecha_agenda, 11,8);
                                                //dd($fecha);
                                                $hora_agenda=strftime("%I:%M:%S %p",strtotime($hora));
                                                //dd($hora,$hora_agenda);

                                                ?>
                                                <td width="60" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    <b>Fecha:</b>{{$fecha}} <br>
                                                    <b>Hora:</b>{{$hora_agenda}} 
                                                    </font>
                                                </td>
                                                
                                                <td width="10" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem5->nombre_canton}}
                                                    </font>
                                                </td>
                                                <td width="90" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem5->descripcion_tipo_agenda!!}
                                                    </font>
                                                </td>
                                                <td width="100" height="10">
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {!!$agendaTerritorialSem5->descripcion_tipo_impacto!!}
                                                    </font>

                                                </td> 
                                                <td width="25" height="10"> 
                                                    <font face="arial, verdana, helvetica" size=1> 
                                                    {{$agendaTerritorialSem5->responsable}}
                                                    </font>
                                                </td>
                                                
                                            </tr>
                                            
                                        <?php } ?>   
                                    </tbody>
                                </table>
                            </div>

                       
                        </div>
                            
                        
                      

            <p style="margin: 50px; font-family: calibri"  ALIGN="justify" >
                <br><br><br>
                <strong>Consolidado por:</strong><br><br><br>
                <strong><u>_______________________________________</u></strong><br>
                <strong >Dr. Claudio Arcos</strong> <br>
                <strong>Secretario AD-HOC del Consejo Sectorial de la Producción</strong>
                <br><br><span><u>Esta información ha sido obtenida del módulo de Agenda Territorial de la plataforma de Inteligencia Productiva.</u></span>
                <span><br><br> <b>Ministerio de Industrias y Productividad</b></span>
            </p>
            </div>
    
</body>

</html>
