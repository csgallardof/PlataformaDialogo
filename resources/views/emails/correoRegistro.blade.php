<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Correo Registro</title>
</head>
<body>
	<img src="{{ asset('imagenes/inteligencia_productiva_home.png') }}" width="400px" style="padding-bottom: 30px"> <br>
	Bienvenido..!!
	<p>Se ha registrado a "{{ $institucion-> name}}" en la Plataforma de Inteligencia Productiva.</p>
	<p> Acceda a Inteligencia Productiva desde <a href="http://www.inteligenciaproductiva.gob.ec/login/">http://www.inteligenciaproductiva.gob.ec/login/</a></p>
	<p>
		Para acceder a su cuenta ingrese las siguientes credenciales: <br><br>
		<b>correo: </b>{{ $institucion-> email}}<br>
		<b>contrase&ntilde;a: </b>{{ $password}}<br>
	</p>
	 
	<p>Por favor no responda a este mensaje.</p>


</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Custom 3D Panel Heading Demo - ShareurCodes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92091941-1', 'auto');
  ga('send', 'pageview');

</script>

    <style>
  .outer{
      padding: 2em 1em;
      box-shadow: 5px 5px 5px #d9d9d9;
  }

  .headerbar{
      background: #640326 !important;
      color: #ffffff !important;
      position: relative;
      margin-bottom: 1.5em;
      margin-right: -2.5em;
      margin-left: -2.5em;
      box-shadow: 5px 5px 5px #d9d9d9;
  }
  .headerbar:before{
      content: "";
      position: absolute;
      border-bottom: 1.5em solid #333;
      border-left: 1.5em solid transparent;
      left: 0;
      top: -1.5em;
      
  }
  .headerbar:after{
      content: "";
      position: absolute;
      border-top: 1.5em solid #333;
      border-right: 1.5em solid transparent;
      right: 0;
      bottom: -1.5em;
  }

  .headerbar:hover {
    transform:scale(1,1.1);
  }
  </style>
</head>

<body>

<div class="container">
  <h1 class="text-center" style="padding: 50px 0px; color: #640326; "><u>Bootstrap Custom 3D Panel Heading</u></h1>
  <div class="row">
    <div class="col-md-4 col-md-offset-4" >
      <div class="panel panel-default outer">
        <div class="panel-heading headerbar">
          <h3 class="text-center">Panel Heading</h3>
        </div>
        <div class="panel-body text-justify">
            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. 
       </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
