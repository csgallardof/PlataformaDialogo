<!DOCTYPE html>
<html lang="es">
<head>
    <title>Plataforma de Dialogo, Ecuador, Reporte diario de cambios en propuestas</title>
 <style type="text/css">
        .zui-table {
            border: solid 1px #193b68;
            border-collapse: collapse;
            border-spacing: 0;
            font: normal 13px Arial, sans-serif;
        }
        .zui-table thead th {
            background-color: #193b68;
            border: solid 1px #193b68;
            color: #ffffff;
            padding: 10px;
            text-align: left;
            /*text-shadow: 1px 1px 1px #fff;*/
        }
        .zui-table tbody td {
            border: solid 1px #193b68;
            color: #000000;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
        .zui-table-horizontal tbody td {
            border-left: none;
            border-right: none;
        }

        .myButton {
            -moz-box-shadow:inset 0px 39px 0px -24px #A5261D;
            -webkit-box-shadow:inset 0px 39px 0px -24px #A5261D;
            box-shadow:inset 0px 39px 0px -24px #A5261D;
            background-color:#A6281C;
            -moz-border-radius:4px;
            -webkit-border-radius:4px;
            border-radius:4px;
            border:1px solid #ffffff;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:15px;
            padding:6px 15px;
            text-decoration:none;
            text-shadow:0px 1px 0px #b23e35;
            
        }
        .myButton:hover {
            background-color:#841810;
        }
        /*.myButton:active {
            position:relative;
            top:1px;
        }*/

        .foo {
            float: left;
            width: 20px;
            height: 20px;
            margin: 5px;
            border: 1px solid rgba(0, 0, 0, .2);
        }

        .blue {
            background: #13b4ff;
        }

        .red {
            background: darkred;
        }

        .wine {
            background: #ae163e;
        }

 </style>

</head>
<body >

    <div align="center"  >
       <br><br><img  src="img/logo_dialogo_nacional.jpg"  class="img-responsive center-block"  width="15%" alt="logo plataforma dialogo">
       <br><br>
        <p style="margin:0; font-family: calibri;color:#2874A6"><h1><font   face="arial, verdana, helvetica" size=3 > {{$title}}</font></h1></p> <br>
    </div>


<table id="data-table" class="zui-table zui-table-horizontal" width="90%"  bordercolor="666633">
    <thead class="thead-light">
    <tr>
       <th><font   face="arial, verdana, helvetica" size=1 >
           Propuesta
           </font>
        </th>
        <th><font   face="arial, verdana, helvetica" size=1 >
            Estado
        </font>
        </th>
        <th><font   face="arial, verdana, helvetica" size=1 >
            Detalle
        </font>
        </th>
        <th>
            <font   face="arial, verdana, helvetica" size=1 >
           Validar
       </font>
        </th>
    </tr>
    </thead>
<tbody>
    @if( isset($notificacionesq) )
    @foreach( $notificacionesq as $notificacion )
<tr><td><font   face="arial, verdana, helvetica" size=1 >{{$notificacion[0]}}</font></td>
<td><font   face="arial, verdana, helvetica" size=1 >{{$notificacion[1]}}</font></td>
    <td><font   face="arial, verdana, helvetica" size=1 >{{$notificacion[3]}}</font></td>
<td>
<a target="_blank" rel="noopener noreferrer"  class="myButton" href="http://localhost:8000/detalle-despliegue-dialogo/{{$notificacion[2]}}"><font   face="arial, verdana, helvetica" size=1 >VERDETALLE</font></a></td>
</tr>
    @endforeach
    @endif
</tbody>
</table>

</body>
</html>


