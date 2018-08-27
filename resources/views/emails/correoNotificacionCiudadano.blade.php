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



 </style>

</head>
<body >
<h1>{{$title}}</h1>
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
            Detalle
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
    <td>{{$notificacion[3]}}</td>
<td>
<a target="_blank" rel="noopener noreferrer"  class="myButton" href="http://localhost:8000/detalle-despliegue-dialogo/{{$notificacion[2]}}">VERDETALLE</a></td>
</tr>
    @endforeach
    @endif
</tbody>
</table>

</body>
</html>


