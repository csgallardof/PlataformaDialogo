<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Propuesta Detallada {{$date}}</title>
    
</head>
<body>
    <div class="row"> 
        <div class="col-md-4"> </div>   

        <div class="col-md-8">
                      <div class="box">
                        <div align="center"  >
                            <br><br><img  src="img/logo_presidencia_2.png" width="150" height="60" alt="">

                            
                            
                          <p style="margin:0; font-family: calibri;color:#2874A6"><strong>Dialogo Nacional</strong></p> <br>
                          
                        </div>
                            <font face="arial, verdana, helvetica" style="font-size: 14px" > 
                            <strong>Detalle de Propuesta:</strong> 
                            </font> <br><br> 
                        <!-- /.box-header -->
                        <div class="box-body"  style="margin-left:10%">
                            
                            <strong>Codigo:</strong>{{$data1->id}} <br>
                            <strong>Fecha Creación:</strong>{{$data1->created_at}} <br>
                            <strong>Problema Solución:</strong> {{$data1->problema_solucion}} <br> 
                            <strong>Propuesta Solución:</strong> {{$data1->propuesta_solucion}} <br>
                            <strong>Estado:</strong> {{$data1->nombre_estado}} <br>
                            <strong>Responsable:</strong>
                            @if($data1->estado_id!=1)
                             {{$data1->nombre_institucion}} <br> 
                            @else
                            La propuesta aun no tiene un Responsable <br>
                            @endif
                             
                            <strong>Co-Responsable:</strong> {{$data1->corresponsable_solucion}} <br> 

                            <strong>Actividades:</strong> 
                            @if($data1->estado_id==1)
                                No se encontraron actividades registradas.
                            @else
                            {!!$data1->actividades!!}
                            @endif 
                            <br>   
                           
                       
                           
                       
                        </div>
                            
            </div>
    
</body>

</html>
