<html>
<head></head>
<body >
<form method='POST' action="{{ url('/enviarCorreoNotificacion/') }}">
{{ csrf_field() }}

<button type='submit'>Enviar Notificacion Quincenal</button>
</form>



<form method='POST' action="{{ url('/enviarCorreoNotificacionCiudadano/') }}">
    {{ csrf_field() }}

    <button type='submit'>Enviar Notificacion Ciudadano</button>
</form>



<form method='POST' action="{{ url('/enviaCorreoSECOM/') }}">
    {{ csrf_field() }}

    <button type='submit'>Enviar Notificacion SECOM</button>
</form>
</body>
</html>