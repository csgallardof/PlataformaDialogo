<html>
<head></head>
<body >

<span >HOLA MUNDO</span>


<form  method="POST" action="{{ route('envioNotificacionQuincenal') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<a class="btn btn-primary pull-right m-b-30 m-l-30"  href="{{ url('/enviarCorreoNotificacion') }}">ver</a>

    <button type="submit" class="btn btn-primary pull-right">Enviar</button>
</form>


</body>
</html>