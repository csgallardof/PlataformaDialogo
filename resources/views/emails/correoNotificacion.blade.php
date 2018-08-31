<!DOCTYPE html>
<html lang="es">
<head>
 <style type="text/css">
        .zui-table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            font: normal 13px Arial, sans-serif;
        }
        .zui-table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
        }
        .zui-table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
        .zui-table-horizontal tbody td {
            border-left: none;
            border-right: none;
        }

        .myButton {
            -moz-box-shadow:inset 0px 39px 0px -24px #e67a73;
            -webkit-box-shadow:inset 0px 39px 0px -24px #e67a73;
            box-shadow:inset 0px 39px 0px -24px #e67a73;
            background-color:#e4685d;
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
            background-color:#eb675e;
        }
        .myButton:active {
            position:relative;
            top:1px;
        }

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
<h1>{{$title}}</h1>

<?php
$total_abiertos=0;
$total_no_atendidos=0;//para el caso de propuestas que no registren actividades en los ultimos 15 días.
?>

@if( isset($notificacionesq) )
    @foreach( $notificacionesq as $notificacion )
        <?php
        $total_abiertos=$total_abiertos+1;
        ?>
        @if( isset($notificacion[2])==0)
            <?php
            $total_no_atendidos=$total_no_atendidos+1;
            ?>
        @endif

    @endforeach
@endif

<table id="data-table" class="zui-table zui-table-horizontal" width="90%">
    <thead class="thead-light">
    <tr>
        <th>Total propuestas abiertas</th>
        <th>Total propuestas No atendidas en los ultimos 15 días</th>
    </tr>

    </thead>
    <tr>
        <td><?php
            echo $total_abiertos;
            ?></td>
        <td><?php
            echo $total_no_atendidos;
            ?></td>
    </tr>

</table>
<?php

$total_abiertos=0;
$total_no_atendidos=0;//para el caso de propuestas que no registren actividades en los ultimos 15 días.
?>

<table id="data-table" class="zui-table zui-table-horizontal" width="90%" >
    <thead class="thead-light">
    <tr>
       <th>
           Propuesta
        </th>
        <th>
            Estado
        </th>
        <th>
            Atendida
        </th>

        <th>
           Validar
        </th>
    </tr>
    </thead>
<tbody>
    @if( isset($notificacionesq) )
    @foreach( $notificacionesq as $notificacion )
<tr><td>{{$notificacion[0]}}</td>
<td>{{$notificacion[1]}}</td>
    <td>
        @if( isset($notificacion[2])==0)
            <div class="foo red"> <span style="color: white"><b>NO</b></span> </div>
        @endif

        @if( isset($notificacion[2])==1)
                <div class="foo blue"> <span style="color:white"><b>SI</b></span> </div>
        @endif

    </td>

    <td>
<a target="_blank" rel="noopener noreferrer"  class="myButton" href="http://localhost:8000/detalle-despliegue-dialogo/{{$notificacion[2]}}">VERDETALLE</a></td>
</tr>
    @endforeach
    @endif
</tbody>
</table>

</body>
</html>


