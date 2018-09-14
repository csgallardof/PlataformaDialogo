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
<title>Plataforma de Dialogo Nacional, Correo de Notificacion</title>
</head>
<body >
<center>
    <div align="center"  >
       <br>
       <img src="{{ $message->embed(public_path() . '/img/logo_dialogo_nacional.jpg') }}"  class="img-responsive center-block"  width="15%" alt="logo plataforma dialogo" />
       <!--<img  src="img/logo_dialogo_nacional.jpg"  class="img-responsive center-block"  width="15%" alt="logo plataforma dialogo">-->
       <br>
    </div>

<h1>{{$title}}</h1>
</center>


<footer>
<center>
    <div class="col-md-4 col-sm-4 col-xs-12">
                                <img title="Secretaría Nacional de Gestión de la Política" alt="Secretaría Nacional de Gestión de la Política" src="https://www.politica.gob.ec/wp-content/themes/Sitio-32/images/logo_presidencia.png" longdesc="longdesc/logdesc.html">
                            </div>
     <div class="col-md-8 col-sm-8 col-xs-12 text">
                                
                                Venezuela N3-66 entre Sucre y Espejo <br> Quito - Ecuador                                <br>Teléfono: 593-2 228-8367
    </div>
</center>    
</footer>
</body>
</html>


