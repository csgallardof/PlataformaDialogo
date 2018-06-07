<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Hechos</title>
</head>
<body>
    <div class="row"> 
        <div class="col-md-4"> </div>

        <div class="col-md-8">
                      <div class="box">
                        <div align="center"  >
                            <br><br><img  src="img/logo_presidencia_2.png" width="150" height="60" alt="">
                            <br><br>
                            
                          <p style="margin:0; font-family: calibri;color:#2874A6"><strong>FICHA DE HECHOS RELEVANTES</strong></p>
                          <p style="margin-top:0 ; font-family: calibri"><strong>CONSEJO SECTORIAL DE LA PRODUCCIÓN<br> 
                            @if(!is_null($PeriodoSemanaCspReporte))
                             ({{$PeriodoSemanaCspReporte->fecha_inicio}} a {{$PeriodoSemanaCspReporte->fecha_final}})   
                            @endif
                            </strong>   
                          </p><br>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                        
                        @if(sizeof($data1)!=0)
                             <p ALIGN="left" style="font-family:calibri; margin: 0 0cm 0 1cm"><b> <u>Ministerio de Industrias y Productividad </u></b> <br></p><br>
                              
                              
                            
                           
                           
                            <?php foreach($data1 as $reporteHechoMipro){ ?>

                           <div style="margin: 0 1cm 25 2cm">
                            <p style="font-family: calibri"  ALIGN="justify" >
                            <strong>Tema: </strong>  <?= $reporteHechoMipro->tema; ?><br>
                            <strong>Tipo Comunicacional: </strong> 
                            @if($reporteHechoMipro->tipo_comunicacional!="")
                            <?= $reporteHechoMipro->tipo_comunicacional; ?>
                            @else
                            No Definido
                            @endif
                            <br>
                            <strong>Fuente: </strong><?= $reporteHechoMipro->fuente;?><br>
                            <strong>Fecha Reporte: </strong><?= $reporteHechoMipro->fecha_reporte; ?><br>
                            <strong>Porcentaje de avance: </strong><?= $reporteHechoMipro->porcentaje_avance;?>%<br>
                            <strong>Lugar: </strong><?= $reporteHechoMipro->lugar; ?><br>
                            <strong>Descripción: </strong>{!!$reporteHechoMipro->descripcion!!}
                            </p>
                            </div>
                            
                            <?php } ?>

                        @endif                             
                        
                        @if(sizeof($data3)!=0)   
                        <p ALIGN="left" style="font-family:calibri; margin: 0 0cm 0 1cm"><b> <u>Ministerio de Agricultura y Ganadería</u></b> <br></p><br>

                            
                            
                         
                        <?php foreach($data3 as $reporteHechoMAG){ ?>
                            <div style="margin: 0 1cm 25 2cm">
                            <p style="font-family: calibri"  ALIGN="justify" >
                            <strong>Tema: </strong>  <?= $reporteHechoMAG->tema; ?><br>
                            <strong>Tipo Comunicacional: </strong> 
                            @if($reporteHechoMAG->tipo_comunicacional!="")
                            <?= $reporteHechoMAG->tipo_comunicacional; ?>
                            @else
                            No Definido
                            @endif
                            <br>
                            <strong>Fuente: </strong><?= $reporteHechoMAG->fuente;?><br>
                            <strong>Fecha Reporte: </strong><?= $reporteHechoMAG->fecha_reporte; ?><br>
                            <strong>Porcentaje de avance: </strong><?= $reporteHechoMAG->porcentaje_avance;?>%<br>
                            <strong>Lugar: </strong><?= $reporteHechoMAG->lugar; ?><br>
                            <strong>Descripción: </strong>{!!$reporteHechoMAG->descripcion!!}
                            </p>
                            </div>
                            <?php } ?>  

                        @endif                   
                        
                        @if(sizeof($data2)!=0)
                        <p ALIGN="left" style="font-family:calibri; margin: 0 0cm 0 1cm"><b> <u>Ministerio de Acuacultura y Pesca </u></b> <br></p><br>
                            
                            
                         
                        <?php foreach($data2 as $reporteHechoMAP){ ?>
                            <div style="margin: 0 1cm 25 2cm">
                            <p style="font-family: calibri"  ALIGN="justify" >
                            <strong>Tema: </strong>  <?= $reporteHechoMAP->tema; ?><br>
                            <strong>Tipo Comunicacional: </strong> 
                            @if($reporteHechoMAP->tipo_comunicacional!="")
                            <?= $reporteHechoMAP->tipo_comunicacional; ?>
                            @else
                            No Definido
                            @endif
                            <br>
                            <strong>Fuente: </strong><?= $reporteHechoMAP->fuente;?><br>
                            <strong>Fecha Reporte: </strong><?= $reporteHechoMAP->fecha_reporte; ?><br>
                            <strong>Porcentaje de avance: </strong><?= $reporteHechoMAP->porcentaje_avance;?>%<br>
                            <strong>Lugar: </strong><?= $reporteHechoMAP->lugar; ?><br>
                            <strong>Descripción: </strong> {!!$reporteHechoMAP->descripcion!!}
                            
                                
                            </div>
                            
                            <?php } ?>
                        @endif
                        </div>
                            
                        
                      

            <p style="margin: 50px; font-family: calibri"  ALIGN="justify" >
                <br><br><br>
                <strong>Consolidado por:</strong><br><br><br>
                <strong><u>_______________________________________</u></strong><br>
                <strong >Dr. Claudio Arcos</strong> <br>
                <strong>Secretario AD-HOC del Consejo Sectorial de la Producción</strong>
                <br><br><span>Esta información ha sido obtenida del módulo de Hechos Relevantes y Alertas de la plataforma de Inteligencia Productiva</span>
                <span><br><br>Ministerio de Industrias y Productividad</span>
            </p>
            </div>
       
</body>

</html>
